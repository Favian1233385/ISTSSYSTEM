@extends('layouts.public')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">{{ $section->title }}</h1>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card shadow-lg mb-4 animate__animated animate__fadeIn" style="border-top:6px solid var(--color-success,#2e7d32); max-width:900px; width:100%;">
                <div class="card-body p-4">
                    @if($section->mission)
                        <h5 class="text-primary mt-3">Misión</h5>
                        <p class="lead">{{ $section->mission }}</p>
                    @endif
                    @if($section->functions && is_array($section->functions))
                        <h5 class="text-primary mt-4">Funciones</h5>
                        <ul class="list-unstyled">
                            @foreach($section->functions as $funcion)
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $funcion }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if($section->schedule)
                        <p class="mt-3"><strong>Horario:</strong> {{ $section->schedule }}</p>
                    @endif
                    @if($section->location)
                        <p><strong>Ubicación:</strong> {{ $section->location }}</p>
                    @endif
                    @if($section->phone)
                        <p><strong>Teléfono:</strong> {{ $section->phone }}</p>
                    @endif
                    @if($section->email)
                        <p><strong>Email:</strong> <a href="mailto:{{ $section->email }}">{{ $section->email }}</a></p>
                    @endif
                    @if($section->additional_info)
                        <div class="mt-4">{!! nl2br(e($section->additional_info)) !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
