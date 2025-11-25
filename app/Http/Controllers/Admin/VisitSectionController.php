<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VisitSectionController extends Controller
{
    /**
     * Display a listing of visit sections.
     */
    public function index()
    {
        $sections = VisitSection::ordered()->paginate(15);
        return view('admin.visit-sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new visit section.
     */
    public function create()
    {
        return view('admin.visit-sections.create');
    }

    /**
     * Store a newly created visit section in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:visit_sections,slug',
            'mission' => 'nullable|string',
            'functions' => 'nullable|array',
            'functions.*' => 'nullable|string',
            'schedule' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'additional_info' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        // Generar slug si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Filtrar funciones vacías
        if (isset($validated['functions'])) {
            $validated['functions'] = array_filter($validated['functions'], function($item) {
                return !empty(trim($item));
            });
        }

        $validated['is_active'] = $request->has('is_active');

        VisitSection::create($validated);

        return redirect()->route('admin.visit-sections.index')
            ->with('success', 'Sección creada exitosamente.');
    }

    /**
     * Show the form for editing the specified visit section.
     */
    public function edit(VisitSection $visitSection)
    {
        return view('admin.visit-sections.edit', compact('visitSection'));
    }

    /**
     * Update the specified visit section in storage.
     */
    public function update(Request $request, VisitSection $visitSection)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:visit_sections,slug,' . $visitSection->id,
                'mission' => 'nullable|string',
                'functions' => 'nullable|array',
                'functions.*' => 'nullable|string',
                'schedule' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:255',
                'additional_info' => 'nullable|string',
                'sort_order' => 'nullable|integer',
            ]);

            // Generar slug si no se proporciona
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['title']);
            }

            // Filtrar funciones vacías
            if (isset($validated['functions'])) {
                $validated['functions'] = array_filter($validated['functions'], function($item) {
                    return !empty(trim($item));
                });
                // Re-indexar el array después del filtro
                $validated['functions'] = array_values($validated['functions']);
            } else {
                $validated['functions'] = [];
            }

            $validated['is_active'] = $request->has('is_active');

            // Actualizar
            $visitSection->update($validated);

            // Log para debugging
            \Log::info('VisitSection actualizada', [
                'id' => $visitSection->id,
                'datos' => $validated
            ]);

            return redirect()->route('admin.visit-sections.index')
                ->with('success', 'Sección actualizada exitosamente. Horario: ' . ($validated['schedule'] ?? 'N/A') . ', Tel: ' . ($validated['phone'] ?? 'N/A'));
        } catch (\Exception $e) {
            \Log::error('Error actualizando VisitSection: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified visit section from storage.
     */
    public function destroy(VisitSection $visitSection)
    {
        $visitSection->delete();

        return redirect()->route('admin.visit-sections.index')
            ->with('success', 'Sección eliminada exitosamente.');
    }
}
