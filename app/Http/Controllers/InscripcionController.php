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

        if ($programa->url) {
            return redirect()->away($programa->url);
        }

        return redirect()
            ->back()
            ->with('error', 'El programa no tiene un enlace externo configurado.');
    }

    // Eliminar lógica de almacenamiento de inscripciones
    public function store(Request $request)
    {
        return abort(404, 'Esta funcionalidad ya no está disponible.');
    }
}
