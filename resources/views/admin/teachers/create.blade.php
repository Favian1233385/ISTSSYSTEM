@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👩‍🏫 Añadir Docente</h1>
        <p>Rellena el formulario para añadir un nuevo docente.</p>
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

    <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="department">Departamento</label>
            <input type="text" name="department" id="department" class="form-control" value="{{ old('department') }}">
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
            <label for="pdf">PDF (Currículum)</label>
            <input type="file" name="pdf" id="pdf" class="form-control">
        </div>
        <div class="form-group">
            <label for="order">Orden</label>
            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}">
        </div>
        <button type="submit" class="btn btn-primary">Añadir Docente</button>
    </form>
</div>
@endsection
