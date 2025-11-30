<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Content; // Usar el modelo Content personalizado
use App\Models\AcademicSection; // Usar el modelo correcto para modalidades
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    /**
     * Muestra el formulario de inscripción.
     *
     * @param int $programa_id
     * @return \Illuminate\Http\Response
     */
    public function create($programa_id)
    {
        // Utilizar el modelo Content personalizado para buscar el programa
        $contentModel = new Content();
        $programa = $contentModel->findById($programa_id);

        if (!$programa) {
            abort(404, "Programa no encontrado.");
        }

        // El modelo Content personalizado devuelve un array, por lo que usamos la sintaxis de array
        $modalidad_id = $programa["parent_id"] ?? null;
        $modalidad = null;
        if ($modalidad_id) {
            // Usar el modelo AcademicSection para encontrar la modalidad
            $modalidad = AcademicSection::find($modalidad_id);
        }

        if (!$modalidad) {
            // Si no se encuentra la modalidad, es un problema grave, pero manejamos el error
            abort(404, "Modalidad no encontrada para este programa.");
        }

        // El controlador anterior pasaba un objeto, ahora pasamos un array. La vista se adaptará.
        return view("public.inscripcion", compact("programa", "modalidad"));
    }

    /**
     * Almacena una nueva inscripción en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "nombre" => "required|string|max:255",
            "cedula" => "nullable|string|max:50",
            "email" => "required|email|max:255",
            "telefono" => "nullable|string|max:50",
            "especialidad" => "nullable|string|max:255",
            "modalidad_id" => "required|exists:academic_sections,id",
            "programa_id" => "required|exists:contents,id",
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
