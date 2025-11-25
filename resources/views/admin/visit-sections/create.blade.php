@extends('layouts.admin')

@section('title', 'Crear Sección de Visitar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">➕ Crear Sección de Visitar</h1>
                <a href="{{ route('admin.visit-sections.index') }}" class="btn btn-secondary">
                    ← Volver al Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.visit-sections.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Título -->
                    <div class="col-md-8 mb-3">
                        <label for="title" class="form-label">Título de la Sección *</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               required
                               placeholder="Ej: Secretaría General">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="col-md-4 mb-3">
                        <label for="slug" class="form-label">
                            Slug (URL) 
                            <small class="text-muted">(opcional, se genera automático)</small>
                        </label>
                        <input type="text" 
                               class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug') }}"
                               placeholder="secretaria-general">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Se usará en la URL: /visitar/slug</small>
                    </div>
                </div>

                <!-- Misión -->
                <div class="mb-3">
                    <label for="mission" class="form-label">Misión / Descripción</label>
                    <textarea class="form-control @error('mission') is-invalid @enderror" 
                              id="mission" 
                              name="mission" 
                              rows="4"
                              placeholder="Describe la misión y propósito de esta sección...">{{ old('mission') }}</textarea>
                    @error('mission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Funciones -->
                <div class="mb-3">
                    <label class="form-label">Funciones Principales</label>
                    <div id="functions-container">
                        @if(old('functions'))
                            @foreach(old('functions') as $index => $function)
                                <div class="input-group mb-2 function-item">
                                    <input type="text" 
                                           class="form-control" 
                                           name="functions[]" 
                                           value="{{ $function }}"
                                           placeholder="Describe una función...">
                                    <button type="button" class="btn btn-danger remove-function">🗑️</button>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2 function-item">
                                <input type="text" class="form-control" name="functions[]" placeholder="Describe una función...">
                                <button type="button" class="btn btn-danger remove-function">🗑️</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="add-function">
                        ➕ Agregar Función
                    </button>
                </div>

                <div class="row">
                    <!-- Horario -->
                    <div class="col-md-6 mb-3">
                        <label for="schedule" class="form-label">Horario de Atención</label>
                        <input type="text" 
                               class="form-control @error('schedule') is-invalid @enderror" 
                               id="schedule" 
                               name="schedule" 
                               value="{{ old('schedule') }}"
                               placeholder="Lunes a Viernes, 08:00 - 17:00">
                        @error('schedule')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Ubicación -->
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Ubicación</label>
                        <input type="text" 
                               class="form-control @error('location') is-invalid @enderror" 
                               id="location" 
                               name="location" 
                               value="{{ old('location') }}"
                               placeholder="Edificio Administrativo, Planta Baja">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Teléfono -->
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone') }}"
                               placeholder="(07) 274-0XXX ext. 101">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="seccion@istssucua.edu.ec">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="mb-3">
                    <label for="additional_info" class="form-label">Información Adicional</label>
                    <textarea class="form-control @error('additional_info') is-invalid @enderror" 
                              id="additional_info" 
                              name="additional_info" 
                              rows="3"
                              placeholder="Cualquier información extra que desees agregar...">{{ old('additional_info') }}</textarea>
                    @error('additional_info')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <!-- Orden -->
                    <div class="col-md-6 mb-3">
                        <label for="sort_order" class="form-label">Orden de Aparición</label>
                        <input type="number" 
                               class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" 
                               name="sort_order" 
                               value="{{ old('sort_order', 0) }}"
                               min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Menor número aparece primero</small>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Estado</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Sección Activa
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.visit-sections.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        💾 Guardar Sección
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Agregar función
    document.getElementById('add-function').addEventListener('click', function() {
        const container = document.getElementById('functions-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 function-item';
        newItem.innerHTML = `
            <input type="text" class="form-control" name="functions[]" placeholder="Describe una función...">
            <button type="button" class="btn btn-danger remove-function">🗑️</button>
        `;
        container.appendChild(newItem);
    });

    // Eliminar función (delegación de eventos)
    document.getElementById('functions-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-function') || e.target.parentElement.classList.contains('remove-function')) {
            const button = e.target.classList.contains('remove-function') ? e.target : e.target.parentElement;
            const item = button.closest('.function-item');
            if (document.querySelectorAll('.function-item').length > 1) {
                item.remove();
            } else {
                alert('Debe haber al menos una función');
            }
        }
    });

    // Auto-generar slug desde el título
    document.getElementById('title').addEventListener('input', function(e) {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.dataset.manuallyEdited !== 'true') {
            const slug = e.target.value
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remover acentos
                .replace(/[^a-z0-9\s-]/g, '') // Solo letras, números, espacios y guiones
                .trim()
                .replace(/\s+/g, '-'); // Reemplazar espacios con guiones
            slugInput.value = slug;
        }
    });

    // Marcar slug como editado manualmente
    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.manuallyEdited = 'true';
    });
});
</script>
@endpush
@endsection
