<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSlide;

class HeroSlidesController extends Controller
{
    private $heroSlideModel;

    public function __construct()
    {
        // Proteger el controlador para que solo los administradores puedan acceder
        if (
            !isset($_SESSION["user_id"]) ||
            $_SESSION["user_role"] !== "admin"
        ) {
            header("Location: /admin/login");
            exit();
        }
        $this->heroSlideModel = $this->model("HeroSlide");
    }

    public function index()
    {
        $slides = $this->heroSlideModel->getAllSlides(false); // Obtener todos, activos e inactivos
        $this->view("admin/crud/slides/list", ["slides" => $slides]);
    }

    public function create()
    {
        $this->view("admin/crud/slides/create");
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uploadDir = "uploads/images/";
            $fileName = basename($_FILES["image"]["name"]);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
                $data = [
                    "title" => $_POST["title"],
                    "subtitle" => $_POST["subtitle"],
                    "image_path" => $uploadFile,
                    "link" => $_POST["link"],
                    "sort_order" => $_POST["sort_order"],
                    "is_active" => isset($_POST["is_active"]) ? 1 : 0,
                ];

                if ($this->heroSlideModel->createSlide($data)) {
                    header("Location: /admin/heroslides");
                } else {
                    // Manejar error
                    $this->view("admin/crud/slides/create", [
                        "error" => "Error al crear el slide.",
                    ]);
                }
            } else {
                $this->view("admin/crud/slides/create", [
                    "error" => "Error al subir la imagen.",
                ]);
            }
        }
    }

    public function edit($id)
    {
        $slide = $this->heroSlideModel->getSlideById($id);
        $this->view("admin/crud/slides/edit", ["slide" => $slide]);
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $slide = $this->heroSlideModel->getSlideById($id);
            $image_path = $slide["image_path"];

            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                $uploadDir = "uploads/images/";
                $fileName = basename($_FILES["image"]["name"]);
                $uploadFile = $uploadDir . $fileName;

                if (
                    move_uploaded_file(
                        $_FILES["image"]["tmp_name"],
                        $uploadFile,
                    )
                ) {
                    // Opcional: eliminar la imagen anterior si se sube una nueva
                    if ($image_path && file_exists($image_path)) {
                        unlink($image_path);
                    }
                    $image_path = $uploadFile;
                }
            }

            $data = [
                "title" => $_POST["title"],
                "subtitle" => $_POST["subtitle"],
                "image_path" => $image_path,
                "link" => $_POST["link"],
                "sort_order" => $_POST["sort_order"],
                "is_active" => isset($_POST["is_active"]) ? 1 : 0,
            ];

            if ($this->heroSlideModel->updateSlide($id, $data)) {
                header("Location: /admin/heroslides");
            } else {
                $this->view("admin/crud/slides/edit", [
                    "slide" => $data,
                    "error" => "Error al actualizar.",
                ]);
            }
        }
    }

    public function delete($id)
    {
        $slide = $this->heroSlideModel->getSlideById($id);
        if ($slide) {
            // Eliminar la imagen del servidor
            if (file_exists($slide["image_path"])) {
                unlink($slide["image_path"]);
            }
            $this->heroSlideModel->deleteSlide($id);
        }
        header("Location: /admin/heroslides");
    }
}
