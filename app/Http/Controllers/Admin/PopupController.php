<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Popup;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function index()
    {
        $popups = Popup::orderByDesc('created_at')->get();
        return view('admin.popups.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.popups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'message' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        $data = $request->only(['message', 'link', 'is_active', 'fecha_inicio', 'fecha_fin']);
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('popups', 'public');
        }
        Popup::create($data);
        return redirect()->route('admin.popups.index')->with('success', 'PopUp creado correctamente');
    }

    public function edit(Popup $popup)
    {
        return view('admin.popups.edit', compact('popup'));
    }

    public function update(Request $request, Popup $popup)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'message' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        $data = $request->only(['message', 'link', 'is_active', 'fecha_inicio', 'fecha_fin']);
        if ($request->hasFile('image_path')) {
            if ($popup->image_path) {
                Storage::disk('public')->delete($popup->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('popups', 'public');
        }
        $popup->update($data);
        return redirect()->route('admin.popups.index')->with('success', 'PopUp actualizado correctamente');
    }

    public function destroy(Popup $popup)
    {
        if ($popup->image_path) {
            Storage::disk('public')->delete($popup->image_path);
        }
        $popup->delete();
        return redirect()->route('admin.popups.index')->with('success', 'PopUp eliminado correctamente');
    }
}
