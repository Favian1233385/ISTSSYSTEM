@extends('layouts.admin')

@section('title', 'Editar Slide del Hero')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Editar Slide</h1>
        <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $heroSlide->title) }}"
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
                                   value="{{ old('subtitle', $heroSlide->subtitle) }}"
                                   placeholder="Ej: Formando profesionales de excelencia">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen del Slide</label>
                            
                            @if($heroSlide->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $heroSlide->image_path) }}" 
                                         alt="Imagen actual" 
                                         class="img-thumbnail" 
                                         style="max-width: 300px;">
                                    <p class="text-muted small mt-1">Imagen actual</p>
                                </div>
                            @endif
                            
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            <small class="form-text text-muted">
                                Dejar vacío para mantener la imagen actual. Tamaño recomendado: 1920x1080px. Máximo 5MB.
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
                                   value="{{ old('link', $heroSlide->link) }}"
                                   placeholder="https://ejemplo.com">
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
                                   value="{{ old('sort_order', $heroSlide->sort_order) }}"
                                   min="0"
                                   required>
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
                                   {{ old('is_active', $heroSlide->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Slide Activo
                            </label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Actualizar Slide
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
                            <strong>Creado:</strong> {{ $heroSlide->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Última actualización:</strong> {{ $heroSlide->updated_at->format('d/m/Y H:i') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
