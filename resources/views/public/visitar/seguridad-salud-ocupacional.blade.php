@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Seguridad y Salud Ocupacional</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Unidad de Seguridad y Salud Ocupacional promueve y mantiene un ambiente de 
                    trabajo seguro y saludable, previniendo riesgos laborales y garantizando el 
                    bienestar de toda la comunidad institucional.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Evaluación y prevención de riesgos laborales</li>
                    <li>Implementación de protocolos de seguridad</li>
                    <li>Capacitación en prevención de accidentes</li>
                    <li>Gestión de emergencias y evacuaciones</li>
                    <li>Vigilancia de la salud ocupacional</li>
                    <li>Inspecciones de seguridad</li>
                    <li>Planes de contingencia institucional</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Primera Planta</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 105</p>
                    <p><strong>Email:</strong> seguridad@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
