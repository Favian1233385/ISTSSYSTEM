<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('order', 'asc')->orderBy('published_at', 'desc')->paginate(10);
        return view('admin.crud.news.list', compact('news'));
    }

    public function create()
    {
        return view('admin.crud.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'order' => 'nullable|integer|min:1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $images[] = $img->store('news', 'public');
            }
        }

        $news = News::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'summary' => $request->summary,
            'content' => $request->content,
            'order' => $request->order ?? 99,
            'images' => $images,
            'status' => $request->status ?? 'draft',
            'category' => $request->category ?? null,
            'featured' => $request->featured ?? false,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Noticia creada correctamente');
    }

    public function edit(News $news)
    {
        return view('admin.crud.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'order' => 'nullable|integer|min:1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);


        $images = $news->images ?? [];
        // Eliminar imágenes marcadas
        if ($request->has('remove_images')) {
            $toRemove = $request->input('remove_images');
            foreach ($toRemove as $idx) {
                if (isset($images[$idx])) {
                    // Opcional: eliminar físicamente el archivo
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($images[$idx]);
                    unset($images[$idx]);
                }
            }
            // Reindexar el array para evitar huecos
            $images = array_values($images);
        }
        // Agregar nuevas imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $images[] = $img->store('news', 'public');
            }
        }

        $slug = $news->slug;
        if ($request->title !== $news->title) {
            $slug = Str::slug($request->title) . '-' . uniqid();
        }
        $news->update([
            'title' => $request->title,
            'slug' => $slug,
            'summary' => $request->summary,
            'content' => $request->content,
            'order' => $request->order ?? 99,
            'images' => $images,
            'status' => $request->status ?? 'draft',
            'category' => $request->category ?? null,
            'featured' => $request->featured ?? false,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Noticia actualizada correctamente');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Noticia eliminada correctamente');
    }
}
