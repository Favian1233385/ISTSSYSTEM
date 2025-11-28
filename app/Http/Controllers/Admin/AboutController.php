<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Muestra una lista de los recursos de "Acerca".
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentModel = new Content();
        // Para el panel de admin, es mejor tener un método que traiga todos los contenidos sin importar el estado.
        // Por ahora, usamos getByCategory, pero considera añadir un getAllByCategory en el futuro.
        $abouts = $contentModel->getByCategory("about");

        return view("admin.about.index", compact("abouts"));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso de "Acerca".
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.about.create");
    }

    /**
     * Almacena un nuevo recurso de "Acerca" en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "body" => "nullable|string",
            "image_url" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "file_url" => "nullable|mimes:pdf|max:10240", // Max 10MB
        ]);

        $contentModel = new Content();

        $imagePath = null;
        if ($request->hasFile("image_url")) {
            $imagePath = $request
                ->file("image_url")
                ->store("uploads/images", "public");
        }

        $filePath = null;
        if ($request->hasFile("file_url")) {
            $filePath = $request
                ->file("file_url")
                ->store("uploads/pdfs", "public");
        }

        $slug = $this->generateUniqueSlug($request->title, $contentModel);

        $contentModel->create([
            "title" => $request->title,
            "slug" => $slug,
            "content" => $request->body,
            "category" => "about",
            "status" => $request->status ?? "published",
            "created_by" => auth()->id(),
            "image_url" => $imagePath,
            "file_url" => $filePath,
        ]);

        return redirect()
            ->route("about.index")
            ->with("success", 'Sección "Acerca" creada exitosamente.');
    }

    /**
     * Muestra un recurso específico de "Acerca".
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contentModel = new Content();
        $about = $contentModel->findById($id);

        if (!$about || $about["category"] !== "about") {
            abort(404);
        }

        return view("admin.about.show", compact("about"));
    }

    /**
     * Muestra el formulario para editar un recurso específico de "Acerca".
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contentModel = new Content();
        $about = $contentModel->findById($id);

        if (!$about || $about["category"] !== "about") {
            abort(404);
        }

        return view("admin.about.edit", compact("about"));
    }

    /**
     * Actualiza un recurso específico de "Acerca" en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "body" => "nullable|string",
            "image_url" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "file_url" => "nullable|mimes:pdf|max:10240",
        ]);

        $contentModel = new Content();
        $about = $contentModel->findById($id);

        if (!$about || $about["category"] !== "about") {
            abort(404);
        }

        $data = $request->only(["title", "body", "status"]);

        if ($request->hasFile("image_url")) {
            // Eliminar imagen anterior si existe
            if (
                $about["image_url"] &&
                Storage::disk("public")->exists($about["image_url"])
            ) {
                Storage::disk("public")->delete($about["image_url"]);
            }
            $data["image_url"] = $request
                ->file("image_url")
                ->store("uploads/images", "public");
        } else {
            $data["image_url"] = $about["image_url"]; // Mantener la imagen existente si no se sube una nueva
        }

        if ($request->hasFile("file_url")) {
            // Eliminar PDF anterior si existe
            if (
                $about["file_url"] &&
                Storage::disk("public")->exists($about["file_url"])
            ) {
                Storage::disk("public")->delete($about["file_url"]);
            }
            $data["file_url"] = $request
                ->file("file_url")
                ->store("uploads/pdfs", "public");
        } else {
            $data["file_url"] = $about["file_url"]; // Mantener el PDF existente si no se sube uno nuevo
        }

        // Generar slug único si el título ha cambiado
        if ($request->title !== $about["title"]) {
            $data["slug"] = $this->generateUniqueSlug(
                $request->title,
                $contentModel,
                $id,
            );
        } else {
            $data["slug"] = $about["slug"]; // Mantener el slug si el título no cambia
        }

        // Completar los datos que no vienen del formulario pero son necesarios para el modelo
        $data["category"] = "about";
        $data["content"] = $request->body; // Asegurar que el campo content se mapee correctamente
        $data["description"] = $about["description"]; // Mantener
        $data["url"] = $about["url"]; // Mantener
        $data["is_external"] = $about["is_external"]; // Mantener
        $data["featured"] = $about["featured"]; // Mantener
        $data["parent_id"] = $about["parent_id"]; // Mantener

        $contentModel->updateContent($id, $data);

        return redirect()
            ->route("about.index")
            ->with("success", 'Sección "Acerca" actualizada exitosamente.');
    }

    /**
     * Elimina un recurso específico de "Acerca" de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contentModel = new Content();
        $about = $contentModel->findById($id);

        if (!$about || $about["category"] !== "about") {
            abort(404);
        }

        // Eliminar archivos asociados del almacenamiento
        if (
            $about["image_url"] &&
            Storage::disk("public")->exists($about["image_url"])
        ) {
            Storage::disk("public")->delete($about["image_url"]);
        }
        if (
            $about["file_url"] &&
            Storage::disk("public")->exists($about["file_url"])
        ) {
            Storage::disk("public")->delete($about["file_url"]);
        }

        $contentModel->deleteContent($id);

        return redirect()
            ->route("about.index")
            ->with("success", 'Sección "Acerca" eliminada exitosamente.');
    }

    /**
     * Genera un slug único para el contenido.
     *
     * @param string $title
     * @param \App\Models\Content $contentModel
     * @param int|null $exceptId ID del contenido a excluir para evitar conflictos consigo mismo
     * @return string
     */
    protected function generateUniqueSlug(
        string $title,
        Content $contentModel,
        ?int $exceptId = null,
    ): string {
        $originalSlug = Str::slug($title);
        $slug = $originalSlug;
        $count = 1;

        while (true) {
            $existingContent = null;
            if ($exceptId !== null) {
                $existingContent = $contentModel->findBySlugExceptId(
                    $slug,
                    $exceptId,
                );
            } else {
                $existingContent = $contentModel->findBySlug($slug);
            }

            if ($existingContent) {
                $count++;
                $slug = $originalSlug . "-" . $count;
            } else {
                return $slug;
            }
        }
    }
}
