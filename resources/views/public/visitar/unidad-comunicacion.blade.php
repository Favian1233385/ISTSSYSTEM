@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Unidad de Comunicación</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Unidad de Comunicación gestiona la imagen institucional y los canales de 
                    comunicación interna y externa, difundiendo las actividades, logros y servicios 
                    del Instituto a la comunidad.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Gestión de imagen y marca institucional</li>
                    <li>Difusión de información institucional</li>
                    <li>Manejo de redes sociales y medios digitales</li>
                    <li>Producción de contenido audiovisual</li>
                    <li>Relaciones públicas y protocolo</li>
                    <li>Cobertura de eventos institucionales</li>
                    <li>Comunicación interna y cartelería</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Segunda Planta</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 108</p>
                    <p><strong>Email:</strong> comunicacion@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
