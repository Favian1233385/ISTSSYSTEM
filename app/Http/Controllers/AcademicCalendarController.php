<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendarEvent;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    // Vista pública del calendario académico
    public function index()
    {
        $events = AcademicCalendarEvent::all();
        $calendarEvents = $events->map(function($event) {
            return [
                'title' => $event->title,
                'start' => $event->start_date->format('Y-m-d'),
                'end' => $event->end_date->format('Y-m-d'),
                'color' => $event->color,
                'description' => $event->description,
            ];
        });
        return view('public.academic_calendar.index', [
            'calendarEvents' => $calendarEvents
        ]);
    }

    // Admin: listado de eventos
    public function adminIndex()
    {
        $events = AcademicCalendarEvent::orderBy('start_date', 'desc')->paginate(20);
        return view('admin.academic_calendar.index', compact('events'));
    }

    // Admin: formulario de creación
    public function create()
    {
        return view('admin.academic_calendar.create');
    }

    // Admin: guardar evento
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'color' => 'nullable|string|max:20',
        ]);
        AcademicCalendarEvent::create($data);
        return redirect()->route('admin.academic-calendar.index')->with('success', 'Evento creado correctamente');
    }

    // Admin: formulario de edición
    public function edit(AcademicCalendarEvent $event)
    {
        return view('admin.academic_calendar.edit', compact('event'));
    }

    // Admin: actualizar evento
    public function update(Request $request, AcademicCalendarEvent $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'color' => 'nullable|string|max:20',
        ]);
        $event->update($data);
        return redirect()->route('admin.academic-calendar.index')->with('success', 'Evento actualizado correctamente');
    }

    // Admin: eliminar evento
    public function destroy(AcademicCalendarEvent $event)
    {
        $event->delete();
        return redirect()->route('admin.academic-calendar.index')->with('success', 'Evento eliminado correctamente');
    }
}
