@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Talento Humano</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Unidad de Talento Humano administra y desarrolla el capital humano del Instituto, 
                    promoviendo un ambiente laboral favorable y garantizando el cumplimiento de las 
                    políticas laborales y de desarrollo profesional.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Gestión de procesos de selección y contratación</li>
                    <li>Administración de nómina y beneficios</li>
                    <li>Capacitación y desarrollo profesional</li>
                    <li>Evaluación del desempeño</li>
                    <li>Gestión de clima laboral</li>
                    <li>Manejo de expedientes laborales</li>
                    <li>Aplicación de normativa laboral</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Primera Planta</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 109</p>
                    <p><strong>Email:</strong> talentohumano@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
