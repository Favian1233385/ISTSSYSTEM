@extends('layouts.site')

@section('content')
<div class="academicos-page">
    <div class="container">
        <div class="page-header">
            <h1>Académicos</h1>
            <p class="lead">Descubre nuestras carreras y programas de educación continua</p>
        </div>

        <div class="academicos-content">
            <section class="careers-section">
                <h2>🎓 Carreras</h2>
                <div class="careers-grid">
                    @foreach($careers as $career)
                        <div class="career-card has-image">
                            <div class="career-image">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='blue'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white'%3EImage%3C/text%3E%3C/svg%3E" alt="{{ $career->name }}" class="img-fluid">
                            </div>
                            <div class="career-info">
                                <h3><a href="{{ route('career.show', $career->slug) }}">{{ $career->name }}</a></h3>
                                @if($career->description)
                                    <p>{{ Str::limit($career->description, 100) }}</p>
                                @endif
                                <a href="{{ route('career.show', $career->slug) }}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="sections-section">
                <h2>📚 Educación Continua</h2>
                <div class="sections-grid">
                    @foreach($sections as $section)
                        <div class="section-card has-image">
                            <div class="section-image">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='green'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white'%3EImage%3C/text%3E%3C/svg%3E" alt="{{ $section->title }}" class="img-fluid">
                            </div>
                            <div class="section-info">
                                <h3><a href="{{ route('academic-section.show', $section->slug) }}">{{ $section->title }}</a></h3>
                                @if($section->description)
                                    <p>{{ Str::limit($section->description, 100) }}</p>
                                @endif
                                <a href="{{ route('academic-section.show', $section->slug) }}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
