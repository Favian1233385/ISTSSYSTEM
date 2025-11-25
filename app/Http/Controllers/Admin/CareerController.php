<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\AcademicSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::ordered()->get();
        return view("admin.careers.index", compact("careers"));
    }

    public function create()
    {
        $academicSections = AcademicSection::ordered()->get();
        return view("admin.careers.create", compact("academicSections"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "academic_section_id" => "nullable|exists:academic_sections,id",
            "name" => "required|string|max:255",
            "slug" => "nullable|string|max:255|unique:careers,slug",
            "description" => "nullable|string",
            "full_description" => "nullable|string",
            "professional_profile" => "nullable|string",
            "coordinator" => "nullable|string|max:255",
            "coordinator_email" => "nullable|email|max:255",
            "image" => "nullable|image|mimes:jpeg,jpg,png,webp|max:2048",
            "image_2" => "nullable|image|mimes:jpeg,jpg,png,webp|max:2048",
            "curriculum_pdf" => "nullable|file|mimes:pdf|max:5120",
            "sort_order" => "nullable|integer",
        ]);

        // Generar slug si no se proporciona
        if (empty($validated["slug"])) {
            $validated["slug"] = Str::slug($validated["name"]);
        }

        // Manejar la carga de imagen principal
        if ($request->hasFile("image")) {
            $validated["image_path"] = $request
                ->file("image")
                ->store("careers", "public");
        }

        // Manejar la carga de imagen secundaria
        if ($request->hasFile("image_2")) {
            $validated["image_path_2"] = $request
                ->file("image_2")
                ->store("careers", "public");
        }

        // Manejar la carga de PDF de malla curricular
        if ($request->hasFile("curriculum_pdf")) {
            $validated["curriculum_pdf"] = $request
                ->file("curriculum_pdf")
                ->store("careers/curriculum", "public");
        }

        // Asegurar valores por defecto
        $validated["is_active"] = $request->has("is_active") ? true : false;
        $validated["sort_order"] = $validated["sort_order"] ?? 0;

        Career::create($validated);

        return redirect()
            ->route("admin.careers.index")
            ->with("success", "Carrera creada exitosamente.");
    }

    public function edit(Career $career)
    {
        $academicSections = AcademicSection::ordered()->get();
        return view(
            "admin.careers.edit",
            compact("career", "academicSections"),
        );
    }

    public function update(Request $request, Career $career)
    {
        try {
            $validated = $request->validate([
                "academic_section_id" => "nullable|exists:academic_sections,id",
                "name" => "required|string|max:255",
                "slug" =>
                    "nullable|string|max:255|unique:careers,slug," .
                    $career->id,
                "description" => "nullable|string",
                "full_description" => "nullable|string",
                "professional_profile" => "nullable|string",
                "coordinator" => "nullable|string|max:255",
                "coordinator_email" => "nullable|email|max:255",
                "image" => "nullable|image|mimes:jpeg,jpg,png,webp|max:2048",
                "image_2" => "nullable|image|mimes:jpeg,jpg,png,webp|max:2048",
                "curriculum_pdf" => "nullable|file|mimes:pdf|max:5120",
                "sort_order" => "nullable|integer",
            ]);

            // Generar slug si no se proporciona
            if (empty($validated["slug"])) {
                $validated["slug"] = Str::slug($validated["name"]);
            }

            // Manejar la carga de imagen principal
            if ($request->hasFile("image")) {
                \Log::info(
                    "Subiendo imagen principal para carrera: " . $career->name,
                );

                if ($request->file("image")->isValid()) {
                    if ($career->image_path) {
                        Storage::disk("public")->delete($career->image_path);
                    }

                    $imagePath = $request
                        ->file("image")
                        ->store("careers", "public");
                    $validated["image_path"] = $imagePath;
                    \Log::info("Imagen principal guardada en: " . $imagePath);
                } else {
                    \Log::error("Imagen principal no válida");
                    return redirect()
                        ->back()
                        ->with(
                            "error",
                            "El archivo de imagen principal no es válido.",
                        )
                        ->withInput();
                }
            }

            // Manejar la carga de imagen secundaria
            if ($request->hasFile("image_2")) {
                \Log::info(
                    "Subiendo imagen secundaria para carrera: " . $career->name,
                );

                if ($request->file("image_2")->isValid()) {
                    if ($career->image_path_2) {
                        Storage::disk("public")->delete($career->image_path_2);
                    }

                    $imagePath2 = $request
                        ->file("image_2")
                        ->store("careers", "public");
                    $validated["image_path_2"] = $imagePath2;
                    \Log::info("Imagen secundaria guardada en: " . $imagePath2);
                } else {
                    \Log::error("Imagen secundaria no válida");
                    return redirect()
                        ->back()
                        ->with(
                            "error",
                            "El archivo de imagen secundaria no es válido.",
                        )
                        ->withInput();
                }
            }

            // Manejar la carga de PDF de malla curricular
            if ($request->hasFile("curriculum_pdf")) {
                \Log::info(
                    "Subiendo PDF de malla curricular para carrera: " .
                        $career->name,
                );

                if ($request->file("curriculum_pdf")->isValid()) {
                    if ($career->curriculum_pdf) {
                        Storage::disk("public")->delete(
                            $career->curriculum_pdf,
                        );
                    }

                    $pdfPath = $request
                        ->file("curriculum_pdf")
                        ->store("careers/curriculum", "public");
                    $validated["curriculum_pdf"] = $pdfPath;
                    \Log::info(
                        "PDF de malla curricular guardado en: " . $pdfPath,
                    );
                } else {
                    \Log::error("PDF de malla curricular no válido");
                    return redirect()
                        ->back()
                        ->with("error", "El archivo PDF no es válido.")
                        ->withInput();
                }
            }

            $validated["is_active"] = $request->has("is_active") ? true : false;

            $career->update($validated);

            $message = "Carrera actualizada exitosamente";
            if (
                $request->hasFile("image") ||
                $request->hasFile("image_2") ||
                $request->hasFile("curriculum_pdf")
            ) {
                $message .= " (con archivos)";
            }

            return redirect()
                ->route("admin.careers.index")
                ->with("success", $message);
        } catch (\Exception $e) {
            \Log::error("Error actualizando carrera: " . $e->getMessage());
            return redirect()
                ->back()
                ->with(
                    "error",
                    "Error al actualizar la carrera: " . $e->getMessage(),
                )
                ->withInput();
        }
    }

    public function destroy(Career $career)
    {
        // Eliminar imagen si existe
        if ($career->image_path) {
            Storage::disk("public")->delete($career->image_path);
        }

        $career->delete();

        return redirect()
            ->route("admin.careers.index")
            ->with("success", "Carrera eliminada exitosamente.");
    }
}
