<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $events = \App\Models\AcademicCalendarEvent::orderBy('start_date', 'desc')->paginate(10);
        return view('admin.academic_calendar.index', compact('events'));
    }

    public function create()
    {
        return view('admin.academic_calendar.create');
    }

    public function store(Request $request)
    {
        // Lógica para guardar un nuevo evento
    }

    public function show($id)
    {
        // Lógica para mostrar un evento específico
    }

    public function edit($id)
    {
        // Lógica para editar un evento
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un evento
    }

    public function destroy($id)
    {
        // Lógica para eliminar un evento
    }
}
