<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{

    public function index()
    {
        $links = SocialLink::all();
        return view('admin.social_links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social_links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'icon_svg' => 'required|string',
            'bg_color' => 'required|string|max:128',
        ]);
        SocialLink::create([
            'name' => $request->name,
            'url' => $request->url,
            'icon_svg' => $request->icon_svg,
            'bg_color' => $request->bg_color,
            'active' => $request->has('active'),
        ]);
        return redirect()->route('admin.social_links.index')->with('success', 'Red social creada correctamente.');
    }


    public function edit($id)
    {
        $link = SocialLink::findOrFail($id);
        return view('admin.social_links.edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $link = SocialLink::findOrFail($id);
        $request->validate([
            'url' => 'required|url',
            'icon_svg' => 'required|string',
            'bg_color' => 'required|string|max:128',
        ]);
        $link->update([
            'url' => $request->url,
            'icon_svg' => $request->icon_svg,
            'bg_color' => $request->bg_color,
            'active' => $request->has('active'),
        ]);
        return redirect()->route('admin.social_links.index')->with('success', 'Enlace actualizado correctamente.');
    }

    public function toggle($id)
    {
        $link = SocialLink::findOrFail($id);
        $link->active = !$link->active;
        $link->save();
        return redirect()->route('admin.social_links.index')->with('success', 'Estado actualizado.');
    }
}
