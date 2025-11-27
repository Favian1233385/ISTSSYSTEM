@extends('admin.layout')
@section('content')
<div class="container">
    <h1>Gestión de Acerca</h1>
    <a href="{{ route('about.create') }}" class="btn btn-primary mb-3">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>PDF</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ Str::limit($item->description, 50) }}</td>
                <td>@if($item->image)<img src="{{ asset('storage/'.$item->image) }}" width="60">@endif</td>
                <td>@if($item->pdf)<a href="{{ asset('storage/'.$item->pdf) }}" target="_blank">Ver PDF</a>@endif</td>
                <td>
                    <a href="{{ route('about.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('about.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
