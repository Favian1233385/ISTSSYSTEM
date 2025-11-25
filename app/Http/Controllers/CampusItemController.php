<?php

namespace App\Http\Controllers;

use App\Models\CampusItem;
use Illuminate\Http\Request;

class CampusItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campusItems = CampusItem::ordered()->get();
        return view('admin.campus-items.index', compact('campusItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.campus-items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|max:255',
            'content' => 'nullable|string',
            'is_external' => 'boolean',
            'category' => 'required|in:coordinaciones,servicios',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        // Subir PDF si existe
        $pdfUrl = null;
        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $filename = uniqid() . '-' . preg_replace("/[^A-Za-z0-9_.-]/", "", $pdf->getClientOriginalName());
            $destination = public_path('uploads/pdfs');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $pdf->move($destination, $filename);
            $pdfUrl = '/uploads/pdfs/' . $filename;
        }

        $campusItem = CampusItem::create(array_merge($validated, ['pdf_url' => $pdfUrl]));

        // Manejar la subida de imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('campus-items', 'public');
                $campusItem->images()->create([
                    'image_path' => 'storage/' . $path,
                    'order' => $index
                ]);
            }
        }

        return redirect()->route('admin.campus-items.index')
            ->with('success', 'Item del campus creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampusItem $campusItem)
    {
        return view('admin.campus-items.edit', compact('campusItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampusItem $campusItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|max:255',
            'content' => 'nullable|string',
            'is_external' => 'boolean',
            'category' => 'required|in:coordinaciones,servicios',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $campusItem->update($validated);

        // Manejar la subida de nuevas imágenes
        if ($request->hasFile('images')) {
            $currentMaxOrder = $campusItem->images()->max('order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('campus-items', 'public');
                $campusItem->images()->create([
                    'image_path' => 'storage/' . $path,
                    'order' => $currentMaxOrder + $index + 1
                ]);
            }
        }

        return redirect()->route('admin.campus-items.index')
            ->with('success', 'Item del campus actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampusItem $campusItem)
    {
        // Eliminar imágenes del storage
        foreach ($campusItem->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
        }

        $campusItem->delete();

        return redirect()->route('admin.campus-items.index')
            ->with('success', 'Item del campus eliminado exitosamente.');
    }

    /**
     * Eliminar una imagen específica
     */
    public function destroyImage(CampusItem $campusItem, CampusItemImage $image)
    {
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }

        $image->delete();

        return back()->with('success', 'Imagen eliminada exitosamente.');
    }
}
