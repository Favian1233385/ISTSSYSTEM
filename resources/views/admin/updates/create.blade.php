@extends('layouts.admin')

@section('content')

<div class="container my-4">
    <div class="card shadow-sm mx-auto" style="max-width:900px;">
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-3">
                    <span style="font-size:2.2rem; color:#2563eb;">📢</span>
                    <div>
                        <h2 class="fw-bold mb-0" style="font-size:1.7rem; letter-spacing:0.5px;">Nueva Actualización</h2>
                        <p class="mb-0 text-muted" style="font-size:1.08rem;">Crea una nueva noticia o actualización para mostrar en la página principal</p>
                    </div>
                </div>
                <a href="{{ route('admin.updates.index') }}" class="btn btn-outline-primary fw-bold">← Volver</a>
            </div>
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
                <textarea id="description" name="description" class="form-control tinymce-editor @error('description') is-invalid @enderror" rows="8" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Descripción de la actualización o novedad. Puedes centrar, enumerar y dar formato al texto.</small>
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
                <div class="d-flex justify-content-end gap-2">
                    <div class="row w-100">
                        <div class="col-auto">
                            <button type="submit" class="btn d-flex align-items-center gap-1" style="background: linear-gradient(90deg,#009e60,#f59e0b 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.65rem 1.3rem; font-size:1.05rem; transition:box-shadow 0.2s;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                Crear Actualización
                            </button>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('admin.updates.index') }}" class="btn btn-secondary" style="border-radius:8px; font-weight:500; padding: 0.65rem 1.3rem; font-size:1.05rem;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
