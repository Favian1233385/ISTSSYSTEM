<?php
/**
 * Controlador Base
 */
class Controller
{
    /**
     * Cargar modelo
     */
    public function model($model)
    {
        require_once __DIR__ . "/../models/" . $model . ".php";
        return new $model();
    }

    /**
     * Cargar vista con datos
     */
    public function view($view, $data = [])
    {
        // Sanitizar datos antes de pasarlos a la vista
        $data = $this->sanitizeViewData($data);

        // Agregar token CSRF a todas las vistas
        $data["csrf_token"] = Security::generateCSRFToken();
        $data["app_url"] = APP_URL;

        extract($data);

        $viewFile = __DIR__ . "/../views/" . $view . ".php";

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View not found: $view");
        }
    }

    /**
     * Sanitizar datos para la vista
     */
    protected function sanitizeViewData($data)
    {
        if (is_array($data)) {
            return array_map([$this, "sanitizeViewData"], $data);
        }

        if (is_string($data)) {
            return Security::sanitizeInput($data, "html");
        }

        return $data;
    }

    /**
     * Respuesta JSON segura
     */
    public function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        echo Security::escapeJSON($data);
        exit();
    }

    /**
     * Redirección segura
     */
    public function redirect($url)
    {
        $url = Security::sanitizeInput($url, "url");
        header("Location: " . $url);
        exit();
    }
}
?>
