@extends('layouts.site')

@section('header')
    @include('public.partials.header')
@endsection

@section('content')
<div class="content-detail">
    <div class="section-page-header">
        <div class="container">
            <h1 class="section-page-title">{{ $career->name }}</h1>
            @if($career->description)
                <p class="section-page-subtitle">{{ $career->description }}</p>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="content-body">
            {{-- Descripción: texto a la izquierda, imagen principal a la derecha --}}
            <div class="career-row" style="display: flex; flex-wrap: wrap; align-items: stretch; background: var(--color-white); border-radius: 18px; margin-bottom: 2.5rem; box-shadow: 0 6px 32px rgba(30,58,138,0.08); border: 1.5px solid #e5e7eb;">
                <div class="career-col-text" style="flex:1; min-width:250px; padding:2.5rem; display:flex; flex-direction:column; justify-content:center;">
                    <h2 style="font-size:1.3rem; margin-bottom:1rem; color: var(--color-primary); font-weight:600;">Descripción</h2>
                    <div style="color: var(--color-dark); font-size:1.05rem; line-height:1.7;">{!! $career->full_description !!}</div>
                </div>
                <div class="career-col-img" style="flex:1; min-width:250px; display:flex; align-items:center; justify-content:center; padding:2.5rem;">
                    @if($career->image_path)
                        <img src="{{ str_starts_with($career->image_path, '/') ? asset(ltrim($career->image_path, '/')) : asset('storage/' . $career->image_path) }}" alt="{{ $career->name }}" style="max-width:100%; max-height:320px; border-radius:14px; box-shadow:0 4px 24px rgba(0,0,0,0.10);">
                    @else
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='gray'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white' font-size='24'%3EImagen%3C/text%3E%3C/svg%3E" alt="Sin imagen" style="max-width:100%; max-height:320px; border-radius:14px;">
                    @endif
                </div>
            </div>

            {{-- Perfil Profesional: imagen secundaria a la izquierda, texto a la derecha --}}
            <div class="career-row" style="display: flex; flex-wrap: wrap; align-items: stretch; background: var(--color-white); border-radius: 18px; margin-bottom: 2.5rem; box-shadow: 0 6px 32px rgba(30,58,138,0.08); border: 1.5px solid #e5e7eb;">
                <div class="career-col-img" style="flex:1; min-width:250px; display:flex; align-items:center; justify-content:center; padding:2.5rem;">
                    @if($career->image_path_2)
                        <img src="{{ str_starts_with($career->image_path_2, '/') ? asset(ltrim($career->image_path_2, '/')) : asset('storage/' . $career->image_path_2) }}" alt="{{ $career->name }}" style="max-width:100%; max-height:320px; border-radius:14px; box-shadow:0 4px 24px rgba(0,0,0,0.10);">
                    @else
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='gray'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white' font-size='24'%3EImagen%3C/text%3E%3C/svg%3E" alt="Sin imagen" style="max-width:100%; max-height:320px; border-radius:14px;">
                    @endif
                </div>
                <div class="career-col-text" style="flex:1; min-width:250px; padding:2.5rem; display:flex; flex-direction:column; justify-content:center;">
                    <h2 style="font-size:1.3rem; margin-bottom:1rem; color: var(--color-primary); font-weight:600;">Perfil Profesional</h2>
                    <div style="color: var(--color-dark); font-size:1.05rem; line-height:1.7;">{!! $career->professional_profile !!}</div>
                </div>
            </div>

            @if($career->coordinator)
                <div class="career-coordinator" style="background: #f4f7fa; border-radius:14px; padding:1.5rem 2rem; margin-bottom:2rem; box-shadow:0 2px 12px rgba(30,58,138,0.04); border: 1.5px solid #e5e7eb;">
                    <h3 style="color: var(--color-primary); font-size:1.1rem; font-weight:600;">Coordinador</h3>
                    <p style="color: var(--color-dark); font-size:1rem;"><strong>{{ $career->coordinator }}</strong></p>
                    @if($career->coordinator_email)
                        <p style="color: var(--color-gray); font-size:0.98rem;">Email: <a href="mailto:{{ $career->coordinator_email }}">{{ $career->coordinator_email }}</a></p>
                    @endif
                </div>
            @endif

            @if($career->curriculum_pdf)
                <div class="career-pdf" style="background: #f4f7fa; border-radius:14px; padding:1.5rem 2rem; box-shadow:0 2px 12px rgba(30,58,138,0.04); border: 1.5px solid #e5e7eb;">
                    <h3 style="color: var(--color-primary); font-size:1.1rem; font-weight:600;">Malla Curricular</h3>
                    <a href="{{ str_starts_with($career->curriculum_pdf, '/') ? asset(ltrim($career->curriculum_pdf, '/')) : asset('storage/' . $career->curriculum_pdf) }}" target="_blank" class="btn me-2" style="background:#fff; color:#198754; border:none; border-radius:8px; font-weight:500; box-shadow:0 2px 8px rgba(30,58,138,0.07); transition:background 0.2s, color 0.2s;">
                        <i class="bi bi-file-earmark-pdf" style="font-size:1.1rem; margin-right:0.4em;"></i> Ver Malla Curricular
                    </a>
                    <a href="{{ str_starts_with($career->curriculum_pdf, '/') ? asset(ltrim($career->curriculum_pdf, '/')) : asset('storage/' . $career->curriculum_pdf) }}" download class="btn btn-success" style="border-radius:8px; font-weight:500; box-shadow:0 2px 8px rgba(30,58,138,0.07);">
                        <i class="bi bi-download" style="font-size:1.1rem; margin-right:0.4em;"></i> Descargar PDF
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection