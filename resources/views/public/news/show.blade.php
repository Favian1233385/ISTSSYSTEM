@extends('layouts.site')

@section('content')
    <div class="container">
        <h1>{{ $news['title'] ?? 'Noticia' }}</h1>
        <p class="meta">{{ optional(\Carbon\Carbon::parse($news['published_at'] ?? null))->format('d/m/Y') }}</p>
        @if(isset($news['images']) && is_array($news['images']) && count($news['images']) > 0)
            <div class="news-gallery" style="margin-bottom: 1.5rem;">
                @foreach($news['images'] as $img)
                    <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="Imagen noticia" style="max-width: 220px; margin-right: 8px; margin-bottom: 8px; display:inline-block;">
                @endforeach
            </div>
        @endif
        <div class="body">
            {!! $news['content'] ?? ($news['summary'] ?? '') !!}
        </div>
        <p><a href="{{ url(ltrim(($base ?? '') . '/noticias','/')) }}">Volver a Noticias</a></p>
    </div>
@endsection
