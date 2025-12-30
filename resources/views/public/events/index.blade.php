@extends('public.layout')

@section('header')
    @include('public.partials.event_header')
@endsection

@section('content')
<div class="container" style="margin-top:0; max-width:1100px;">
    <h1 style="
        font-size:2.3rem;
        font-weight:800;
        color:#00796b;
        margin-bottom:0.7rem;
        letter-spacing:-1px;
        text-align:center;
        position:relative;">
        Eventos Institucionales
        <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
    </h1>

    {{-- Banner destacado si existe en el primer evento publicado --}}
    @php
        $bannerEvent = $events->first(function($e) { return $e->banner_path; });
    @endphp
    @if($bannerEvent && $bannerEvent->banner_path)
        <div style="margin: 0 auto 2.2rem auto; max-width:900px; text-align:center;">
            @if($bannerEvent->banner_link)
                <a href="{{ $bannerEvent->banner_link }}" target="_blank" style="display:inline-block; text-decoration:none;">
                    <img src="{{ asset('storage/' . $bannerEvent->banner_path) }}" alt="Banner evento" style="width:100%; max-width:900px; border-radius:14px; box-shadow:0 2px 16px rgba(44,62,80,0.13);">
                </a>
            @else
                <img src="{{ asset('storage/' . $bannerEvent->banner_path) }}" alt="Banner evento" style="width:100%; max-width:900px; border-radius:14px; box-shadow:0 2px 16px rgba(44,62,80,0.13);">
            @endif
            @if($bannerEvent->banner_message)
                <div style="margin-top:0.7rem; font-size:1.18rem; font-weight:600; color:#1976d2;">{{ $bannerEvent->banner_message }}</div>
            @endif
        </div>
    @endif

    @if($events->count() === 0)
        <p>No hay eventos disponibles.</p>
    @else
        <div class="news-grid" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:32px; margin-top:2.2rem;">
            @foreach($events as $event)
                <div class="news-card" style="background:#fff; border-radius:18px; box-shadow:0 2px 16px rgba(44,62,80,0.08); overflow:hidden; display:flex; flex-direction:column;">
                    <div class="news-image" style="width:100%; height:180px; overflow:hidden; background:#f3f3f3;">
                        @if($event->images->count())
                            <img src="{{ asset('storage/' . ltrim($event->images->first()->image_path, '/')) }}" alt="{{ $event->title }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                        @else
                            <img src="{{ asset('storage/uploads/images/placeholder.jpg') }}" alt="{{ $event->title }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                        @endif
                    </div>
                    <div class="news-content" style="padding:1.3rem 1.2rem 1.2rem 1.2rem; flex:1; display:flex; flex-direction:column;">
                        <span class="news-category" style="display:inline-block; background:#10b981; color:#fff; font-size:0.98rem; font-weight:600; border-radius:8px; padding:2px 14px 2px 12px; margin-bottom:0.7rem;">{{ ucfirst($event->category ?? 'Evento') }}</span>
                        <h3 style="font-size:1.25rem; font-weight:700; margin-bottom:0.5rem; color:#222;">{{ $event->title }}</h3>
                        <div style="color:#888; font-size:0.98rem; margin-bottom:0.7rem;">
                            {{ optional($event->date)->format('d/m/Y') }}
                            @if($event->place)
                                &nbsp;|&nbsp;<span style="color:#1976d2;">{{ $event->place }}</span>
                            @endif
                        </div>
                        <p style="flex:1; color:#444; margin-bottom:1.1rem;">{{ \Illuminate\Support\Str::limit(strip_tags($event->description), 120) }}</p>
                        <a href="{{ route('public.events.show', $event->id) }}" class="read-more" style="color:#1976d2; font-weight:600; text-decoration:none;">Ver detalles →</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination" style="margin-top:2.5rem; text-align:center;">
            {{ $events->links() }}
        </div>
    @endif
</div>
@endsection
