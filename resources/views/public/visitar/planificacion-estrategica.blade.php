@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Planificación Estratégica</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Unidad de Planificación Estratégica diseña, coordina y evalúa los planes 
                    institucionales, asegurando el cumplimiento de objetivos y metas alineadas con 
                    la visión y misión del Instituto.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Elaboración del Plan Estratégico Institucional</li>
                    <li>Seguimiento y evaluación de indicadores</li>
                    <li>Gestión de proyectos institucionales</li>
                    <li>Análisis de datos e información institucional</li>
                    <li>Coordinación de procesos de acreditación</li>
                    <li>Elaboración de informes de gestión</li>
                    <li>Apoyo en toma de decisiones estratégicas</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Tercer Piso</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 107</p>
                    <p><strong>Email:</strong> planificacion@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
