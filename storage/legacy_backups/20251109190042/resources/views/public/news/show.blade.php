@extends('layouts.site')

@section('content')
    <div class="container">
        <h1>{{ $news['title'] ?? 'Noticia' }}</h1>
        <p class="meta">{{ optional(\Carbon\Carbon::parse($news['published_at'] ?? null))->format('d/m/Y') }}</p>
        <div class="body">
            {!! $news['content'] ?? ($news['summary'] ?? '') !!}
        </div>
    <p><a href="{{ url(ltrim(($base ?? '') . '/noticias','/')) }}">Volver a Noticias</a></p>
    </div>
@endsection
