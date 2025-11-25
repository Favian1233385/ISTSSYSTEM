@extends('layouts.admin')

@section('title', 'Editar Sección de Visitar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">✏️ Editar Sección: {{ $visitSection->title }}</h1>
                <a href="{{ route('admin.visit-sections.index') }}" class="btn btn-secondary">
                    ← Volver al Listado
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Errores de validación:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.visit-sections.update', $visitSection->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Título -->
                    <div class="col-md-8 mb-3">
                        <label for="title" class="form-label">Título de la Sección *</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $visitSection->title) }}" 
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="col-md-4 mb-3">
                        <label for="slug" class="form-label">Slug (URL)</label>
                        <input type="text" 
                               class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug', $visitSection->slug) }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">URL: /visitar/{{ $visitSection->slug }}</small>
                    </div>
                </div>

                <!-- Misión -->
                <div class="mb-3">
                    <label for="mission" class="form-label">Misión / Descripción</label>
                    <textarea class="form-control @error('mission') is-invalid @enderror" 
                              id="mission" 
                              name="mission" 
                              rows="4">{{ old('mission', $visitSection->mission) }}</textarea>
                    @error('mission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Funciones -->
                <div class="mb-3">
                    <label class="form-label">Funciones Principales</label>
                    <div id="functions-container">
                        @php
                            $functions = old('functions', $visitSection->functions ?? []);
                        @endphp
                        @if(!empty($functions))
                            @foreach($functions as $function)
                                <div class="input-group mb-2 function-item">
                                    <input type="text" 
                                           class="form-control" 
                                           name="functions[]" 
                                           value="{{ $function }}">
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
                               value="{{ old('schedule', $visitSection->schedule) }}">
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
                               value="{{ old('location', $visitSection->location) }}">
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
                               value="{{ old('phone', $visitSection->phone) }}">
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
                               value="{{ old('email', $visitSection->email) }}">
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
                              rows="3">{{ old('additional_info', $visitSection->additional_info) }}</textarea>
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
                               value="{{ old('sort_order', $visitSection->sort_order) }}"
                               min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Estado</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   {{ old('is_active', $visitSection->is_active) ? 'checked' : '' }}>
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
                        💾 Actualizar Sección
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

    // Eliminar función
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
});
</script>
@endpush
@endsection
