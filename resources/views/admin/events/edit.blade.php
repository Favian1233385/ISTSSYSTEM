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
            <label for="image">Imagen principal</label>
            @if($event->image_path)
                <div style="margin-bottom:10px;">
                    <img src="{{ asset('storage/' . $event->image_path) }}" alt="Imagen actual" style="max-width:120px;max-height:80px;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
        </div>
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
<script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatxcolo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
</script>
@endpush
