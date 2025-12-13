@extends('layouts.site')

@section('content')
    <div class="container" style="margin-top: 2.5cm; max-width: 950px;">
        <h1 style="font-size:2.6rem; font-weight:800; margin-bottom:0.5rem; position:relative; display:inline-block;">
            {{ $news['title'] ?? 'Noticia' }}
            <span style="display:block; height:5px; width:60px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:3px; margin-top:8px;"></span>
        </h1>
        <div style="color:#555; font-size:1.1rem; margin-bottom:1.5rem; display:flex; align-items:center; gap:0.5rem;">
            <span style="font-size:1.2rem; color:#3498db;">🗓️</span>
            {{ optional(\Carbon\Carbon::parse($news['published_at'] ?? null))->format('d/m/Y') }}
        </div>
        @if(isset($news['images']) && is_array($news['images']) && count($news['images']) > 0)
            <div class="news-gallery-grid" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:18px; margin-bottom:2.2rem;">
                @foreach($news['images'] as $img)
                    <div style="overflow:hidden; border-radius:12px; box-shadow:0 2px 12px rgba(52,152,219,0.08); background:#fff; transition:transform 0.2s, box-shadow 0.2s; cursor:pointer;">
                        <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="Imagen noticia" style="width:100%; display:block; transition:transform 0.2s; object-fit:cover; height:180px;" onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                @endforeach
            </div>
        @endif
        <div style="background:#fff; border-radius:18px; box-shadow:0 2px 16px rgba(44,62,80,0.08); padding:2.2rem 2rem; margin-bottom:2rem;">
            {!! $news['content'] ?? ($news['summary'] ?? '') !!}
        </div>
    </div>
@endsection
