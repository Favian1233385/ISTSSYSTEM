@extends('layouts.site')

@section('content')
<div class="academicos-page">
    <div class="container">
        <div class="page-header">
            <h1>Académicos</h1>
            <p class="lead">Descubre nuestras carreras y programas de educación continua</p>
        </div>

        <div class="academicos-content two-column-layout">
            <section class="careers-section">
                <h2>🎓 Carreras</h2>
                <div class="careers-grid">
                    @foreach($careers as $career)
                        <div class="career-card has-image">
                            <div class="career-image">
                                @if($career->image_path)
                                    <img src="{{ asset('storage/' . $career->image_path) }}" alt="{{ $career->name }}" class="img-fluid">
                                @else
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='blue'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white'%3EImage%3C/text%3E%3C/svg%3E" alt="{{ $career->name }}" class="img-fluid">
                                @endif
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

            <section class="courses-section">
                <h2>📚 Cursos</h2>
                <div class="courses-grid">
                    @foreach($courses as $course)
                        <div class="course-card has-image">
                            <div class="course-image">
                                @if($course->image_url)
                                    <img src="{{ asset($course->image_url) }}" alt="{{ $course->title }}" class="img-fluid">
                                @else
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='orange'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white'%3ECourse%3C/text%3E%3C/svg%3E" alt="{{ $course->title }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="course-info">
                                <h3><a href="{{ route('content.show', $course->slug) }}">{{ $course->title }}</a></h3>
                                @if($course->description)
                                    <p>{{ Str::limit($course->description, 100) }}</p>
                                @endif
                                <a href="{{ route('content.show', $course->slug) }}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>

<style>
.two-column-layout {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}
.two-column-layout section {
    flex: 1;
    min-width: 300px;
}
@media (max-width: 768px) {
    .two-column-layout {
        flex-direction: column;
    }
}
</style>
@endsection
