@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Editar Sección de "Acerca"</h1>
    <p class="mb-4">Modifica los detalles de la sección de contenido de la página "Acerca".</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Edición</h6>
        </div>
        <div class="card-body">
            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('about.update', $about['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $about['title']) }}" required>
                </div>

                <div class="form-group">
                    <label for="body">Contenido</label>
                    <textarea name="body" id="body" class="form-control" rows="10" required>{{ old('body', $about['content']) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control">
                        <option value="published" {{ old('status', $about['status']) == 'published' ? 'selected' : '' }}>Publicado</option>
                        <option value="draft" {{ old('status', $about['status']) == 'draft' ? 'selected' : '' }}>Borrador</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Actualizar Sección</button>
                <a href="{{ route('about.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
