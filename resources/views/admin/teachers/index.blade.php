@extends('layouts.admin')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 1200px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <div>
                <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                    <span style="font-size:2.2rem;">👩‍🏫</span> Gestión de Planta Docente
                </h1>
                <p class="text-muted mb-0" style="font-size:1.1rem;">Administra la planta docente del instituto.</p>
            </div>
            <a href="{{ route('admin.teachers.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">+ Añadir Docente</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
                    <tr>
                        <th>Orden</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Título</th>
                        <th>Departamento</th>
                        <th>PDF</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->order }}</td>
                            <td>
                                @if($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit:cover; box-shadow:0 2px 8px rgba(0,158,96,0.10);">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%;">
                                        <i class="bi bi-person" style="font-size: 22px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight:600;">{{ $item->name }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->department }}</td>
                            <td>
                                @if($item->pdf_path)
                                    <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank" style="color:#009e60; font-weight:600; text-decoration:underline;">Ver PDF</a>
                                @endif
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="{{ route('admin.teachers.edit', $item) }}" class="btn" style="background: linear-gradient(90deg,#253b7d,#f9d423 90%); color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" title="Editar">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('admin.teachers.destroy', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" title="Eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar a este docente?');">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
