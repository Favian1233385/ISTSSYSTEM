@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="visit-page-header">
    <div class="container text-center">
        <h1 class="visit-page-title">Asesoría Jurídica</h1>
    </div>
</section>

<!-- Content Section -->
<section class="visit-content-area">
    <div class="container">
        <div class="visit-box">
            <div class="visit-text-content">
                <h2 class="section-title">Nuestra Misión</h2>
                <p>
                    La Asesoría Jurídica del ISTS brinda soporte legal y orientación en todos los 
                    aspectos jurídicos de la institución, garantizando el cumplimiento de la normativa 
                    vigente y velando por los derechos de la comunidad educativa.
                </p>

                <h3 class="section-subtitle">Funciones Principales</h3>
                <ul class="feature-list">
                    <li>Asesoramiento legal a autoridades y personal institucional</li>
                    <li>Revisión y elaboración de contratos y convenios</li>
                    <li>Gestión de procesos legales y administrativos</li>
                    <li>Interpretación y aplicación de normativa educativa</li>
                    <li>Orientación en derechos y deberes estudiantiles</li>
                    <li>Apoyo en procedimientos disciplinarios</li>
                </ul>

                <h3 class="section-subtitle">Información de Contacto</h3>
                <div class="contact-info">
                    <p><strong>Horario de Atención:</strong> Lunes a Viernes, 08:00 - 17:00</p>
                    <p><strong>Ubicación:</strong> Edificio Administrativo, Segundo Piso</p>
                    <p><strong>Teléfono:</strong> (07) 274-0XXX ext. 102</p>
                    <p><strong>Email:</strong> asesoriajuridica@istssucua.edu.ec</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.visitar.partials.visit-styles')
@endsection
