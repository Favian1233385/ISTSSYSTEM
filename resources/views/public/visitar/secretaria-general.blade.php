@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Secretaría General</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Secretaría General del Instituto Superior Tecnológico Sucúa es el órgano responsable 
                    de la gestión administrativa y académica de la institución, garantizando el correcto 
                    funcionamiento de todos los procesos institucionales.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Gestión y custodia de documentos institucionales</li>
                    <li>Certificación de títulos y documentos académicos</li>
                    <li>Atención a estudiantes y público en general</li>
                    <li>Coordinación de procesos administrativos</li>
                    <li>Gestión de archivo institucional</li>
                    <li>Apoyo a la comunidad educativa en trámites administrativos</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Planta Baja</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 101</p>
                    <p><strong>Email:</strong> secretaria@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
