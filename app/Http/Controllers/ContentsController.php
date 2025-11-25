<?php
class ContentsController extends Controller
{
    private $contentModel;

    public function __construct()
    {
        $this->contentModel = $this->model("Content");
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

            $contents = $this->contentModel->paginate($page, $perPage);
            $total = $this->contentModel->count();
            $totalPages = ceil($total / $perPage);

            $this->view("admin/crud/contents/list", [
                "title" => "Gestión de Contenidos - ISTS Admin",
                "items" => $contents,
                "currentPage" => $page,
                "totalPages" => $totalPages,
                "model" => $this->contentModel,
            ]);
        } catch (Exception $e) {
            error_log(
                "Error en ContentsController::index(): " . $e->getMessage(),
            );
            $this->view("admin/error", [
                "title" => "Error",
                "error" => "Error al cargar contenidos",
            ]);
        }
    }

    public function create()
    {
        $this->requireAuth(); // Verificar autenticación

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $imageUploadResult = $this->handleImageUpload("image_file");
                if (isset($imageUploadResult["error"])) {
                    $this->view("admin/crud/contents/create", [
                        "title" => "Crear Contenido - ISTS Admin",
                        "errors" => [$imageUploadResult["error"]],
                        "form_data" => $_POST,
                    ]);
                    return;
                }

                $data = $this->validateContentData($_POST);
                $data["data"]["image_url"] = $imageUploadResult["path"] ?? null;

                if (empty($data["errors"])) {
                    $data["data"]["slug"] = $this->generateSlug(
                        $data["data"]["title"],
                    );
                    $data["data"]["created_by"] = $_SESSION["user_id"];

                    $id = $this->contentModel->create($data["data"]);

                    if ($id) {
                        Security::logSecurity(
                            "content_created",
                            $_SESSION["user_id"],
                            "Content ID: $id",
                            "low",
                        );
                        $this->redirect(
                            "/contents/index?success=Contenido creado exitosamente",
                        );
                    } else {
                        $data["errors"][] = "Error al crear el contenido";
                    }
                }

                $this->view("admin/crud/contents/create", [
                    "title" => "Crear Contenido - ISTS Admin",
                    "errors" => $data["errors"],
                    "form_data" => $data["data"],
                ]);
            } catch (Exception $e) {
                error_log(
                    "Error en ContentsController::create(): " .
                        $e->getMessage(),
                );
                $this->view("admin/crud/contents/create", [
                    "title" => "Crear Contenido - ISTS Admin",
                    "errors" => ["Error interno del servidor"],
                ]);
            }
        } else {
            $this->view("admin/crud/contents/create", [
                "title" => "Crear Contenido - ISTS Admin",
            ]);
        }
    }

    public function edit($id)
    {
        $this->requireAuth(); // Verificar autenticación
        $id = intval($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $imageUploadResult = $this->handleImageUpload("image_file");
                if (isset($imageUploadResult["error"])) {
                    $this->view("admin/crud/edit", [
                        "title" => "Editar Contenido - ISTS Admin",
                        "errors" => [$imageUploadResult["error"]],
                        "item" => $this->contentModel->findById($id),
                        "type" => "contents",
                    ]);
                    return;
                }

                $data = $this->validateContentData($_POST);
                $data["data"]["image_url"] =
                    $imageUploadResult["path"] ??
                    $this->contentModel->findById($id)["image_url"];

                if (empty($data["errors"])) {
                    $originalContent = $this->contentModel->findById($id);
                    if ($originalContent["title"] !== $data["data"]["title"]) {
                        $data["data"]["slug"] = $this->generateSlug(
                            $data["data"]["title"],
                        );
                    } else {
                        $data["data"]["slug"] = $originalContent["slug"];
                    }

                    // rowCount() puede retornar 0 si no hay cambios, pero eso NO es error
                    $this->contentModel->updateContent(
                        $id,
                        $data["data"],
                    );

                    Security::logSecurity(
                        "content_updated",
                        $_SESSION["user_id"],
                        "Content ID: $id",
                        "low",
                    );
                    $this->redirect(
                        APP_URL .
                            "/contents/index?success=Contenido actualizado exitosamente",
                    );
                }

                $this->view("admin/crud/contents/edit", [
                    "title" => "Editar Contenido - ISTS Admin",
                    "errors" => $data["errors"],
                    "form_data" => $data["data"],
                    "item" => $this->contentModel->findById($id),
                ]);
            } catch (Exception $e) {
                error_log(
                    "Error en ContentsController::edit(): " . $e->getMessage(),
                );
                $this->view("admin/crud/contents/edit", [
                    "title" => "Editar Contenido - ISTS Admin",
                    "errors" => ["Error interno del servidor"],
                    "item" => $this->contentModel->findById($id),
                ]);
            }
        } else {
            $item = $this->contentModel->findById($id);
            if (!$item) {
                $this->redirect(
                    "/contents/index?error=Contenido no encontrado",
                );
                return;
            }
            $this->view("admin/crud/contents/edit", [
                "title" => "Editar Contenido - ISTS Admin",
                "item" => $item,
            ]);
        }
    }

    public function delete($id)
    {
        $this->requireAuth(); // Verificar autenticación

        $id = intval($id);

        try {
            $deleted = $this->contentModel->deleteContent($id);

            if ($deleted) {
                Security::logSecurity(
                    "content_deleted",
                    $_SESSION["user_id"],
                    "Content ID: $id",
                    "medium",
                );
                $this->redirect(
                    "/contents/index?success=Contenido eliminado exitosamente",
                );
            } else {
                $this->redirect(
                    "/contents/index?error=Error al eliminar el contenido",
                );
            }
        } catch (Exception $e) {
            error_log(
                "Error en ContentsController::delete(): " . $e->getMessage(),
            );
            $this->redirect("/contents/index?error=Error interno del servidor");
        }
    }

    private function validateContentData($data)
    {
        $errors = [];
        $validated = [];

        // Validar título
        $title = Security::sanitizeInput($data["title"] ?? "", "string");
        if (strlen($title) < 3) {
            $errors[] = "El título debe tener al menos 3 caracteres";
        }
        $validated["title"] = $title;

        // Validar descripción
        $description = Security::sanitizeInput(
            $data["description"] ?? "",
            "string",
        );
        if (strlen($description) < 10) {
            $errors[] = "La descripción debe tener al menos 10 caracteres";
        }
        $validated["description"] = $description;

        // Validar contenido
        $content = Security::cleanHTML($data["content"] ?? "");
        if (strlen($content) < 20) {
            $errors[] = "El contenido debe tener al menos 20 caracteres";
        }
        $validated["content"] = $content;

        // Validar categoría
        $category = Security::sanitizeInput($data["category"] ?? "", "string");
        $validated["category"] = $category;

        // Validar estado
        $status = Security::sanitizeInput($data["status"] ?? "draft", "string");
        if (!in_array($status, ["published", "draft"])) {
            $status = "draft";
        }
        $validated["status"] = $status;

        return ["errors" => $errors, "data" => $validated];
    }

    private function generateSlug($title)
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace("/[^a-z0-9-]/", "-", $slug);
        $slug = preg_replace("/-+/", "-", $slug);
        $slug = trim($slug, "-");

        // Verificar si el slug ya existe
        $originalSlug = $slug;
        $counter = 1;

        while ($this->contentModel->slugExists($slug)) {
            $slug = $originalSlug . "-" . $counter;
            $counter++;
        }

        return $slug;
    }

    private function handleImageUpload($fileInputName)
    {
        require_once ROOT_PATH . "/config/constant.php";
        if (
            isset($_FILES[$fileInputName]) &&
            $_FILES[$fileInputName]["error"] === UPLOAD_ERR_OK
        ) {
            $file = $_FILES[$fileInputName];

            // Validar archivo
            if (!Security::validateUploadedFile($file)) {
                return [
                    "error" =>
                        "Archivo inválido. Solo se permiten imágenes JPG, PNG, GIF de hasta 5MB.",
                ];
            }

            // Generar nombre único
            $fileName = uniqid() . "-" . basename($file["name"]);
            $uploadPath = UPLOAD_PATH . "images/" . $fileName;

            // Mover archivo
            if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
                return ["path" => "/uploads/images/" . $fileName];
            } else {
                return ["error" => "Error al mover el archivo subido."];
            }
        }
        return ["path" => null];
    }
}
?>
