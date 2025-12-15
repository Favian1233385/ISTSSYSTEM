@extends('layouts.admin')
@section('title', 'Editar Evento Académico')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Editar Evento Académico</h1>
    <form action="{{ route('admin.academic-calendar.update', $event) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $event->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Fecha de fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color (opcional)</label>
            <input type="color" name="color" id="color" class="form-control form-control-color" value="{{ old('color', $event->color ?? '#00a86b') }}">
        </div>
        <button type="submit" class="btn btn-success">Actualizar Evento</button>
        <a href="{{ route('admin.academic-calendar.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
