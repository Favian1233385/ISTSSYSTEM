<?php

namespace App\Http\Controllers;

use App\Models\AcademicSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AcademicSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function index()
    {
        $sections = AcademicSection::with('careers')->ordered()->get();
        return view('admin.academic-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.academic-sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        AcademicSection::create($request->all());

        return redirect()->route('admin.academic-sections.index')->with('success', 'Sección académica creada exitosamente.');
    }

    public function show(AcademicSection $academicSection)
    {
        return view('admin.academic-sections.show', compact('academicSection'));
    }

    public function edit(AcademicSection $academicSection)
    {
        return view('admin.academic-sections.edit', compact('academicSection'));
    }

    public function update(Request $request, AcademicSection $academicSection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $academicSection->update($request->all());

        return redirect()->route('admin.academic-sections.index')->with('success', 'Sección académica actualizada exitosamente.');
    }

    public function destroy(AcademicSection $academicSection)
    {
        $academicSection->delete();

        return redirect()->route('admin.academic-sections.index')->with('success', 'Sección académica eliminada exitosamente.');
    }
}