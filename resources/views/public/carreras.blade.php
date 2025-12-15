@extends('layouts.public')
@section('title', 'Carreras')
@section('content')
<div class="container py-5">
    <div style="margin-top:2cm"></div>
    <h1 class="mb-4" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 700;">Todas las Carreras</h1>
    <p class="mb-4" style="color: var(--color-secondary); font-size: 1.2rem;">Aquí puedes consultar todas las carreras ofertadas por el Instituto Superior Tecnológico Sucúa. Haz clic en cada una para ver más detalles.</p>
    <div class="row">
        @foreach(App\Models\Career::all() as $career)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($career->image_path)
                        <img src="{{ asset($career->image_path) }}" alt="{{ $career->name }}" class="card-img-top" style="height:180px;object-fit:cover;">
                    @else
                        <img src="{{ asset('assets/images/default-career.jpg') }}" alt="{{ $career->name }}" class="card-img-top" style="height:180px;object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 600;">{{ $career->name }}</h5>
                        <p class="card-text" style="color: var(--color-secondary);">{{ $career->description ?? 'Sin descripción.' }}</p>
                        <a href="{{ route('career.show', $career->slug ?? $career->id) }}" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
