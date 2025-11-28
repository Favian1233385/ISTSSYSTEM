<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autoridad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Importar la clase Str

class AutoridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autoridades = Autoridad::orderBy("orden")->get();
        return view("admin.autoridades.index", compact("autoridades"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.autoridades.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|string|max:255",
            "cargo" => "required|string|max:255",
            "categoria" => "required|string|max:255",
            "biografia" => "nullable|string",
            "foto_path" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "pdf_path" => "nullable|mimes:pdf|max:10240", // Max 10MB
            "orden" => "required|integer",
        ]);

        $data = $request->only([
            "nombre",
            "cargo",
            "categoria",
            "biografia",
            "orden",
        ]);

        // Generar slug único
        $data["slug"] = $this->generateUniqueSlug($request->nombre);

        if ($request->hasFile("foto_path")) {
            $data["foto_path"] = $request
                ->file("foto_path")
                ->store("autoridades/fotos", "public");
        }

        if ($request->hasFile("pdf_path")) {
            $data["pdf_path"] = $request
                ->file("pdf_path")
                ->store("autoridades/pdfs", "public");
        }

        Autoridad::create($data);

        return redirect()
            ->route("admin.autoridades.index")
            ->with("success", "Autoridad creada exitosamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function show(Autoridad $autoridad)
    {
        // No es necesario para el admin, redirigir a editar.
        return redirect()->route("admin.autoridades.edit", $autoridad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function edit(Autoridad $autoridad)
    {
        return view("admin.autoridades.edit", compact("autoridad"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autoridad $autoridad)
    {
        $request->validate([
            "nombre" => "required|string|max:255",
            "cargo" => "required|string|max:255",
            "categoria" => "required|string|max:255",
            "biografia" => "nullable|string",
            "foto_path" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "pdf_path" => "nullable|mimes:pdf|max:10240",
            "orden" => "required|integer",
        ]);

        $data = $request->only([
            "nombre",
            "cargo",
            "categoria",
            "biografia",
            "orden",
        ]);

        // Generar slug único si el nombre ha cambiado
        if ($request->nombre !== $autoridad->nombre) {
            $data["slug"] = $this->generateUniqueSlug(
                $request->nombre,
                $autoridad->id,
            );
        } else {
            $data["slug"] = $autoridad->slug; // Mantener el slug existente si el nombre no cambió
        }

        if ($request->hasFile("foto_path")) {
            // Eliminar foto anterior
            if (
                $autoridad->foto_path &&
                Storage::disk("public")->exists($autoridad->foto_path)
            ) {
                Storage::disk("public")->delete($autoridad->foto_path);
            }
            $data["foto_path"] = $request
                ->file("foto_path")
                ->store("autoridades/fotos", "public");
        }

        if ($request->hasFile("pdf_path")) {
            // Eliminar PDF anterior
            if (
                $autoridad->pdf_path &&
                Storage::disk("public")->exists($autoridad->pdf_path)
            ) {
                Storage::disk("public")->delete($autoridad->pdf_path);
            }
            $data["pdf_path"] = $request
                ->file("pdf_path")
                ->store("autoridades/pdfs", "public");
        }

        $autoridad->update($data);

        return redirect()
            ->route("admin.autoridades.index")
            ->with("success", "Autoridad actualizada exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autoridad $autoridad)
    {
        // Eliminar foto del almacenamiento
        if (
            $autoridad->foto_path &&
            Storage::disk("public")->exists($autoridad->foto_path)
        ) {
            Storage::disk("public")->delete($autoridad->foto_path);
        }

        // Eliminar PDF del almacenamiento
        if (
            $autoridad->pdf_path &&
            Storage::disk("public")->exists($autoridad->pdf_path)
        ) {
            Storage::disk("public")->delete($autoridad->pdf_path);
        }

        $autoridad->delete();

        return redirect()
            ->route("admin.autoridades.index")
            ->with("success", "Autoridad eliminada exitosamente.");
    }

    /**
     * Genera un slug único para la autoridad.
     *
     * @param string $title
     * @param int|null $exceptId ID de la autoridad a excluir para evitar conflictos consigo mismo
     * @return string
     */
    protected function generateUniqueSlug(
        string $title,
        ?int $exceptId = null,
    ): string {
        $originalSlug = Str::slug($title);
        $slug = $originalSlug;
        $count = 1;

        while (
            Autoridad::where("slug", $slug)
                ->when($exceptId, function ($query) use ($exceptId) {
                    return $query->where("id", "!=", $exceptId);
                })
                ->exists()
        ) {
            $count++;
            $slug = $originalSlug . "-" . $count;
        }

        return $slug;
    }
}
