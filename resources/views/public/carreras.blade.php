@extends('layouts.public')
@section('title', 'Carreras')
@section('content')
<div class="container py-5">
    <div style="margin-top:0.05cm"></div>
    <h1 class="mb-4" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 700;">Todas las Carreras</h1>
    <p class="mb-4" style="color: var(--color-secondary); font-size: 1.2rem;">Aquí puedes consultar todas las carreras ofertadas por el Instituto Superior Tecnológico Sucúa. Haz clic en cada una para ver más detalles.</p>
    <div class="row">
        @foreach(App\Models\Career::all() as $career)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @php
                        $imgSrc = null;
                        if (!empty($career->image_path)) {
                            $imgSrc = asset('storage/' . ltrim($career->image_path, '/'));
                        } elseif (!empty($career->image_path_2)) {
                            $imgSrc = asset('storage/' . ltrim($career->image_path_2, '/'));
                        } else {
                            $imgSrc = asset('assets/img/institucional-placeholder.png');
                        }
                    @endphp
                    <img src="{{ $imgSrc }}" alt="{{ $career->name }}" class="card-img-top" style="height:180px;object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 600;">{{ $career->name }}</h5>
                        @if(!empty($career->description))
                            <p class="card-text" style="color: var(--color-secondary);">{{ Str::limit($career->description, 100) }}</p>
                        @else
                            <p class="card-text" style="color: var(--color-secondary);">Sin descripción.</p>
                        @endif
                        <a href="{{ route('career.show', $career->slug ?? $career->id) }}" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
