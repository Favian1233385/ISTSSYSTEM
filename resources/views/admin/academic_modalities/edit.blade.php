@extends('layouts.admin')

@section('title', 'Editar Modalidad Académica')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">✏️ Editar Modalidad: {{ $academicModality->title }}</h1>
        <a href="{{ route('admin.academic_modalities.index') }}" class="btn btn-secondary">Volver</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.academic_modalities.update', $academicModality) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $academicModality->title) }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $academicModality->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Icono (opcional, clase CSS)</label>
                    <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon', $academicModality->icon) }}">
                </div>
                <div class="mb-3">
                    <label for="order" class="form-label">Orden</label>
                    <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $academicModality->order) }}">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $academicModality->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Activo</label>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Modalidad</button>
            </form>
        </div>
    </div>
</div>
@endsection
