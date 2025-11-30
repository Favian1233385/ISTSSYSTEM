<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;

class InscripcionAdminController extends Controller
{
    public function index(Request $request)
    {
        $programa_id = $request->query('programa_id');
        $query = Inscripcion::with(['programa', 'modalidad']);
        if ($programa_id) {
            $query->where('programa_id', $programa_id);
        }
        $inscripciones = $query->orderByDesc('created_at')->paginate(20);
        $programas = AcademicProgram::orderBy('title')->get();
        return view('admin.inscripciones.index', compact('inscripciones', 'programas', 'programa_id'));
    }
    // (Opcional) Método para exportar a Excel/CSV
}
