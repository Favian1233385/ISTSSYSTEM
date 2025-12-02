<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\AcademicProgram; // Original model
use App\Models\AcademicModality; // Original model
use App\Models\AcademicSection; // Keep this one for validation if still needed
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    // Mostrar formulario de inscripción
    public function create($programa_id)
    {
        $programa = AcademicProgram::findOrFail($programa_id);
        $modalidad = $programa->modality ?? null; // Original relationship was $programa->modality
        return view("public.inscripcion", compact("programa", "modalidad"));
    }

    // Guardar inscripción
    public function store(Request $request)
    {
        $validated = $request->validate([
            "nombre" => "required|string|max:255",
            "cedula" => "nullable|string|max:50",
            "email" => "required|email|max:255",
            "telefono" => "nullable|string|max:50",
            "especialidad" => "nullable|string|max:255",
            // Corrected this earlier to academic_sections, assuming it's the correct table for modalities
            "modalidad_id" => "required|exists:academic_sections,id",
            // The original logic assumes programs are in academic_programs
            // This was previously changed to contents, but we are reverting to original understanding
            "programa_id" => "required|exists:academic_programs,id",
            "observaciones" => "nullable|string",
        ]);

        // Validar duplicidad solo si hay cédula
        if (!empty($validated["cedula"])) {
            $existe = Inscripcion::where("cedula", $validated["cedula"])
                ->where("programa_id", $validated["programa_id"])
                ->exists();
            if ($existe) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        "error",
                        "Usted ya está inscrito en este curso con esa cédula.",
                    );
            }
        }

        Inscripcion::create($validated);
        return redirect()
            ->back()
            ->with("success", "¡Inscripción realizada correctamente!");
    }
}
