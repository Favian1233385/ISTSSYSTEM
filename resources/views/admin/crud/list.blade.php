@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1>{{ $title ?? 'Listado de Registros' }}</h1>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            @foreach ($headers as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                            <tr>
                                @foreach ($record as $field)
                                    <td>{{ $field }}</td>
                                @endforeach
                                <td>
                                    <a href="{{ url("/admin/$type/edit/" . $record['id']) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ url("/admin/$type/delete/" . $record['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($headers) + 1 }}" class="text-center">No hay registros disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection