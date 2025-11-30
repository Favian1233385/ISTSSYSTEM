@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Inscripciones a Cursos de Educación Continua</h2>
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
