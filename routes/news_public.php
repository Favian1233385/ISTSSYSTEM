// Ruta pública para ver una noticia individual por slug
Route::get('/noticias/{slug}', function($slug) {
    $news = \App\Models\News::where('slug', $slug)->where('status', 'published')->firstOrFail();
    return view('public.news.show', ['news' => $news]);
})->name('noticias.show');
