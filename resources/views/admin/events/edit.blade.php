@extends('admin.layout')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Editar Evento</h1>
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
    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category">Tipo de Evento <span class="text-danger">*</span></label>
            <select name="category" id="category" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                <option value="Campeonato" {{ old('category', $event->category) == 'Campeonato' ? 'selected' : '' }}>Campeonato</option>
                <option value="Feria Estudiantil" {{ old('category', $event->category) == 'Feria Estudiantil' ? 'selected' : '' }}>Feria Estudiantil</option>
                <option value="Jornada Académica" {{ old('category', $event->category) == 'Jornada Académica' ? 'selected' : '' }}>Jornada Académica</option>
                <option value="Administrativo" {{ old('category', $event->category) == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                <option value="Otro" {{ old('category', $event->category) == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Título <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control tinymce" rows="8">{{ old('description', $event->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Fecha <span class="text-danger">*</span></label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $event->date ? $event->date->format('Y-m-d') : '') }}" required>
        </div>
        <div class="form-group">
            <label for="place">Lugar</label>
            <input type="text" name="place" id="place" class="form-control" value="{{ old('place', $event->place) }}">
        </div>
        <div class="form-group">
            <label>Imágenes actuales</label>
            <div class="row mb-2">
                @foreach($event->images as $img)
                    <div class="col-auto mb-2">
                        <img src="{{ asset('storage/' . $img->image_path) }}" alt="Imagen" style="max-width:90px;max-height:60px;display:block;">
                        <label><input type="checkbox" name="delete_images[]" value="{{ $img->id }}"> Eliminar</label>
                    </div>
                @endforeach
            </div>
            <label for="images">Agregar nuevas imágenes</label>
            <input type="file" name="images[]" id="images" class="form-control-file" accept="image/*" multiple>
        </div>
        <div class="form-group">
            <label>Archivos actuales</label>
            <ul>
                @foreach($event->files as $file)
                    <li>
                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ $file->file_name }}</a>
                        <label><input type="checkbox" name="delete_files[]" value="{{ $file->id }}"> Eliminar</label>
                    </li>
                @endforeach
            </ul>
            <label for="files">Agregar nuevos archivos (PDF)</label>
            <input type="file" name="files[]" id="files" class="form-control-file" accept="application/pdf" multiple>
        </div>
        <div class="form-group">
            <label>Enlaces actuales</label>
            <ul id="links-list">
                @foreach($event->links as $link)
                    <li>
                        <input type="url" name="links_edit[]" value="{{ $link->url }}" class="form-control d-inline-block" style="width:60%" placeholder="https://...">
                        <input type="text" name="link_labels_edit[]" value="{{ $link->label }}" class="form-control d-inline-block" style="width:35%" placeholder="Etiqueta (opcional)">
                        <label><input type="checkbox" name="delete_links[]" value="{{ $link->id }}"> Eliminar</label>
                    </li>
                @endforeach
            </ul>
            <label>Agregar nuevos enlaces</label>
            <div id="links-wrapper">
                <div class="input-group mb-2">
                    <input type="url" name="links[]" class="form-control" placeholder="https://...">
                    <input type="text" name="link_labels[]" class="form-control" placeholder="Etiqueta (opcional)">
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addLinkInput()">Agregar otro enlace</button>
        </div>
        <div class="form-group">
        <!-- Banner eliminado: ahora se gestiona desde PopUps -->
        <div class="form-group">
            <label for="status">Estado <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control" required>
                <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Publicado</option>
                <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Borrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Evento</button>
    </form>
</div>
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
        div.innerHTML = `<input type=\"url\" name=\"links[]\" class=\"form-control\" placeholder=\"https://...\"> <input type=\"text\" name=\"link_labels[]\" class=\"form-control\" placeholder=\"Etiqueta (opcional)\">`;
        wrapper.appendChild(div);
    }
</script>
@endpush
