<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::ordered()->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'link' => 'nullable|url',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hero-slides', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide creado exitosamente.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'link' => 'nullable|url',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($heroSlide->image_path) {
                Storage::disk('public')->delete($heroSlide->image_path);
            }
            $imagePath = $request->file('image')->store('hero-slides', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide actualizado exitosamente.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->image_path) {
            Storage::disk('public')->delete($heroSlide->image_path);
        }

        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide eliminado exitosamente.');
    }
}
