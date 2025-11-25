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

    <form action="{{ route('admin.teachers.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}" required>
        </div>
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}">
        </div>
        <div class="form-group">
            <label for="department">Departamento</label>
            <input type="text" name="department" id="department" class="form-control" value="{{ old('department', $item->department) }}">
        </div>
        <div class="form-group">
            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio" class="form-control" rows="5">{{ old('bio', $item->bio) }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
            @endif
        </div>
        <div class="form-group">
            <label for="pdf">PDF (Currículum)</label>
            <input type="file" name="pdf" id="pdf" class="form-control">
            @if($item->pdf_path)
                <p class="mt-2">
                    <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank">Ver PDF actual</a>
                </p>
            @endif
        </div>
        <div class="form-group">
            <label for="order">Orden</label>
            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $item->order) }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Docente</button>
    </form>
</div>
@endsection
