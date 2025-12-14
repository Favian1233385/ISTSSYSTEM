@extends('public.layout')

@section('content')
<div class="container py-4">
    <a href="{{ route('public.events.index') }}" class="btn btn-secondary mb-3">← Volver a eventos</a>
    <div class="row">
        <div class="col-md-8">
            <h1 style="margin-top:2cm; text-align:center; font-size:2.2rem; font-weight:800; color:#00796b; margin-bottom:1.2rem; letter-spacing:-1px;">
                {{ $event->title }}
            </h1>
            <p><strong>Fecha:</strong> {{ $event->date->format('d/m/Y') }}</p>
            <p><strong>Lugar:</strong> {{ $event->place }}</p>
            <div class="mb-3">{!! $event->description !!}</div>
            @if($event->files->count())
                <h5>Archivos adjuntos</h5>
                <ul>
                    @foreach($event->files as $file)
                        <li><a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ $file->file_name }}</a></li>
                    @endforeach
                </ul>
            @endif
            @if($event->links->count())
                <h5>Enlaces relacionados</h5>
                <ul>
                    @foreach($event->links as $link)
                        <li><a href="{{ $link->url }}" target="_blank">{{ $link->label ?: $link->url }}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-md-4">
            @if($event->images->count())
                <div id="eventGallery" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($event->images as $img)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="d-block w-100" alt="Imagen evento">
                            </div>
                        @endforeach
                    </div>
                    {{-- Controles de carrusel eliminados por requerimiento --}}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
