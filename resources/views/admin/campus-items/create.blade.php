@extends('layouts.admin')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 900px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">📝</span> Crear Item del Campus
            </h1>
            <a href="{{ route('admin.campus-items.index') }}" class="btn" style="background: #253b7d; color: #fff; font-weight:600; border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem;">Volver</a>
        </div>
        <form action="{{ route('admin.campus-items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="title" class="form-label">Título *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="category" class="form-label">Categoría *</label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" required placeholder="Ejemplo: servicios, coordinaciones, vida_estudiantil, infraestructura">
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Puedes usar categorías como: <b>servicios</b>, <b>coordinaciones</b>, <b>vida_estudiantil</b>, <b>infraestructura</b>, etc.</small>
                </div>
                <div class="col-md-6">
                    <label for="url" class="form-label">URL *</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" placeholder="/campus/ejemplo" required>
                    @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Ejemplo: /campus/biblioteca</small>
                </div>
                <div class="col-md-6">
                    <label for="order" class="form-label">Orden *</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0" required>
                    @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Define el orden de aparición (menor número = más arriba)</small>
                </div>
                <div class="col-12">
                    <label for="description" class="form-label">Descripción Corta</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Breve descripción que aparecerá en el menú</small>
                </div>
                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" id="is_external" name="is_external" value="1" {{ old('is_external') ? 'checked' : '' }} onchange="toggleContentField()">
                    <label class="form-check-label" for="is_external">¿Es un enlace externo?</label>
                    <small class="form-text text-muted d-block">Marcar si el enlace abre una página externa (ej: Biblioteca Digital)</small>
                </div>
                <div class="col-12" id="content-field">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Usa el editor para dar formato al contenido (solo para enlaces internos)</small>
                </div>
                <div class="col-12">
                    <label for="images" class="form-label">Imágenes</label>
                    <input type="file" class="form-control @error('images.*') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*">
                    @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Puedes seleccionar múltiples imágenes (JPG, PNG, GIF)</small>
                </div>
                <div class="col-12">
                    <label for="pdf_file" class="form-label">Archivo PDF</label>
                    <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" id="pdf_file" name="pdf_file" accept="application/pdf">
                    @error('pdf_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted">Puedes subir un archivo PDF (máx. 10MB)</small>
                </div>
                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Activo</label>
                </div>
            </div>
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; border-radius:8px; padding:0.75em 2em; font-size:1.1em; min-width:130px; max-width:180px; display:flex; align-items:center; gap:0.5em; justify-content:center;">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('admin.campus-items.index') }}" class="btn" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.75em 2em; font-size:1.1em; min-width:130px; max-width:180px; display:flex; align-items:center; gap:0.5em; justify-content:center;">Cancelar</a>
            </div>
        </form>
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
