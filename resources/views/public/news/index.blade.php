@extends('layouts.site')

@section('content')
    <div class="container" style="margin-top:2.5cm; max-width:1100px;">
        <h1 style="
            font-size:2.3rem;
            font-weight:800;
            color:#00796b;
            margin-bottom:0.7rem;
            letter-spacing:-1px;
            text-align:center;
            position:relative;">
            Noticias
            <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
        </h1>
        @if($news->count() === 0)
            <p>No hay noticias publicadas.</p>
        @else
            <div class="news-grid" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:32px; margin-top:2.2rem;">
                @foreach($news as $n)
                    <div class="news-card" style="background:#fff; border-radius:18px; box-shadow:0 2px 16px rgba(44,62,80,0.08); overflow:hidden; display:flex; flex-direction:column;">
                        <div class="news-image" style="width:100%; height:180px; overflow:hidden; background:#f3f3f3;">
                            @if(is_array($n->images) && count($n->images) > 0)
                                <img src="{{ asset('storage/' . ltrim($n->images[0], '/')) }}" alt="{{ $n->title }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                            @else
                                <img src="{{ asset('storage/uploads/images/placeholder.jpg') }}" alt="{{ $n->title }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                            @endif
                        </div>
                        <div class="news-content" style="padding:1.3rem 1.2rem 1.2rem 1.2rem; flex:1; display:flex; flex-direction:column;">
                            <span class="news-category" style="display:inline-block; background:#10b981; color:#fff; font-size:0.98rem; font-weight:600; border-radius:8px; padding:2px 14px 2px 12px; margin-bottom:0.7rem;">{{ ucfirst($n->category ?? 'Noticias') }}</span>
                            <h3 style="font-size:1.25rem; font-weight:700; margin-bottom:0.5rem; color:#222;">{{ $n->title }}</h3>
                            <div style="color:#888; font-size:0.98rem; margin-bottom:0.7rem;">{{ optional(\Carbon\Carbon::parse($n->published_at ?? null))->format('d/m/Y') }}</div>
                            <p style="flex:1; color:#444; margin-bottom:1.1rem;">{{ \Illuminate\Support\Str::limit(strip_tags($n->summary), 120) }}</p>
                            <a href="{{ route('noticias.show', $n->slug) }}" class="read-more" style="color:#1976d2; font-weight:600; text-decoration:none;">Leer más →</a>
                        </div>
                    </div>
                @endforeach
                @if(isset($eventNews))
                    @foreach($eventNews as $event)
                        <div class="news-card" style="background:#fff; border-radius:18px; box-shadow:0 2px 16px rgba(44,62,80,0.08); overflow:hidden; display:flex; flex-direction:column;">
                            <div class="news-image" style="width:100%; height:180px; overflow:hidden; background:#f3f3f3;">
                                @if($event->images->count())
                                    <img src="{{ asset('storage/' . ltrim($event->images->first()->image_path, '/')) }}" alt="{{ $event->title }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                                @else
                                    <img src="{{ asset('storage/uploads/images/placeholder.jpg') }}" alt="{{ $event->title }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                                @endif
                            </div>
                            <div class="news-content" style="padding:1.3rem 1.2rem 1.2rem 1.2rem; flex:1; display:flex; flex-direction:column;">
                                <span class="news-category" style="display:inline-block; background:#1976d2; color:#fff; font-size:0.98rem; font-weight:600; border-radius:8px; padding:2px 14px 2px 12px; margin-bottom:0.7rem;">Evento pasado</span>
                                <h3 style="font-size:1.25rem; font-weight:700; margin-bottom:0.5rem; color:#222;">{{ $event->title }}</h3>
                                <div style="color:#888; font-size:0.98rem; margin-bottom:0.7rem;">{{ optional($event->date)->format('d/m/Y') }}</div>
                                <p style="flex:1; color:#444; margin-bottom:1.1rem;">{{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($event->description)), 120) }}</p>
                                <a href="{{ route('public.events.show', $event->id) }}" class="read-more" style="color:#1976d2; font-weight:600; text-decoration:none;">Ver detalles →</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="pagination" style="margin-top:2.5rem; text-align:center;">
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection
