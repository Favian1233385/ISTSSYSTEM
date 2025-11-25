<?php
class SettingsController extends Controller
{
    public function __construct() {}

    private function requireAuth()
    {
        if (!Security::isAuthenticated()) {
            $this->redirect(APP_URL . "/auth/login");
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth(); // Verificar autenticación

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $this->processSettings($_POST);
                $this->redirect(
                    "/settings/index?success=Configuración actualizada exitosamente",
                );
            } catch (Exception $e) {
                error_log(
                    "Error en SettingsController::index(): " . $e->getMessage(),
                );
                $this->view("admin/settings", [
                    "title" => "Configuración - ISTS Admin",
                    "error" => "Error al actualizar configuración",
                ]);
            }
        } else {
            $this->view("admin/settings", [
                "title" => "Configuración - ISTS Admin",
            ]);
        }
    }

    private function processSettings($data)
    {
        // Aquí se procesarían las configuraciones del sistema
        // Por ejemplo, actualizar constantes, configuraciones de email, etc.
        Security::logSecurity(
            "settings_updated",
            $_SESSION["user_id"],
            "",
            "medium",
        );
    }
}
?>
