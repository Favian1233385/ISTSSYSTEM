@extends('admin.layout')

@section('title', 'Contactos del Chatbot')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Contactos del Chatbot</h2>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->nombre }}</td>
                            <td>{{ $contact->telefono }}</td>
                            <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay contactos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
