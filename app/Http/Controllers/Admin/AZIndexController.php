<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Career;
use App\Models\AcademicSection;
use App\Models\CampusItem;

class AZIndexController extends Controller
{
    public function index(Request $request)
    {
        // Personas: docentes, administrativos, autoridades
        $personas = User::orderBy('last_name')->get();
        // Áreas/Servicios: carreras, secciones, campus items
        $carreras = Career::orderBy('name')->get();
        $secciones = AcademicSection::orderBy('name')->get();
        $servicios = CampusItem::orderBy('title')->get();

        return view('admin.azindex.index', compact('personas', 'carreras', 'secciones', 'servicios'));
    }
}
