<?php
class UsersController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model("User");
    }

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
            $page = intval($_GET["page"] ?? 1);
            $perPage = 10;

            $users = $this->userModel->paginate($page, $perPage);
            $total = $this->userModel->count();
            $totalPages = ceil($total / $perPage);

            $this->view("admin/crud/users/list", [
                "title" => "Gestión de Usuarios - ISTS Admin",
                "items" => $users,
                "currentPage" => $page,
                "totalPages" => $totalPages,
                "model" => $this->userModel,
            ]);
        } catch (Exception $e) {
            error_log("Error en UsersController::index(): " . $e->getMessage());
            $this->view("admin/error", [
                "title" => "Error",
                "error" => "Error al cargar usuarios",
            ]);
        }
    }

    public function create()
    {
        $this->requireAuth(); // Verificar autenticación

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $data = $this->validateUserData($_POST);

                if (empty($data["errors"])) {
                    // Hash de la contraseña
                    $data["data"]["password"] = password_hash(
                        $data["data"]["password"],
                        PASSWORD_DEFAULT,
                    );

                    $id = $this->userModel->create($data["data"]);

                    if ($id) {
                        Security::logSecurity(
                            "user_created",
                            $_SESSION["user_id"],
                            "User ID: $id",
                            "medium",
                        );
                        $this->redirect(
                            APP_URL .
                                "/users/index?success=Usuario creado exitosamente",
                        );
                    } else {
                        $data["errors"][] = "Error al crear el usuario";
                    }
                }

                $this->view("admin/crud/create", [
                    "title" => "Crear Usuario - ISTS Admin",
                    "errors" => $data["errors"],
                    "form_data" => $data["data"],
                ]);
            } catch (Exception $e) {
                error_log(
                    "Error en UsersController::create(): " . $e->getMessage(),
                );
                $this->view("admin/crud/create", [
                    "title" => "Crear Usuario - ISTS Admin",
                    "errors" => ["Error interno del servidor"],
                ]);
            }
        } else {
            $this->view("admin/crud/create", [
                "title" => "Crear Usuario - ISTS Admin",
            ]);
        }
    }

    public function edit($id)
    {
        $this->requireAuth(); // Verificar autenticación

        $id = intval($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $data = $this->validateUserData($_POST, true);

                if (empty($data["errors"])) {
                    // Si hay nueva contraseña, hashearla
                    if (!empty($data["data"]["password"])) {
                        $data["data"]["password"] = password_hash(
                            $data["data"]["password"],
                            PASSWORD_DEFAULT,
                        );
                    } else {
                        unset($data["data"]["password"]);
                    }

                    $updated = $this->userModel->updateUser($id, $data["data"]);

                    if ($updated) {
                        Security::logSecurity(
                            "user_updated",
                            $_SESSION["user_id"],
                            "User ID: $id",
                            "medium",
                        );
                        $this->redirect(
                            APP_URL .
                                "/users/index?success=Usuario actualizado exitosamente",
                        );
                    } else {
                        $data["errors"][] = "Error al actualizar el usuario";
                    }
                }

                $this->view("admin/crud/users/edit", [
                    "title" => "Editar Usuario - ISTS Admin",
                    "errors" => $data["errors"],
                    "form_data" => $data["data"],
                    "item" => $this->userModel->findById($id),
                ]);
            } catch (Exception $e) {
                error_log(
                    "Error en UsersController::edit(): " . $e->getMessage(),
                );
                $this->view("admin/crud/users/edit", [
                    "title" => "Editar Usuario - ISTS Admin",
                    "errors" => ["Error interno del servidor"],
                    "item" => $this->userModel->findById($id),
                ]);
            }
        } else {
            $item = $this->userModel->findById($id);

            if (!$item) {
                $this->redirect(
                    APP_URL . "/users/index?error=Usuario no encontrado",
                );
                return;
            }

            $this->view("admin/crud/users/edit", [
                "title" => "Editar Usuario - ISTS Admin",
                "item" => $item,
            ]);
        }
    }

    public function delete($id)
    {
        $this->requireAuth(); // Verificar autenticación

        $id = intval($id);

        // No permitir eliminar el usuario actual
        if ($id == $_SESSION["user_id"]) {
            $this->redirect(
                APP_URL .
                    "/users/index?error=No puedes eliminar tu propio usuario",
            );
            return;
        }

        try {
            $deleted = $this->userModel->deleteUser($id);

            if ($deleted) {
                Security::logSecurity(
                    "user_deleted",
                    $_SESSION["user_id"],
                    "User ID: $id",
                    "high",
                );
                $this->redirect(
                    APP_URL .
                        "/users/index?success=Usuario eliminado exitosamente",
                );
            } else {
                $this->redirect(
                    APP_URL . "/users/index?error=Error al eliminar el usuario",
                );
            }
        } catch (Exception $e) {
            error_log(
                "Error en UsersController::delete(): " . $e->getMessage(),
            );
            $this->redirect(
                APP_URL . "/users/index?error=Error interno del servidor",
            );
        }
    }

    private function validateUserData($data, $isUpdate = false)
    {
        $errors = [];
        $validated = [];

        // Validar nombre de usuario
        $username = Security::sanitizeInput($data["username"] ?? "", "string");
        if (strlen($username) < 3) {
            $errors[] = "El nombre de usuario debe tener al menos 3 caracteres";
        }
        $validated["username"] = $username;

        // Validar email
        $email = Security::sanitizeInput($data["email"] ?? "", "email");
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "El formato del email no es válido";
        }
        $validated["email"] = $email;

        // Validar contraseña (solo si no es una actualización o si se proporciona una nueva)
        if (!$isUpdate || !empty($data["password"])) {
            $password = $data["password"] ?? "";
            if (strlen($password) < 8) {
                $errors[] = "La contraseña debe tener al menos 8 caracteres";
            }
            $validated["password"] = $password;
        }

        // Validar rol
        $role = Security::sanitizeInput($data["role"] ?? "user", "string");
        if (!in_array($role, ["admin", "editor", "user"])) {
            $role = "user";
        }
        $validated["role"] = $role;

        // Validar estado
        $status = Security::sanitizeInput(
            $data["status"] ?? "active",
            "string",
        );
        if (!in_array($status, ["active", "inactive", "suspended"])) {
            $status = "active";
        }
        $validated["status"] = $status;

        return ["errors" => $errors, "data" => $validated];
    }
}
?>
