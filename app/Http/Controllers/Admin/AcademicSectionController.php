<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AcademicSectionController extends Controller
{
    public function index()
    {
        $sections = AcademicSection::orderBy('sort_order')->get();
        return view('admin.academic-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.academic-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:academic_sections,slug',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'sort_order' => 'nullable|integer'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('academic-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        AcademicSection::create($validated);

        return redirect()->route('admin.academic-sections.index')->with('success', 'Sección académica creada exitosamente.');
    }

    public function edit(AcademicSection $academicSection)
    {
        return view('admin.academic-sections.edit', compact('academicSection'));
    }

    public function update(Request $request, AcademicSection $academicSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:academic_sections,slug,' . $academicSection->id,
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'sort_order' => 'nullable|integer'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($academicSection->image_path) {
                Storage::disk('public')->delete($academicSection->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('academic-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;

        $academicSection->update($validated);

        return redirect()->route('admin.academic-sections.index')->with('success', 'Sección académica actualizada exitosamente.');
    }

    public function destroy(AcademicSection $academicSection)
    {
        if ($academicSection->image_path) {
            Storage::disk('public')->delete($academicSection->image_path);
        }

        $academicSection->delete();

        return redirect()->route('admin.academic-sections.index')->with('success', 'Sección académica eliminada exitosamente.');
    }
}
