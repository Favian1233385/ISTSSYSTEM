<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
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
        // Nota: getByCategory solo muestra contenidos con estado 'published'.
        // Para un panel de admin, idealmente se deberían ver todos los estados.
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
            "body" => "required|string",
        ]);

        $contentModel = new Content();
        $slug = $this->generateUniqueSlug($request->title, $contentModel);

        $contentModel->create([
            "title" => $request->title,
            "slug" => $slug,
            "content" => $request->body,
            "category" => "about",
            "status" => $request->status ?? "published", // Asume 'published' si no se especifica
            "created_by" => auth()->id(),
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
            "body" => "required|string",
        ]);

        $contentModel = new Content();
        $about = $contentModel->findById($id);

        if (!$about || $about["category"] !== "about") {
            abort(404);
        }

        $slug = $this->generateUniqueSlug($request->title, $contentModel, $id);

        // Prepara los datos para la actualización
        $data = [
            "title" => $request->title,
            "slug" => $slug,
            "content" => $request->body,
            "status" => $request->status ?? $about["status"],
            // Mantén los valores existentes para los campos no presentes en el formulario
            "url" => $about["url"],
            "is_external" => $about["is_external"],
            "description" => $about["description"],
            "category" => "about",
            "featured" => $about["featured"],
            "image_url" => $about["image_url"],
            "parent_id" => $about["parent_id"],
            "file_url" => $about["file_url"],
        ];

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
                // Busca un slug que no sea el mismo que el contenido que estamos actualizando
                $existingContent = $contentModel->findBySlugExceptId(
                    $slug,
                    $exceptId,
                );
            } else {
                // Busca cualquier contenido con este slug
                $existingContent = $contentModel->findBySlug($slug);
            }

            if ($existingContent) {
                $count++;
                $slug = $originalSlug . "-" . $count;
            } else {
                // No se encontró contenido existente (o el existente es el que estamos actualizando), el slug es único.
                return $slug;
            }
        }
    }
}
