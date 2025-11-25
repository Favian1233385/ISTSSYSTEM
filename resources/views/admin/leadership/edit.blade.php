@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👨‍🏫 Editar Miembro</h1>
        <p>Modifica el formulario para editar un miembro del equipo.</p>
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

    <form action="{{ route('admin.leadership.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}" required>
        </div>
        <div class="form-group">
            <label for="position">Cargo</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $item->position) }}" required>
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
            <label for="order">Orden</label>
            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $item->order) }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Miembro</button>
    </form>
</div>
@endsection
