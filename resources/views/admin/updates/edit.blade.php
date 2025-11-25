@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="header-left">
        <h1>📢 Editar Actualización</h1>
        <p>Modifica la información de esta actualización</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.updates.index') }}" class="btn btn-secondary">
            ← Volver
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.updates.update', $update->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Título *</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $update->title) }}" required maxlength="255">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="date">Fecha *</label>
                <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $update->date->format('Y-m-d')) }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción *</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $update->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Imagen</label>
                @if($update->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $update->image_path) }}" alt="{{ $update->title }}" style="max-width: 200px; border-radius: 8px;">
                        <p class="text-muted small mt-1">Imagen actual</p>
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Subir nueva imagen reemplazará la actual (máx. 2MB)</small>
            </div>

            <div class="form-group">
                <label>Video</label>
                <div class="card">
                    <div class="card-body">
                        @if($update->video_path)
                            <div class="mb-3">
                                <video controls style="max-width: 400px; border-radius: 8px;">
                                    <source src="{{ asset('storage/' . $update->video_path) }}" type="video/mp4">
                                    Tu navegador no soporta el video.
                                </video>
                                <p class="text-muted small mt-1">Video actual subido</p>
                            </div>
                        @elseif($update->video_url)
                            <div class="mb-3">
                                <p class="text-muted">URL de video actual: <a href="{{ $update->video_url }}" target="_blank">{{ $update->video_url }}</a></p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="video">Subir Video Local</label>
                            <input type="file" id="video" name="video" class="form-control-file @error('video') is-invalid @enderror" accept="video/*">
                            @error('video')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Formatos: MP4, AVI, MOV, WMV, FLV, WebM (máx. 50MB)</small>
                        </div>

                        <div class="text-center my-3">
                            <strong>- O -</strong>
                        </div>

                        <div class="form-group mb-0">
                            <label for="video_url">URL de Video (YouTube, Vimeo, etc.)</label>
                            <input type="url" id="video_url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $update->video_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Si subes un nuevo video local, esta URL será ignorada</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="link_url">URL de Enlace</label>
                        <input type="url" id="link_url" name="link_url" class="form-control @error('link_url') is-invalid @enderror" value="{{ old('link_url', $update->link_url) }}" placeholder="https://...">
                        @error('link_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="link_text">Texto del Enlace</label>
                        <input type="text" id="link_text" name="link_text" class="form-control @error('link_text') is-invalid @enderror" value="{{ old('link_text', $update->link_text ?? 'Leer más') }}" maxlength="100">
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
                        <input type="number" id="sort_order" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $update->sort_order) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text">Número menor = aparece primero</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $update->is_active) ? 'checked' : '' }}>
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
                    Actualizar
                </button>
                <a href="{{ route('admin.updates.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
