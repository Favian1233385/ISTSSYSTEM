<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function index()
    {
        $updates = Update::orderBy('sort_order', 'asc')
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('admin.updates.index', [
            'title' => 'Actualizaciones/Novedades - ISTS Admin',
            'updates' => $updates
        ]);
    }

    public function create()
    {
        return view('admin.updates.create', [
            'title' => 'Nueva Actualización - ISTS Admin'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv,flv,webm|max:51200', // Max 50MB
            'video_url' => 'nullable|url|max:500',
            'link_url' => 'nullable|url|max:500',
            'link_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('updates', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video_path'] = $request->file('video')->store('updates/videos', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Update::create($validated);

        return redirect()->route('admin.updates.index')
            ->with('success', 'Actualización creada exitosamente.');
    }

    public function edit($id)
    {
        $update = Update::findOrFail($id);

        return view('admin.updates.edit', [
            'title' => 'Editar Actualización - ISTS Admin',
            'update' => $update
        ]);
    }

    public function update(Request $request, $id)
    {
        $update = Update::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv,flv,webm|max:51200', // Max 50MB
            'video_url' => 'nullable|url|max:500',
            'link_url' => 'nullable|url|max:500',
            'link_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($update->image_path) {
                Storage::disk('public')->delete($update->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('updates', 'public');
        }

        if ($request->hasFile('video')) {
            // Eliminar video anterior
            if ($update->video_path) {
                Storage::disk('public')->delete($update->video_path);
            }
            $validated['video_path'] = $request->file('video')->store('updates/videos', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? $update->sort_order;

        $update->update($validated);

        return redirect()->route('admin.updates.index')
            ->with('success', 'Actualización actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $update = Update::findOrFail($id);

        // Eliminar imagen
        if ($update->image_path) {
            Storage::disk('public')->delete($update->image_path);
        }

        // Eliminar video
        if ($update->video_path) {
            Storage::disk('public')->delete($update->video_path);
        }

        $update->delete();

        return redirect()->route('admin.updates.index')
            ->with('success', 'Actualización eliminada exitosamente.');
    }
}
