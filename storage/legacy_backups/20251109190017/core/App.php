<?php
/**
 * Núcleo de la aplicación MVC
 * Sistema de enrutamiento con seguridad integrada
 */

class App
{
    protected $controller = "HomeController";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        // Aplicar headers de seguridad
        Security::setSecurityHeaders();

        // Iniciar sesión segura
        $this->initSecureSession();

        // Procesar URL
        $url = $this->parseUrl();

        // Determinar controlador
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . "Controller";
            $controllerFile =
                __DIR__ . "/../controllers/" . $controllerName . ".php";

            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        // Requerir controlador
        require_once __DIR__ . "/../controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller();

        // Determinar método
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Obtener parámetros
        $this->params = $url ? array_values($url) : [];

        // Verificar autenticación para rutas administrativas
        $this->checkAuthentication();

        // Verificar CSRF para métodos POST
        $this->checkCSRF();

        // Verificar rate limiting
        $this->checkRateLimit();

        // Asegurarse de que el método existe antes de invocarlo
        $controller = $this->controller;
        $method = $this->method;
        $params = $this->params;

        if (!method_exists($controller, $method)) {
            // Intentar 'index' como fallback
            if (method_exists($controller, "index")) {
                $method = "index";
            } else {
                // Método no encontrado: devolver 404 amigable
                header("HTTP/1.0 404 Not Found");
                echo "404 - Método no encontrado en " .
                    htmlspecialchars(get_class($controller)) .
                    " :: " .
                    htmlspecialchars($method);
                exit();
            }
        }

        // Llamada segura al método con parámetros
        call_user_func_array([$controller, $method], $params);
    }

    /**
     * Parsear URL de forma segura
     */
    protected function parseUrl()
    {
        if (isset($_GET["url"])) {
            $url = filter_var($_GET["url"], FILTER_SANITIZE_URL);
            $url = rtrim($url, "/");
            $url = explode("/", $url);

            // Sanitizar cada parte de la URL
            return array_map(function ($part) {
                return Security::sanitizeInput($part, "string");
            }, $url);
        }
        return [];
    }

    /**
     * Inicializar sesión segura
     */
    protected function initSecureSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            // Configuración de sesión segura
            ini_set("session.cookie_httponly", 1);
            ini_set("session.use_only_cookies", 1);
            ini_set("session.cookie_secure", 1); // Solo HTTPS en producción
            ini_set("session.cookie_samesite", "Strict");

            session_name("ISTS_SESSION");
            session_start();

            // Regenerar ID de sesión periódicamente
            if (!isset($_SESSION["created"])) {
                $_SESSION["created"] = time();
            } elseif (time() - $_SESSION["created"] > 1800) {
                session_regenerate_id(true);
                $_SESSION["created"] = time();
            }
        }
    }

    /**
     * Verificar autenticación para rutas protegidas
     */
    protected function checkAuthentication()
    {
        $protectedControllers = [
            "ContentsController",
            "NewsController",
            "UsersController",
            "DashboardController",
            "SettingsController",
            "LeadershipController",
        ];
        $controllerName = get_class($this->controller);

        if (
            $controllerName === "AuthController" &&
            $this->method === "logout"
        ) {
            if (!Security::isAuthenticated()) {
                header("Location: /auth/login");
                exit();
            }
        }

        if (in_array($controllerName, $protectedControllers)) {
            if (!Security::isAuthenticated()) {
                header("Location: /auth/login");
                exit();
            }

            // Verificar rol para acciones específicas
            if ($this->method !== "dashboard" && !Security::hasRole("admin")) {
                http_response_code(403);
                die("Access Denied: Insufficient permissions");
            }
        }
    }

    /**
     * Verificar token CSRF en métodos POST
     */
    protected function checkCSRF()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $token =
                $_POST["csrf_token"] ?? ($_SERVER["HTTP_X_CSRF_TOKEN"] ?? "");

            if (!Security::validateCSRFToken($token)) {
                Security::logSecurity(
                    "csrf_validation_failed",
                    $_SESSION["user_id"] ?? null,
                    "",
                    "high",
                );
                http_response_code(403);
                die("CSRF validation failed");
            }
        }
    }

    /**
     * Verificar rate limiting
     */
    protected function checkRateLimit()
    {
        $controllerName = get_class($this->controller);
        $endpoint = $controllerName . "/" . $this->method;

        if (!Security::checkRateLimit($endpoint, 50, 60)) {
            http_response_code(429);
            header("Retry-After: 900"); // 15 minutos
            die("Too many requests. Please try again later.");
        }
    }
}
?>
