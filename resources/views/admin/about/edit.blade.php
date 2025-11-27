@extends('admin.layout')
@section('content')
<div class="container">
    <h1>Editar sección Acerca</h1>
    <form action="{{ route('about.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagen actual:</label><br>
            @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}" width="100"><br>
            @endif
            <label for="image">Cambiar imagen (opcional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="pdf">PDF actual:</label><br>
            @if($item->pdf)
                <a href="{{ asset('storage/'.$item->pdf) }}" target="_blank">Ver PDF</a><br>
            @endif
            <label for="pdf">Cambiar PDF (opcional)</label>
            <input type="file" name="pdf" class="form-control" accept="application/pdf">
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('about.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
