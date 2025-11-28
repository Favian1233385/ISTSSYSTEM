@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Crear Nueva Autoridad</h1>
    <p class="mb-4">Completa el formulario para añadir una nueva autoridad (Rector, Vicerrector, etc.).</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Creación</h6>
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

            <form action="{{ route('admin.autoridades.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" name="cargo" id="cargo" class="form-control" value="{{ old('cargo') }}" placeholder="Ej: Rector, Vicerrector" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria') }}" placeholder="Ej: Directivos, OCS" required>
                </div>

                <div class="form-group">
                    <label for="biografia">Biografía (Opcional)</label>
                    <textarea name="biografia" id="biografia" class="form-control tinymce-editor" rows="10">{{ old('biografia') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Foto (Opcional)</label>
                    <div class="custom-file-upload">
                        <label for="foto_path" class="btn btn-info">Seleccionar Imagen</label>
                        <span id="foto_path_name" style="margin-left: 10px;">No se ha seleccionado ninguna imagen.</span>
                        <input type="file" name="foto_path" id="foto_path" style="display: none;" onchange="document.getElementById('foto_path_name').textContent = this.files.length > 0 ? this.files[0].name : 'No se ha seleccionado ninguna imagen.';">
                    </div>
                </div>

                <div class="form-group">
                    <label>Currículum en PDF (Opcional)</label>
                    <div class="custom-file-upload">
                        <label for="pdf_path" class="btn btn-info">Seleccionar PDF</label>
                        <span id="pdf_path_name" style="margin-left: 10px;">No se ha seleccionado ningún PDF.</span>
                        <input type="file" name="pdf_path" id="pdf_path" accept="application/pdf" style="display: none;" onchange="document.getElementById('pdf_path_name').textContent = this.files.length > 0 ? this.files[0].name : 'No se ha seleccionado ningún PDF.';">
                    </div>
                </div>

                <div class="form-group">
                    <label for="orden">Orden de Aparición</label>
                    <input type="number" name="orden" id="orden" class="form-control" value="{{ old('orden', 0) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Guardar Autoridad</button>
                <a href="{{ route('admin.autoridades.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
