@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👩‍🏫 Editar Docente</h1>
        <p>Modifica el formulario para editar un docente.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="card p-4 shadow-sm mx-auto" style="max-width:540px;" method="POST" action="{{ route('admin.teachers.update', $item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label fw-bold text-primary">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label fw-bold text-primary">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="department" class="form-label fw-bold text-primary">Departamento</label>
                <input type="text" name="department" id="department" class="form-control" value="{{ old('department', $item->department) }}">
            </div>
            <div class="col">
                <label for="order" class="form-label fw-bold text-primary">Orden</label>
                <input type="number" name="order" id="order" value="{{ old('order', $item->order) }}" class="form-control">
            </div>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label fw-bold text-primary">Biografía</label>
            <textarea name="bio" id="bio" class="form-control tinymce-editor">{{ old('bio', $item->bio) }}</textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="image" class="form-label fw-bold text-primary">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
            </div>
            <div class="col">
                <label for="pdf" class="form-label fw-bold text-primary">PDF (Currículum)</label>
                <input type="file" name="pdf" id="pdf" accept="application/pdf" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 fw-bold">Actualizar Docente</button>
    </form>
</div>
@endsection
