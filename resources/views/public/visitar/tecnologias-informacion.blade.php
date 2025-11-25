@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Tecnologías de la Información y Comunicación</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Unidad de TIC gestiona y desarrolla la infraestructura tecnológica del Instituto, 
                    brindando soporte técnico, servicios digitales y soluciones innovadoras para fortalecer 
                    los procesos académicos y administrativos.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Gestión de infraestructura tecnológica</li>
                    <li>Desarrollo y mantenimiento de sistemas informáticos</li>
                    <li>Soporte técnico a usuarios</li>
                    <li>Administración de redes y servidores</li>
                    <li>Seguridad informática institucional</li>
                    <li>Gestión de plataformas educativas virtuales</li>
                    <li>Capacitación en herramientas digitales</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio de Sistemas, Segunda Planta</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 106</p>
                    <p><strong>Email:</strong> tic@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
