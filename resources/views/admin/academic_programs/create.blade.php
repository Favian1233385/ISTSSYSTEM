@extends('layouts.admin')

@section('title', 'Nuevo Programa de ' . $modality->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">➕ Nuevo Programa de {{ $modality->title }}</h1>
        <a href="{{ route('admin.academic_modalities.programs.index', $modality->id) }}" class="btn btn-secondary">Volver</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.academic_modalities.programs.store', $modality->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Enlace informativo (opcional)</label>
                    <input type="url" name="url" id="url" class="form-control" value="{{ old('url') }}">
                </div>
                <div class="mb-3">
                    <label for="document" class="form-label">Documento PDF informativo</label>
                    <input type="file" name="document" id="document" class="form-control" accept="application/pdf">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Fecha de inicio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Fecha de fin</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="registration_url" class="form-label">Enlace de inscripción (opcional)</label>
                    <input type="url" name="registration_url" id="registration_url" class="form-control" value="{{ old('registration_url') }}">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="registration_enabled" id="registration_enabled" value="1" {{ old('registration_enabled') ? 'checked' : '' }}>
                    <label class="form-check-label" for="registration_enabled">Habilitar inscripción</label>
                </div>
                <div class="mb-3">
                    <label for="order" class="form-label">Orden</label>
                    <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Activo</label>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Programa</button>
            </form>
        </div>
    </div>
</div>
@endsection
