<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicProgram;
use App\Models\AcademicModality;
use Illuminate\Http\Request;

class AcademicProgramController extends Controller
{
    public function index($modalityId)
    {
        $modality = AcademicModality::findOrFail($modalityId);
        $programs = $modality->programs()->orderBy('order')->get();
        return view('admin.academic_programs.index', compact('modality', 'programs'));
    }

    public function create($modalityId)
    {
        $modality = AcademicModality::findOrFail($modalityId);
        return view('admin.academic_programs.create', compact('modality'));
    }

    public function store(Request $request, $modalityId)
    {
        $modality = AcademicModality::findOrFail($modalityId);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'document' => 'nullable|file|mimes:pdf|max:5120',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'registration_url' => 'nullable|url',
            'registration_enabled' => 'nullable|boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);
        $data['academic_modality_id'] = $modality->id;
        $data['registration_enabled'] = $request->has('registration_enabled');
        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('programs', 'public');
        }
        AcademicProgram::create($data);
        return redirect()->route('admin.academic_modalities.programs.index', $modality->id)->with('success', 'Programa creado correctamente.');
    }

    public function edit($modalityId, AcademicProgram $academicProgram)
    {
        $modality = AcademicModality::findOrFail($modalityId);
        return view('admin.academic_programs.edit', compact('modality', 'academicProgram'));
    }

    public function update(Request $request, $modalityId, AcademicProgram $academicProgram)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'document' => 'nullable|file|mimes:pdf|max:5120',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'registration_url' => 'nullable|url',
            'registration_enabled' => 'nullable|boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);
        $data['registration_enabled'] = $request->has('registration_enabled');
        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('programs', 'public');
        }
        $academicProgram->update($data);
        return redirect()->route('admin.academic_modalities.programs.index', $modalityId)->with('success', 'Programa actualizado correctamente.');
    }

    public function destroy($modalityId, AcademicProgram $academicProgram)
    {
        $academicProgram->delete();
        return redirect()->route('admin.academic_modalities.programs.index', $modalityId)->with('success', 'Programa eliminado.');
    }
}
