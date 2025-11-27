<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $items = About::all();
        return view('admin.about.index', compact('items'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'pdf' => 'nullable|file|mimes:pdf',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('about', 'public');
        }
        About::create($data);
        return redirect()->route('about.index')->with('success', 'Elemento creado correctamente');
    }

    public function edit($id)
    {
        $item = About::findOrFail($id);
        return view('admin.about.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = About::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'pdf' => 'nullable|file|mimes:pdf',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('about', 'public');
        }
        $item->update($data);
        return redirect()->route('about.index')->with('success', 'Elemento actualizado correctamente');
    }

    public function destroy($id)
    {
        $item = About::findOrFail($id);
        $item->delete();
        return redirect()->route('about.index')->with('success', 'Elemento eliminado correctamente');
    }
}
