@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Inscripciones a Cursos de Educación Continua</h2>
        @if($programa_id)
            <a href="{{ route('admin.inscripciones.export', ['programa_id' => $programa_id]) }}" class="btn btn-success">
                <i class="bi bi-download"></i> Descargar CSV
            </a>
        @endif
    </div>
    <div class="alert alert-info" style="max-width:700px">
        <b>Nota:</b> Si al abrir el archivo CSV en Excel los datos aparecen en una sola columna, use la opción <b>Datos &gt; Desde texto/CSV</b> y seleccione <b>punto y coma (;)</b> como delimitador.<br>
        También puede cambiar la configuración regional de Excel para que reconozca el punto y coma como separador predeterminado.
    </div>
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-6">
            <select name="programa_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Filtrar por curso --</option>
                @foreach($programas as $prog)
                    <option value="{{ $prog->id }}" @if($programa_id == $prog->id) selected @endif>{{ $prog->title }}</option>
                @endforeach
            </select>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Curso</th>
                    <th>Modalidad</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Especialidad</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inscripciones as $insc)
                    <tr>
                        <td>{{ $insc->id }}</td>
                        <td>{{ $insc->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $insc->programa->title ?? '-' }}</td>
                        <td>{{ $insc->modalidad->title ?? '-' }}</td>
                        <td>{{ $insc->nombre }}</td>
                        <td>{{ $insc->cedula }}</td>
                        <td>{{ $insc->email }}</td>
                        <td>{{ $insc->telefono }}</td>
                        <td>{{ $insc->especialidad }}</td>
                        <td>{{ $insc->observaciones }}</td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center">No hay inscripciones registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $inscripciones->withQueryString()->links() }}
    </div>
</div>
@endsection
