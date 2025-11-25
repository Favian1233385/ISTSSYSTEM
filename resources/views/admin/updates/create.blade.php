@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="header-left">
        <h1>📢 Nueva Actualización</h1>
        <p>Crea una nueva noticia o actualización para mostrar en la página principal</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.updates.index') }}" class="btn btn-secondary">
            ← Volver
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.updates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Título *</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required maxlength="255">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="date">Fecha *</label>
                <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción *</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Descripción de la actualización o novedad</small>
            </div>

            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" id="image" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Imagen representativa (opcional, máx. 2MB)</small>
            </div>

            <div class="form-group">
                <label>Video</label>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="video">Subir Video Local</label>
                            <input type="file" id="video" name="video" class="form-control-file @error('video') is-invalid @enderror" accept="video/*">
                            @error('video')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Formatos: MP4, AVI, MOV, WMV, FLV, WebM (opcional, máx. 50MB)</small>
                        </div>

                        <div class="text-center my-3">
                            <strong>- O -</strong>
                        </div>

                        <div class="form-group mb-0">
                            <label for="video_url">URL de Video (YouTube, Vimeo, etc.)</label>
                            <input type="url" id="video_url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Si subes un video local, esta URL será ignorada</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="link_url">URL de Enlace</label>
                        <input type="url" id="link_url" name="link_url" class="form-control @error('link_url') is-invalid @enderror" value="{{ old('link_url') }}" placeholder="https://...">
                        @error('link_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="link_text">Texto del Enlace</label>
                        <input type="text" id="link_text" name="link_text" class="form-control @error('link_text') is-invalid @enderror" value="{{ old('link_text', 'Leer más') }}" maxlength="100">
                        @error('link_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sort_order">Orden</label>
                        <input type="number" id="sort_order" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text">Número menor = aparece primero</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <span>Mostrar en la página principal</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Crear Actualización
                </button>
                <a href="{{ route('admin.updates.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
