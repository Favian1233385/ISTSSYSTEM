@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Relaciones Internacionales e Interinstitucionales</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Unidad de Relaciones Internacionales e Interinstitucionales promueve la 
                    cooperación académica, científica y cultural con instituciones nacionales e 
                    internacionales, fortaleciendo la proyección del Instituto.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Gestión de convenios de cooperación</li>
                    <li>Programas de movilidad estudiantil y docente</li>
                    <li>Coordinación de proyectos internacionales</li>
                    <li>Vinculación con instituciones educativas</li>
                    <li>Gestión de becas internacionales</li>
                    <li>Organización de eventos académicos internacionales</li>
                    <li>Promoción de intercambios culturales</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Tercer Piso</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 110</p>
                    <p><strong>Email:</strong> relacionesinternacionales@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
