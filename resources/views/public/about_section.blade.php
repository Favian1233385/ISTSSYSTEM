@extends('layouts.site')
@section('content')
<div class="about-section-public container" style="max-width: 800px; margin: 2rem auto;">
    <h1 class="section-page-title">{{ $section->title }}</h1>
    @if($section->description)
        <p class="section-page-subtitle" style="margin-bottom: 1.5rem;">{{ $section->description }}</p>
    @endif
    @if($section->image)
        <div style="margin-bottom: 1.5rem;">
            <img src="{{ asset('storage/'.$section->image) }}" alt="{{ $section->title }}" style="max-width:100%;height:auto;border-radius:8px;">
        </div>
    @endif
    @if($section->pdf)
        <div style="margin-bottom: 1.5rem;">
            <a href="{{ asset('storage/'.$section->pdf) }}" target="_blank" class="btn btn-primary">Ver PDF</a>
            <a href="{{ asset('storage/'.$section->pdf) }}" download class="btn btn-outline-primary">Descargar PDF</a>
        </div>
    @endif
    <a href="{{ url('/') }}#acerca" class="btn btn-secondary">Volver a Acerca</a>
</div>
@endsection
