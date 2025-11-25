@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Editar Evento - Línea de Tiempo</h2>

    <form action="{{ route('admin.timeline.update', $event) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Año</label>
            <input type="number" name="year" class="form-control" value="{{ $event->year }}" required>
        </div>
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}">
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control" rows="4">{{ $event->description }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_public" class="form-check-input" id="is_public" {{ $event->is_public ? 'checked' : '' }}>
            <label class="form-check-label" for="is_public">Visible públicamente</label>
        </div>
        <button class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
