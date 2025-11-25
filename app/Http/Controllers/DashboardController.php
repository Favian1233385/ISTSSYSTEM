<?php
class DashboardController extends Controller
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

        try {
            // Obtener estadísticas
            $stats = [
                "total_contents" => $this->model("Content")->count(),
                "total_news" => $this->model("News")->count(),
                "total_users" => $this->model("User")->count(),
                "recent_contents" => $this->model("Content")->getRecent(5),
                "recent_news" => $this->model("News")->getRecent(5),
            ];

            $this->view("admin/dashboard", [
                "title" => "Dashboard - ISTS Admin",
                "stats" => $stats,
                "user" => $this->model("User")->findById($_SESSION["user_id"]),
            ]);
        } catch (Exception $e) {
            error_log(
                "Error en DashboardController::index(): " . $e->getMessage(),
            );
            $this->view("admin/error", [
                "title" => "Error - ISTS Admin",
                "error" => "Error al cargar el dashboard",
            ]);
        }
    }
}
?>
