@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Nuevo Evento - Línea de Tiempo</h2>

    <form action="{{ route('admin.timeline.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label>Año</label>
            <input type="number" name="year" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_public" class="form-check-input" id="is_public" checked>
            <label class="form-check-label" for="is_public">Visible públicamente</label>
        </div>
        <button class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
