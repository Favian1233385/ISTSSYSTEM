@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👨‍🏫 Añadir Miembro</h1>
        <p>Rellena el formulario para añadir un nuevo miembro al equipo.</p>
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

    <form action="{{ route('admin.leadership.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="position">Cargo</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}" required>
        </div>
        <div class="form-group">
            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio" class="form-control" rows="5">{{ old('bio') }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="order">Orden</label>
            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}">
        </div>
        <button type="submit" class="btn btn-primary">Añadir Miembro</button>
    </form>
</div>
@endsection
