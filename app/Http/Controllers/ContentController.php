<?php

namespace App\Http\Controllers;

use App\Models\ContentImage;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    protected $contentModel;

    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("is_admin");
        // Asegurar que $this->contentModel se inicialice correctamente.
        // Intentamos primero el modelo namespaced de Laravel, luego el modelo legacy sin namespace
        if (!$this->contentModel) {
            // Si existe un modelo PSR-4 con namespace App\Models\Content
            if (class_exists(\App\Models\Content::class)) {
                $this->contentModel = new \App\Models\Content();
            } else {
                // Intentar cargar el archivo legacy directamente si existe
                $legacyPath = app_path("Models/Content.php");
                if (file_exists($legacyPath)) {
                    // Requerir el archivo para que la clase global Content esté disponible
                    require_once $legacyPath;
                    if (class_exists("Content")) {
                        $this->contentModel = new \Content();
                    }
                }
            }
        }
    }

    public function index(Request $request)
    {
        try {
            $category = $request->route()->defaults["category"] ?? null;

            if ($category === "transparency" || $category === "tramites") {
                // Para transparencia y trámites, mostrar jerarquía sin paginación
                $allItems = \Illuminate\Support\Facades\DB::table("contents")
                    ->where("category", $category)
                    ->orderBy("parent_id", "asc")
                    ->orderBy("created_at", "desc")
                    ->get()
                    ->map(fn($r) => (array) $r)
                    ->toArray();

                $parents = [];
                $children = [];
                foreach ($allItems as $item) {
                    if ($item["parent_id"] === null) {
                        $parents[] = $item;
                    } else {
                        $children[$item["parent_id"]][] = $item;
                    }
                }

                // Asignar children a cada parent
                foreach ($parents as &$parent) {
                    $parent["children"] = $children[$parent["id"]] ?? [];
                }

                $title = "Gestión de Contenidos - ISTS Admin";
                if ($category === "tramites") {
                    $title = "Gestión de Trámites - ISTS Admin";
                } elseif ($category === "transparency") {
                    $title = "Gestión de Transparencia - ISTS Admin";
                }

                return view("admin.crud.contents.list", [
                    "title" => $title,
                    "items" => $parents,
                    "category" => $category,
                    "is_hierarchical" => true,
                ]);
            } else {
                // Para otros contenidos, paginación normal
                $page = (int) $request->query("page", 1);
                $perPage = 10;

                $query = \Illuminate\Support\Facades\DB::table("contents");

                if ($category) {
                    // Si se está viendo una categoría específica (ej. 'tramites'), filtrar por ella
                    $query->where("category", $category);
                } else {
                    // Si es la lista general de contenidos, excluir las categorías especiales
                    $query
                        ->whereNotIn("category", ["transparency", "tramites"])
                        ->whereNull("parent_id");
                }

                $total = $query->count();
                $items = $query
                    ->orderBy("created_at", "desc")
                    ->skip(($page - 1) * $perPage)
                    ->take($perPage)
                    ->get()
                    ->map(fn($r) => (array) $r)
                    ->toArray();

                $paginator = new LengthAwarePaginator(
                    $items,
                    $total,
                    $perPage,
                    $page,
                    [
                        "path" => $request->url(),
                        "query" => $request->query(),
                    ],
                );

                $title = "Gestión de Contenidos - ISTS Admin";
                if ($category === "tramites") {
                    $title = "Gestión de Trámites - ISTS Admin";
                }

                return view("admin.crud.contents.list", [
                    "title" => $title,
                    "items" => $paginator,
                    "category" => $category,
                    "is_hierarchical" => false,
                ]);
            }
        } catch (\Exception $e) {
            Log::error("ContentController@index: " . $e->getMessage());
            return view("admin.error", [
                "title" => "Error",
                "error" => "Error al cargar contenidos",
            ]);
        }
    }

    public function create(Request $request)
    {
        $category = $request->query("category");
        $parents = [];
        if ($category === "transparency" || $category === "tramites") {
            $parents = $this->contentModel->getByCategoryAndParent($category);
        }

        $title = "Crear Contenido - ISTS Admin";
        if ($category === "tramites") {
            $title = "Crear Trámite - ISTS Admin";
        } elseif ($category === "transparency") {
            $title = "Crear Reglamento - ISTS Admin";
        }

        return view("admin.crud.contents.create", [
            "title" => $title,
            "parents" => $parents,
            "category" => $category,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            "title" => "required|string|min:3",
            "slug" => "nullable|string|unique:contents,slug",
            "url" => "nullable|url",
            "is_external" => "nullable|boolean",
            "description" => "required|string|min:10",
            "content" =>
                $request->input("category") === "tramites"
                    ? "nullable|string"
                    : "required|string|min:20",
            "category" => "nullable|string",
            "parent_id" => "nullable|exists:contents,id",
            "image_file" => "nullable|file|image|max:5120",
            "pdf_files" => "nullable|array",
            "pdf_files.*" => "nullable|file|mimes:pdf|max:10240",
            "external_pdf_url" => "nullable|url",
            "featured" => "nullable|boolean",
        ];

        $validated = $request->validate($rules);

        try {
            // Usar el slug proporcionado o generar uno del título
            $slug =
                $validated["slug"] ?? $this->generateSlug($validated["title"]);

            $fileUrl = null;
            // Prioritize external URL over file uploads
            if ($request->filled("external_pdf_url")) {
                $fileUrl = $validated["external_pdf_url"];
            } elseif ($request->hasFile("pdf_files")) {
                $pdfPaths = [];
                foreach ($request->file("pdf_files") as $file) {
                    $filename =
                        uniqid() .
                        "-" .
                        preg_replace(
                            "/[^A-Za-z0-9_.-]/",
                            "",
                            $file->getClientOriginalName(),
                        );
                    $destination = public_path("uploads/pdfs");
                    if (!is_dir($destination)) {
                        mkdir($destination, 0755, true);
                    }
                    $file->move($destination, $filename);
                    $pdfPaths[] = "/uploads/pdfs/" . $filename;
                }
                $fileUrl = json_encode($pdfPaths);
            }

            // Decodificar entidades HTML para evitar doble escapado
            $data = [
                "title" => html_entity_decode(
                    $validated["title"],
                    ENT_QUOTES | ENT_HTML5,
                    "UTF-8",
                ),
                "slug" => $slug,
                "url" => $validated["url"] ?? null,
                "is_external" => $request->boolean("is_external"),
                "description" => html_entity_decode(
                    $validated["description"],
                    ENT_QUOTES | ENT_HTML5,
                    "UTF-8",
                ),
                "content" => html_entity_decode(
                    $validated["content"] ?? "",
                    ENT_QUOTES | ENT_HTML5,
                    "UTF-8",
                ),
                "category" =>
                    $request->input("category") ?:
                    ($request->input("parent_id")
                        ? "transparency"
                        : null),
                "parent_id" => $request->input("parent_id"),
                "status" => $request->input("status", "published"),
                "featured" => (int) $request->boolean("featured"),
                "created_by" => Auth::id(),
                "image_url" => null,
                "file_url" => $fileUrl,
            ];

            $contentId = $this->contentModel->create($data);

            // Handle image upload
            if ($contentId && $request->hasFile("image_file")) {
                $file = $request->file("image_file");
                $filename =
                    uniqid() .
                    "-" .
                    preg_replace(
                        "/[^A-Za-z0-9_.-]/",
                        "",
                        $file->getClientOriginalName(),
                    );
                $destination = public_path("uploads/images/contents");
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $filename);
                $imagePath = "/uploads/images/contents/" . $filename;
                $this->contentModel->updateImage($contentId, $imagePath);
            }

            if ($contentId && $request->hasFile("image_files")) {
                foreach ($request->file("image_files") as $file) {
                    $filename =
                        uniqid() .
                        "-" .
                        preg_replace(
                            "/[^A-Za-z0-9_.-]/",
                            "",
                            $file->getClientOriginalName(),
                        );
                    $destination = public_path("uploads/images/contents");
                    if (!is_dir($destination)) {
                        mkdir($destination, 0755, true);
                    }
                    $file->move($destination, $filename);
                    $imagePath = "/uploads/images/contents/" . $filename;

                    ContentImage::create([
                        "content_id" => $contentId,
                        "image_path" => $imagePath,
                    ]);
                }
            }

            if ($contentId) {
                return redirect()
                    ->route("admin.contents.index")
                    ->with("success", "Contenido creado exitosamente");
            }

            return back()
                ->withInput()
                ->withErrors(["error" => "Error al crear el contenido"]);
        } catch (\Exception $e) {
            Log::error("ContentController@store: " . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors([
                    "error" =>
                        "Error interno del servidor: " . $e->getMessage(),
                ]);
        }
    }

    public function edit($id)
    {
        $item = $this->contentModel->findById((int) $id);
        if (!$item) {
            return redirect()
                ->route("admin.contents.index")
                ->withErrors(["error" => "Contenido no encontrado"]);
        }
        $item["images"] = ContentImage::where("content_id", $id)
            ->get()
            ->toArray();

        $parents = [];
        if (
            $item["category"] === "transparency" ||
            $item["category"] === "tramites"
        ) {
            $parents = $this->contentModel->getByCategoryAndParent(
                $item["category"],
            );
        }

        $children = [];
        if (!$item["parent_id"] && ($item["category"] === "transparency" || $item["category"] === "tramites")) {
            $children = \Illuminate\Support\Facades\DB::table("contents")
                ->where("parent_id", $item["id"])
                ->orderBy("created_at", "desc")
                ->get()
                ->map(fn($r) => (array) $r)
                ->toArray();
        }

        return view("admin.crud.contents.edit", [
            "title" => "Editar Contenido - ISTS Admin",
            "item" => $item,
            "parents" => $parents,
            "children" => $children,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Contenidos especiales con slug protegido
        $protectedSlugs = ["linea-de-tiempo", "mision-y-vision", "organigrama"];
        $currentItem = $this->contentModel->findById((int) $id);
        $isProtectedSlug =
            $currentItem && in_array($currentItem["slug"], $protectedSlugs);

        $rules = [
            "title" => "required|string|min:3",
            "slug" => $isProtectedSlug
                ? "nullable"
                : "nullable|string|unique:contents,slug," . $id,
            "url" => "nullable|url",
            "is_external" => "nullable|boolean",
            "description" => "required|string|min:10",
            "content" =>
                $request->input("category") === "tramites"
                    ? "nullable|string"
                    : "required|string|min:20",
            "category" => "nullable|string",
            "parent_id" => "nullable|exists:contents,id",
            "image_file" => "nullable|file|image|max:5120",
            "pdf_files" => "nullable|array",
            "pdf_files.*" => "nullable|file|mimes:pdf|max:10240",
            "external_pdf_url" => "nullable|url",
            "featured" => "nullable|boolean",
        ];

        $validated = $request->validate($rules);

        try {
            $item = $this->contentModel->findById((int) $id);
            if (!$item) {
                return redirect()
                    ->route("admin.contents.index")
                    ->withErrors(["error" => "Contenido no encontrado"]);
            }

            if ($request->hasFile("image_files")) {
                foreach ($request->file("image_files") as $file) {
                    $filename =
                        uniqid() .
                        "-" .
                        preg_replace(
                            "/[^A-Za-z0-9_.-]/",
                            "",
                            $file->getClientOriginalName(),
                        );
                    $destination = public_path("uploads/images/contents");
                    if (!is_dir($destination)) {
                        mkdir($destination, 0755, true);
                    }
                    $file->move($destination, $filename);
                    $imagePath = "/uploads/images/contents/" . $filename;

                    ContentImage::create([
                        "content_id" => $id,
                        "image_path" => $imagePath,
                    ]);
                }
            }

            // Handle image upload
            if ($request->hasFile("image_file")) {
                $file = $request->file("image_file");
                $filename =
                    uniqid() .
                    "-" .
                    preg_replace(
                        "/[^A-Za-z0-9_.-]/",
                        "",
                        $file->getClientOriginalName(),
                    );
                $destination = public_path("uploads/images/contents");
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $filename);
                $imagePath = "/uploads/images/contents/" . $filename;
                $this->contentModel->updateImage($id, $imagePath);
                $item["image_url"] = $imagePath; // Update for data array
            }

            $fileUrl = $item["file_url"] ?? null;
            // Prioritize external URL over file uploads
            if ($request->filled("external_pdf_url")) {
                $fileUrl = $validated["external_pdf_url"];
            } elseif ($request->hasFile("pdf_files")) {
                $pdfPaths = [];
                foreach ($request->file("pdf_files") as $file) {
                    $filename =
                        uniqid() .
                        "-" .
                        preg_replace(
                            "/[^A-Za-z0-9_.-]/",
                            "",
                            $file->getClientOriginalName(),
                        );
                    $destination = public_path("uploads/pdfs");
                    if (!is_dir($destination)) {
                        mkdir($destination, 0755, true);
                    }
                    $file->move($destination, $filename);
                    $pdfPaths[] = "/uploads/pdfs/" . $filename;
                }
                $fileUrl = json_encode($pdfPaths);
            }

            // Si es un contenido con slug protegido, mantener el slug original
            if ($isProtectedSlug) {
                $slug = $item["slug"];
            } else {
                // Usar el slug proporcionado, o generar uno nuevo si cambió el título
                if ($request->filled("slug")) {
                    $slug = $validated["slug"];
                } else {
                    $slug =
                        $item["title"] !== $validated["title"]
                            ? $this->generateSlug($validated["title"])
                            : $item["slug"];
                }
            }

            // Decodificar entidades HTML para evitar doble escapado
            $data = [
                "title" => html_entity_decode(
                    $validated["title"],
                    ENT_QUOTES | ENT_HTML5,
                    "UTF-8",
                ),
                "slug" => $slug,
                "url" => $validated["url"] ?? null,
                "is_external" => $request->boolean("is_external"),
                "description" => html_entity_decode(
                    $validated["description"],
                    ENT_QUOTES | ENT_HTML5,
                    "UTF-8",
                ),
                "content" => html_entity_decode(
                    $validated["content"] ?? "",
                    ENT_QUOTES | ENT_HTML5,
                    "UTF-8",
                ),
                "category" =>
                    $request->input("category") ?:
                    ($request->input("parent_id")
                        ? "transparency"
                        : null),
                "parent_id" => $request->input("parent_id"),
                "status" => $request->input("status", "published"), // Publicar por defecto
                "featured" => (int) $request->boolean("featured"),
                "image_url" => $item["image_url"],
                "file_url" => $fileUrl,
            ];

            // rowCount() puede retornar 0 si no hay cambios, pero eso NO es error
            $this->contentModel->updateContent((int) $id, $data);

            return redirect()
                ->route("admin.contents.index")
                ->with("success", "Contenido actualizado exitosamente");
        } catch (\Exception $e) {
            Log::error("ContentController@update: " . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors([
                    "error" =>
                        "Error interno del servidor: " . $e->getMessage(),
                ]);
        }
    }

    public function destroy($id)
    {
        try {
            $images = ContentImage::where("content_id", $id)->get();
            foreach ($images as $image) {
                Storage::disk("public")->delete(
                    str_replace("/storage", "", $image->image_path),
                );
                $image->delete();
            }

            $deleted = $this->contentModel->deleteContent((int) $id);
            if ($deleted) {
                return redirect()
                    ->route("admin.contents.index")
                    ->with("success", "Contenido eliminado exitosamente");
            }
            return redirect()
                ->route("admin.contents.index")
                ->withErrors(["error" => "Error al eliminar el contenido"]);
        } catch (\Exception $e) {
            Log::error("ContentController@destroy: " . $e->getMessage());
            return redirect()
                ->route("admin.contents.index")
                ->withErrors(["error" => "Error interno del servidor"]);
        }
    }

    public function destroyImage($contentId, $imageId)
    {
        try {
            $image = ContentImage::where("content_id", $contentId)
                ->where("id", $imageId)
                ->first();
            if ($image) {
                Storage::disk("public")->delete(
                    str_replace("/storage", "", $image->image_path),
                );
                $image->delete();
                return back()->with(
                    "success",
                    "Imagen eliminada exitosamente.",
                );
            }
            return back()->withErrors(["error" => "Imagen no encontrada."]);
        } catch (\Exception $e) {
            Log::error("ContentController@destroyImage: " . $e->getMessage());
            return back()->withErrors([
                "error" => "Error interno del servidor.",
            ]);
        }
    }

    private function generateSlug($title)
    {
        $slug = Str::slug($title);

        $original = $slug;
        $counter = 1;
        // Protegemos contra $this->contentModel nulo y comprobamos si el método slugExists existe
        while (
            $this->contentModel &&
            method_exists($this->contentModel, "slugExists") &&
            $this->contentModel->slugExists($slug)
        ) {
            $slug = $original . "-" . $counter;
            $counter++;
        }

        return $slug;
    }

    public function rector()
    {
        try {
            $content = \Illuminate\Support\Facades\DB::table("contents")
                ->where("category", "rector")
                ->first();

            if (!$content) {
                // Crear contenido por defecto si no existe
                $contentId = \Illuminate\Support\Facades\DB::table("contents")->insertGetId([
                    "title" => "Mensaje del Rector",
                    "description" => "Bienvenidos al Instituto Superior Tecnológico Sucúa...",
                    "category" => "rector",
                    "status" => "published",
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);
                $content = (object) [
                    "id" => $contentId,
                    "title" => "Mensaje del Rector",
                    "description" => "Bienvenidos al Instituto Superior Tecnológico Sucúa...",
                    "category" => "rector",
                    "status" => "published",
                ];
            }

            return view("admin.crud.contents.edit", [
                "title" => "Editar Mensaje del Rector - ISTS Admin",
                "content" => $content,
                "category" => "rector",
            ]);
        } catch (\Exception $e) {
            Log::error("ContentController@rector: " . $e->getMessage());
            return view("admin.error", [
                "title" => "Error",
                "error" => "Error al cargar mensaje del rector",
            ]);
        }
    }
}
