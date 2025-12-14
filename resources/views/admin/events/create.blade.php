@extends('admin.layout')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Crear Evento</h1>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">← Volver a eventos</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        <div class="form-group">
            <label for="category">Tipo de Evento <span class="text-danger">*</span></label>
            <select name="category" id="category" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                <option value="Campeonato" {{ old('category') == 'Campeonato' ? 'selected' : '' }}>Campeonato</option>
                <option value="Feria Estudiantil" {{ old('category') == 'Feria Estudiantil' ? 'selected' : '' }}>Feria Estudiantil</option>
                <option value="Jornada Académica" {{ old('category') == 'Jornada Académica' ? 'selected' : '' }}>Jornada Académica</option>
                <option value="Administrativo" {{ old('category') == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                <option value="Otro" {{ old('category') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Título <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control tinymce" rows="8">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Fecha <span class="text-danger">*</span></label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
        </div>
        <div class="form-group">
            <label for="place">Lugar</label>
            <input type="text" name="place" id="place" class="form-control" value="{{ old('place') }}">
        </div>
        <div class="form-group">
            <label for="images">Imágenes del evento</label>
            <input type="file" name="images[]" id="images" class="form-control-file" accept="image/*" multiple>
            <small class="form-text text-muted">Puedes seleccionar varias imágenes.</small>
        </div>
        <div class="form-group">
            <label for="files">Archivos adjuntos (PDF, reglamentos, etc.)</label>
            <input type="file" name="files[]" id="files" class="form-control-file" accept="application/pdf" multiple>
            <small class="form-text text-muted">Puedes subir varios archivos PDF.</small>
        </div>
        <div class="form-group">
            <label>Enlaces externos (opcional)</label>
            <div id="links-wrapper">
                <div class="input-group mb-2">
                    <input type="url" name="links[]" class="form-control" placeholder="https://...">
                    <input type="text" name="link_labels[]" class="form-control" placeholder="Etiqueta (opcional)">
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addLinkInput()">Agregar otro enlace</button>
        </div>
        <div class="form-group">
            <label for="status">Estado <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control" required>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publicado</option>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Borrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Evento</button>
    </form>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        plugins: 'lists link image table code',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
        menubar: false,
        height: 300,
        language: 'es',
        branding: false
    });

    function addLinkInput() {
        const wrapper = document.getElementById('links-wrapper');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `<input type="url" name="links[]" class="form-control" placeholder="https://...">
            <input type="text" name="link_labels[]" class="form-control" placeholder="Etiqueta (opcional)">`;
        wrapper.appendChild(div);
    }
</script>
@endpush
@endsection

@push('styles')
<style>
    .admin-form {
        max-width: 600px;
        margin: 0 auto;
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .admin-form .form-group {
        margin-bottom: 1.2rem;
    }
    .admin-form label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }
    .admin-form input[type="text"],
    .admin-form input[type="date"],
    .admin-form textarea,
    .admin-form select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        font-size: 1rem;
        background: #f9f9f9;
    }
    .admin-form .form-control-file {
        margin-top: 0.5rem;
    }
    .admin-form .btn {
        margin-top: 1rem;
    }
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .alert-danger {
        background: #ffeaea;
        color: #b71c1c;
        border: 1px solid #f44336;
        border-radius: 5px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
</style>
@endpush
