@extends('layouts.site')

@section('content')
    <div class="container">
        <h1>{{ $title ?? 'Noticias' }}</h1>

        @if($news->count() === 0)
            <p>No hay noticias publicadas.</p>
        @else
            <ul>
                @foreach($news as $n)
                    <li>
                        <a href="{{ url(ltrim(($base ?? '') . '/noticias/' . ($n->slug ?? $n->id), '/')) }}">{{ $n->title ?? 'Sin título' }}</a>
                        <div class="meta">{{ optional(\Carbon\Carbon::parse($n->published_at ?? null))->format('d/m/Y') }}</div>
                    </li>
                @endforeach
            </ul>

            <div class="pagination">
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection
