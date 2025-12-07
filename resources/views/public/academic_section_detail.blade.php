@extends('layouts.site')

@section('content')
<div class="content-detail">
    <div class="container">
        <div class="page-header">
            <h1>{{ $section->title }}</h1>
            @if($section->description)
                <p class="lead">{{ $section->description }}</p>
            @endif
        </div>

        <div class="content-body">
            @if($section->image_path)
                <div class="section-image">
                    <img src="{{ str_starts_with($section->image_path, '/') ? asset(ltrim($section->image_path, '/')) : asset('storage/' . $section->image_path) }}" alt="{{ $section->title }}" class="img-fluid">
                </div>
            @endif

            @if($section->content)
                <div class="section-section">
                    <h2>Contenido</h2>
                    {!! $section->content !!}
                </div>
            @endif
        </div>

        {{-- Listado de Programas/Cursos de la Modalidad --}}
        @if($section->careers && $section->careers->count() > 0)
            <div class="programs-list" style="margin-top: 3rem;">
                <h2 style="border-bottom: 2px solid #eee; padding-bottom: 0.5rem; margin-bottom: 1.5rem;">Cursos Disponibles</h2>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($section->careers as $program)
                        <a href="{{ $program->url ?? '#' }}" target="_blank" style="text-decoration: none; color: inherit; display: block; padding: 1.5rem; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: all 0.2s ease-in-out; {{ $program->url ? '' : 'pointer-events: none; opacity: 0.6;' }}">
                            <h5 style="margin-bottom: 0.5rem; color: #0056b3;">{{ $program->title }}</h5>
                            @if($program->description)
                                <p style="margin-bottom: 1rem; color: #6c757d;">{{ Str::limit($program->description, 150) }}</p>
                            @endif
                            <span style="background-color: #007bff; color: white; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer;">Ir al curso</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
