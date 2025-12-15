@extends('layouts.public')
@section('title', 'Admisión y Actualizaciones')
@section('content')
<div class="container py-5">
    <div style="margin-top:2cm"></div>
    <h1 class="mb-4" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 700;">Admisión y Últimas Actualizaciones</h1>
    <p class="mb-4" style="color: var(--color-secondary); font-size: 1.2rem;">Consulta aquí la información más reciente sobre procesos de admisión, requisitos y novedades institucionales.</p>

    @php
        $destacada = App\Models\Update::active()->ordered()->first();
    @endphp
    @if($destacada)
        <div class="mb-5 text-center">
            @if($destacada->video_url)
                <div class="mb-3">
                    <iframe width="560" height="315" src="{{ $destacada->video_url }}" frameborder="0" allowfullscreen style="max-width:100%;"></iframe>
                </div>
            @elseif($destacada->image_path)
                <div class="mb-3">
                    <img src="{{ asset($destacada->image_path) }}" alt="Actualización destacada" style="max-width:100%;height:auto;">
                </div>
            @endif
            <h2 style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 600;">{{ $destacada->title }}</h2>
            <p style="color: var(--color-secondary);">{{ $destacada->description }}</p>
        </div>
    @endif

    <div class="row">
        @foreach(App\Models\Update::orderBy('created_at', 'desc')->take(10)->get() as $update)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $update->title }}</h5>
                        <p class="card-text">{{ $update->description }}</p>
                        <small class="text-muted">{{ $update->created_at->format('d/m/Y') }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
