@extends('layouts.admin')

@section('title', 'Editar Slide del Carrusel')

@section('content')
<div class="container mt-4">
    <h2>Editar slide</h2>
    <form action="{{ route('admin.hero-slides.update', $heroSlide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" 
                   name="title" 
                   id="title" 
                   class="form-control" 
                   value="{{ $heroSlide->title }}" 
                   required>
        </div>
        <div class="mb-3">
            <label for="subtitle" class="form-label">Subtítulo</label>
            <input type="text" 
                   name="subtitle" 
                   id="subtitle" 
                   class="form-control" 
                   value="{{ $heroSlide->subtitle }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen actual</label><br>
            @if($heroSlide->image_path)
                <img src="{{ asset('storage/uploads/images/' . $heroSlide->image_path) }}" 
                     alt="{{ $heroSlide->title }}" 
                     style="width: 100px;">
            @endif
            <input type="file" 
                   name="image" 
                   id="image" 
                   class="form-control mt-2" 
                   accept="image/*">
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Enlace</label>
            <input type="text" 
                   name="link" 
                   id="link" 
                   class="form-control" 
                   value="{{ $heroSlide->link }}">
        </div>
        <div class="mb-3">
            <label for="sort_order" class="form-label">Orden</label>
            <input type="number" 
                   name="sort_order" 
                   id="sort_order" 
                   class="form-control" 
                   value="{{ $heroSlide->sort_order }}">
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Activo</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1" @if($heroSlide->is_active) selected @endif>Sí</option>
                <option value="0" @if(!$heroSlide->is_active) selected @endif>No</option>
            </select>
        </div>
        <div class="admin-action-buttons mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Actualizar
            </button>
            <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle me-1"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
