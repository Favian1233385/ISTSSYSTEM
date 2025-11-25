@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Editar Item del Campus</h1>
        <a href="{{ route('admin.campus-items.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.campus-items.update', $campusItem) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título *</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $campusItem->title) }}" 
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción Corta</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="2">{{ old('description', $campusItem->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Breve descripción que aparecerá en el menú</small>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_external" 
                           name="is_external" 
                           value="1"
                           {{ old('is_external', $campusItem->is_external) ? 'checked' : '' }}
                           onchange="toggleContentField()">
                    <label class="form-check-label" for="is_external">
                        ¿Es un enlace externo?
                    </label>
                    <small class="form-text text-muted d-block">Marcar si el enlace abre una página externa (ej: Biblioteca Digital)</small>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">URL *</label>
                    <input type="text" 
                           class="form-control @error('url') is-invalid @enderror" 
                           id="url" 
                           name="url" 
                           value="{{ old('url', $campusItem->url) }}" 
                           placeholder="/campus/ejemplo"
                           required>
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Ejemplo: /campus/biblioteca</small>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Categoría *</label>
                    <select class="form-select @error('category') is-invalid @enderror" 
                            id="category" 
                            name="category" 
                            required>
                        <option value="">Seleccione una categoría</option>
                        <option value="coordinaciones" 
                                {{ old('category', $campusItem->category) === 'coordinaciones' ? 'selected' : '' }}>
                            Coordinaciones
                        </option>
                        <option value="servicios" 
                                {{ old('category', $campusItem->category) === 'servicios' ? 'selected' : '' }}>
                            Servicios
                        </option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Orden *</label>
                    <input type="number" 
                           class="form-control @error('order') is-invalid @enderror" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', $campusItem->order) }}" 
                           min="0"
                           required>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Define el orden de aparición (menor número = más arriba)</small>
                </div>

                <div class="mb-3" id="content-field">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" 
                              name="content" 
                              rows="15">{{ old('content', $campusItem->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Usa el editor para dar formato al contenido (solo para enlaces internos)</small>
                </div>

                <!-- Imágenes existentes -->
                @if($campusItem->images->count() > 0)
                <div class="mb-3">
                    <label class="form-label">Imágenes actuales</label>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        @foreach($campusItem->images as $image)
                            <div style="position: relative; border: 1px solid #ddd; padding: 0.5rem; border-radius: 4px;">
                                <img src="{{ asset($image->image_path) }}" alt="{{ $image->caption }}" style="width: 150px; height: 150px; object-fit: cover;">
                                <a href="{{ route('admin.campus-items.image.destroy', [$campusItem, $image]) }}" 
                                   onclick="return confirm('¿Eliminar esta imagen?')"
                                   style="position: absolute; top: 0.5rem; right: 0.5rem; background: #dc3545; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; text-decoration: none;">
                                    ✕
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mb-3" id="images-field">
                    <label for="images" class="form-label">Agregar nuevas imágenes</label>
                    <input type="file" 
                           class="form-control @error('images.*') is-invalid @enderror" 
                           id="images" 
                           name="images[]" 
                           multiple 
                           accept="image/*">
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Puedes seleccionar múltiples imágenes (JPG, PNG, GIF)</small>
                </div>

                <div class="mb-3">
                    <label for="pdf_file" class="form-label">Archivo PDF</label>
                    <input type="file" 
                           class="form-control @error('pdf_file') is-invalid @enderror" 
                           id="pdf_file" 
                           name="pdf_file" 
                           accept="application/pdf">
                    @error('pdf_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Puedes subir un archivo PDF (máx. 10MB)</small>
                </div>

                @if($campusItem->pdf_url)
                <div class="mb-3">
                    <label class="form-label">PDF actual</label>
                    <a href="{{ asset($campusItem->pdf_url) }}" target="_blank" class="btn btn-outline-primary">Ver PDF</a>
                </div>
                @endif
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_active" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', $campusItem->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Activo
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('admin.campus-items.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
// Inicializar TinyMCE
tinymce.init({
    selector: '#content',
    height: 500,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    content_style: 'body { font-family: Inter, -apple-system, BlinkMacSystemFont, sans-serif; font-size: 16px; }',
    language: 'es',
    branding: false,
    promotion: false
});

function toggleContentField() {
    const isExternal = document.getElementById('is_external').checked;
    const contentField = document.getElementById('content-field');
    if (isExternal) {
        contentField.style.display = 'none';
        // Destruir TinyMCE si está activo
        if (tinymce.get('content')) {
            tinymce.get('content').setContent('');
        }
    } else {
        contentField.style.display = 'block';
    }
}

// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    toggleContentField();
});
</script>
@endsection
