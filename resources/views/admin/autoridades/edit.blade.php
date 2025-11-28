@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Editar Autoridad</h1>
    <p class="mb-4">Modifica los detalles de la autoridad seleccionada.</p>

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

            <form action="{{ route('admin.autoridades.update', $autoridad) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $autoridad->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" name="cargo" id="cargo" class="form-control" value="{{ old('cargo', $autoridad->cargo) }}" placeholder="Ej: Rector, Vicerrector" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria', $autoridad->categoria) }}" placeholder="Ej: Directivos, OCS" required>
                </div>

                <div class="form-group">
                    <label for="biografia">Biografía (Opcional)</label>
                    <textarea name="biografia" id="biografia" class="form-control tinymce-editor" rows="10">{{ old('biografia', $autoridad->biografia) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Foto (Opcional)</label>
                    @if($autoridad->foto_path)
                        <div class="mb-2">
                            <p>Foto actual:</p>
                            <img src="{{ asset('storage/' . $autoridad->foto_path) }}" alt="Foto actual" style="max-width: 200px; height: auto;">
                        </div>
                    @endif
                    <div class="custom-file-upload">
                        <label for="foto_path" class="btn btn-info">Seleccionar Imagen</label>
                        <span id="foto_path_name" style="margin-left: 10px;">No se ha seleccionado ninguna imagen.</span>
                        <input type="file" name="foto_path" id="foto_path" style="display: none;" onchange="document.getElementById('foto_path_name').textContent = this.files.length > 0 ? this.files[0].name : 'No se ha seleccionado ninguna imagen.';">
                    </div>
                    <small class="form-text text-muted">Sube una nueva foto para reemplazar la actual.</small>
                </div>

                <div class="form-group">
                    <label>Currículum en PDF (Opcional)</label>
                    @if($autoridad->pdf_path)
                        <div class="mb-2">
                            <p>PDF actual: <a href="{{ asset('storage/' . $autoridad->pdf_path) }}" target="_blank">Ver PDF</a></p>
                        </div>
                    @endif
                    <div class="custom-file-upload">
                        <label for="pdf_path" class="btn btn-info">Seleccionar PDF</label>
                        <span id="pdf_path_name" style="margin-left: 10px;">No se ha seleccionado ningún PDF.</span>
                        <input type="file" name="pdf_path" id="pdf_path" accept="application/pdf" style="display: none;" onchange="document.getElementById('pdf_path_name').textContent = this.files.length > 0 ? this.files[0].name : 'No se ha seleccionado ningún PDF.';">
                    </div>
                    <small class="form-text text-muted">Sube un nuevo PDF para reemplazar el actual.</small>
                </div>

                <div class="form-group">
                    <label for="orden">Orden de Aparición</label>
                    <input type="number" name="orden" id="orden" class="form-control" value="{{ old('orden', $autoridad->orden) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Actualizar Autoridad</button>
                <a href="{{ route('admin.autoridades.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
