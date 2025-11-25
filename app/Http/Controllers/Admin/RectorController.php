<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RectorController extends Controller
{
    public function index()
    {
        $rector = Rector::first();
        return view('admin.rector.index', ['rector' => $rector]);
    }

    public function create()
    {
        return view('admin.rector.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'academic_title' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rectors', 'public');
            $data['image_path'] = $path;
        }

        $data['is_active'] = $request->has('is_active') ? (bool)$request->input('is_active') : true;

        Rector::create($data);

        return redirect()->route('admin.contents.rector.index')->with('success', 'Rector creado.');
    }

    public function edit()
    {
        $rector = Rector::first();
        return view('admin.rector.edit', ['rector' => $rector]);
    }

    public function update(Request $request)
    {
        $rector = Rector::first();
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'academic_title' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('image')) {
            // eliminar anterior si existe
            if ($rector && $rector->image_path) {
                Storage::disk('public')->delete($rector->image_path);
            }
            $path = $request->file('image')->store('rectors', 'public');
            $data['image_path'] = $path;
        }

        $data['is_active'] = $request->has('is_active') ? (bool)$request->input('is_active') : true;

        if ($rector) {
            $rector->update($data);
        } else {
            Rector::create($data);
        }

        return redirect()->route('admin.contents.rector.index')->with('success', 'Rector actualizado.');
    }
}
