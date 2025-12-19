<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'place' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'files.*' => 'nullable|mimes:pdf',
            'status' => 'required|in:published,draft',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'date' => $request->date,
            'place' => $request->place,
            'status' => $request->status,
        ]);

        // Guardar imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('events/images', 'public');
                $event->images()->create(['image_path' => $path]);
            }
        }

        // Guardar archivos
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('events/files', 'public');
                $event->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        // Guardar enlaces externos
        $links = $request->input('links', []);
        $labels = $request->input('link_labels', []);
        foreach ($links as $i => $url) {
            if ($url) {
                $event->links()->create([
                    'url' => $url,
                    'label' => $labels[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Evento creado correctamente');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'place' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'files.*' => 'nullable|mimes:pdf',
            'status' => 'required|in:published,draft',
        ]);

        $event->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'date' => $request->date,
            'place' => $request->place,
            'status' => $request->status,
        ]);

        // Eliminar imágenes seleccionadas
        if ($request->filled('delete_images')) {
            foreach ($request->delete_images as $imgId) {
                $img = $event->images()->find($imgId);
                if ($img) {
                    Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                }
            }
        }
        // Agregar nuevas imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('events/images', 'public');
                $event->images()->create(['image_path' => $path]);
            }
        }

        // Eliminar archivos seleccionados
        if ($request->filled('delete_files')) {
            foreach ($request->delete_files as $fileId) {
                $file = $event->files()->find($fileId);
                if ($file) {
                    Storage::disk('public')->delete($file->file_path);
                    $file->delete();
                }
            }
        }
        // Agregar nuevos archivos
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('events/files', 'public');
                $event->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        // Eliminar enlaces seleccionados
        if ($request->filled('delete_links')) {
            foreach ($request->delete_links as $linkId) {
                $link = $event->links()->find($linkId);
                if ($link) {
                    $link->delete();
                }
            }
        }
        // Actualizar enlaces existentes
        $editLinks = $request->input('links_edit', []);
        $editLabels = $request->input('link_labels_edit', []);
        $existingLinks = $event->links()->get();
        foreach ($existingLinks as $i => $link) {
            if (isset($editLinks[$i])) {
                $link->update([
                    'url' => $editLinks[$i],
                    'label' => $editLabels[$i] ?? null,
                ]);
            }
        }
        // Agregar nuevos enlaces
        $links = $request->input('links', []);
        $labels = $request->input('link_labels', []);
        foreach ($links as $i => $url) {
            if ($url) {
                $event->links()->create([
                    'url' => $url,
                    'label' => $labels[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Evento actualizado correctamente');
    }

    public function destroy(Event $event)
    {
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Evento eliminado correctamente');
    }
}
