<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (!$user || ($user->role ?? null) !== 'admin') {
                return redirect('/login');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $items = MenuItem::whereNull('parent_id')->with('children')->orderBy('order')->get();
        return view('admin.crud.menu_items.index', compact('items'));
    }

    public function create()
    {
        $parents = MenuItem::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.crud.menu_items.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        MenuItem::create($request->all());

        return redirect()->route('admin.menu_items.index')->with('success', 'Elemento del menú creado exitosamente.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = MenuItem::findOrFail($id);
        $parents = MenuItem::whereNull('parent_id')->where('id', '!=', $id)->orderBy('order')->get();
        return view('admin.crud.menu_items.edit', compact('item', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $item = MenuItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.menu_items.index')->with('success', 'Elemento del menú actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $item = MenuItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.menu_items.index')->with('success', 'Elemento del menú eliminado exitosamente.');
    }
}
