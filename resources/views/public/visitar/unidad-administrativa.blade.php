@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Unidad Administrativa</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Unidad Administrativa gestiona los recursos financieros, materiales y logísticos 
                    del Instituto, garantizando el uso eficiente y transparente de los recursos para 
                    el cumplimiento de los objetivos institucionales.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Gestión presupuestaria y financiera</li>
                    <li>Administración de recursos materiales</li>
                    <li>Procesos de contratación pública</li>
                    <li>Control y gestión de inventarios</li>
                    <li>Mantenimiento de infraestructura</li>
                    <li>Servicios generales y logística</li>
                    <li>Tesorería y gestión de pagos</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Primera Planta</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 104</p>
                    <p><strong>Email:</strong> administrativa@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
