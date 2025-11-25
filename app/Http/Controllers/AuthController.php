<?php
/**
 * Controlador de Autenticación - Sistema ISTS
 */
class AuthController extends Controller
{
    public function __construct() {}

    /**
     * Página de login (NO requiere autenticación)
     */
    public function login()
    {
        // Si ya está autenticado, redirigir al dashboard
        if (Security::isAuthenticated()) {
            $this->redirect("/ISTSSYSTEM/public/index.php?url=dashboard/index");
            exit();
        }

        // Mostrar formulario de login
        $this->view("admin/login", [
            "title" => "Login - ISTS Admin",
        ]);
    }

    /**
     * Procesar autenticación (NO requiere autenticación previa)
     */
    public function auth()
    {
        // Si ya está autenticado, redirigir al dashboard
        if (Security::isAuthenticated()) {
            $this->redirect("/ISTSSYSTEM/public/index.php?url=dashboard/index");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->redirect("/ISTSSYSTEM/public/index.php?url=auth/login");
            return;
        }

        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        // Validar datos
        if (empty($email) || empty($password)) {
            $this->redirect(
                "/ISTSSYSTEM/public/index.php?url=auth/login&error=" .
                    urlencode("Por favor complete todos los campos"),
            );
            return;
        }

        // Autenticación
        try {
            $user = $this->model("User")->findByEmail($email);

            if (
                $user &&
                password_verify($password, $user["password"]) &&
                $user["role"] === "admin" &&
                $user["status"] === "active"
            ) {
                // Crear sesión
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_email"] = $user["email"];
                $_SESSION["user_role"] = $user["role"];

                // Log de seguridad
                Security::logSecurity(
                    "admin_login",
                    $user["id"],
                    "Login exitoso",
                    "low",
                );

                // Redirigir al dashboard
                $this->redirect(
                    "/ISTSSYSTEM/public/index.php?url=dashboard/index",
                );
            } else {
                // Log de intento fallido
                Security::logSecurity(
                    "admin_login_failed",
                    null,
                    "Email: $email",
                    "medium",
                );

                $this->redirect(
                    "/ISTSSYSTEM/public/index.php?url=auth/login&error=" .
                        urlencode("Credenciales inválidas o acceso denegado"),
                );
            }
        } catch (Exception $e) {
            error_log("Error en AuthController::auth(): " . $e->getMessage());
            $this->redirect(
                "/ISTSSYSTEM/public/index.php?url=auth/login&error=" .
                    urlencode("Error interno del servidor"),
            );
        }
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Log de seguridad
        if (isset($_SESSION["user_id"])) {
            Security::logSecurity(
                "admin_logout",
                $_SESSION["user_id"],
                "Logout exitoso",
                "low",
            );
        }

        // Limpiar sesión
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"],
            );
        }
        session_destroy();

        $this->redirect("/ISTSSYSTEM/public/index.php?url=auth/login");
    }
}
?>
