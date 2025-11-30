<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicModality;
use Illuminate\Http\Request;

class AcademicModalityController extends Controller
{
    public function index()
    {
        $modalities = AcademicModality::orderBy('order')->get();
        return view('admin.academic_modalities.index', compact('modalities'));
    }

    public function create()
    {
        return view('admin.academic_modalities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);
        AcademicModality::create($data);
        return redirect()->route('admin.academic_modalities.index')->with('success', 'Modalidad creada correctamente.');
    }

    public function edit(AcademicModality $academicModality)
    {
        return view('admin.academic_modalities.edit', compact('academicModality'));
    }

    public function update(Request $request, AcademicModality $academicModality)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);
        $academicModality->update($data);
        return redirect()->route('admin.academic_modalities.index')->with('success', 'Modalidad actualizada correctamente.');
    }

    public function destroy(AcademicModality $academicModality)
    {
        $academicModality->delete();
        return redirect()->route('admin.academic_modalities.index')->with('success', 'Modalidad eliminada.');
    }
}
