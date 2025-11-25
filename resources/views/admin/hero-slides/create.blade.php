@extends('layouts.admin')

@section('title', 'Crear Slide del Hero')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Crear Nuevo Slide</h1>
        <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Ej: Bienvenido al ISTS">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtítulo</label>
                            <input type="text" 
                                   class="form-control @error('subtitle') is-invalid @enderror" 
                                   id="subtitle" 
                                   name="subtitle" 
                                   value="{{ old('subtitle') }}"
                                   placeholder="Ej: Formando profesionales de excelencia">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen del Slide <span class="text-danger">*</span></label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   required>
                            <small class="form-text text-muted">
                                Tamaño recomendado: 1920x1080px. Máximo 5MB. Formatos: JPG, PNG, WEBP
                            </small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Enlace (Opcional)</label>
                            <input type="url" 
                                   class="form-control @error('link') is-invalid @enderror" 
                                   id="link" 
                                   name="link" 
                                   value="{{ old('link') }}"
                                   placeholder="https://ejemplo.com">
                            <small class="form-text text-muted">
                                URL a la que dirigirá el slide cuando se haga clic
                            </small>
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Orden de Visualización <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', 0) }}"
                                   min="0"
                                   required>
                            <small class="form-text text-muted">
                                Los slides se mostrarán en orden ascendente (0, 1, 2, ...)
                            </small>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Slide Activo
                            </label>
                            <small class="form-text text-muted d-block">
                                Solo los slides activos se mostrarán en el carrusel
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Guardar Slide
                            </button>
                            <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-info-circle"></i> Información</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>Dimensiones:</strong> Se recomienda usar imágenes de 1920x1080px para mejor calidad.
                        </li>
                        <li class="mb-2">
                            <strong>Orden:</strong> Los slides se mostrarán según el número de orden. Menor número = primero.
                        </li>
                        <li class="mb-2">
                            <strong>Estado:</strong> Solo los slides marcados como activos aparecerán en el sitio público.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
