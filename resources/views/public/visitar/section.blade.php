@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">{{ $section->title }}</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                @if($section->mission)
                <h2 class="section-title">Nuestra Misión</h2>
                <p>{{ $section->mission }}</p>
                @endif

                @if($section->functions && count($section->functions) > 0)
                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    @foreach($section->functions as $function)
                        <li>{{ $function }}</li>
                    @endforeach
                </ul>
                @endif

                @if($section->additional_info)
                <div class="mt-4">
                    <p>{{ $section->additional_info }}</p>
                </div>
                @endif

                @if($section->schedule || $section->location || $section->phone || $section->email)
                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    @if($section->schedule)
                        <p><strong>Horario de Atención:</strong> {{ $section->schedule }}</p>
                    @endif
                    @if($section->location)
                        <p><strong>Ubicación:</strong> {{ $section->location }}</p>
                    @endif
                    @if($section->phone)
                        <p><strong>Teléfono:</strong> {{ $section->phone }}</p>
                    @endif
                    @if($section->email)
                        <p><strong>Email:</strong> {{ $section->email }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
