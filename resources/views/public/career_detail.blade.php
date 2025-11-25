@extends('layouts.site')

@section('content')
<div class="content-detail">
    <div class="container">
        <div class="page-header">
            <h1>{{ $career->name }}</h1>
            @if($career->description)
                <p class="lead">{{ $career->description }}</p>
            @endif
        </div>

        <div class="content-body">
            @if($career->image_path)
                <div class="career-image">
                    <img src="{{ asset('storage/' . $career->image_path) }}" alt="{{ $career->name }}" class="img-fluid">
                </div>
            @endif

            @if($career->full_description)
                <div class="career-description">
                    {!! $career->full_description !!}
                </div>
            @endif

            @if($career->professional_profile)
                <div class="career-section">
                    <h2>Perfil Profesional</h2>
                    {!! $career->professional_profile !!}
                </div>
            @endif

            @if($career->coordinator)
                <div class="career-coordinator">
                    <h3>Coordinador</h3>
                    <p><strong>{{ $career->coordinator }}</strong></p>
                    @if($career->coordinator_email)
                        <p>Email: <a href="mailto:{{ $career->coordinator_email }}">{{ $career->coordinator_email }}</a></p>
                    @endif
                </div>
            @endif

            @if($career->curriculum_pdf)
                <div class="career-pdf">
                    <h3>Malla Curricular</h3>
                    <a href="{{ asset('storage/' . $career->curriculum_pdf) }}" target="_blank" class="btn btn-primary">
                        📄 Descargar Malla Curricular
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection