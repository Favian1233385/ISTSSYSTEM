@extends('admin.layout')
@section('content')
<div class="container">
    <h1>Crear sección Acerca</h1>
    <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagen (opcional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="pdf">Archivo PDF (opcional)</label>
            <input type="file" name="pdf" class="form-control" accept="application/pdf">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('about.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
