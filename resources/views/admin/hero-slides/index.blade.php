@extends('layouts.admin')

@section('title', 'Slides del Carrusel')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 1100px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h2 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">🖼️</span> Listado de slides
            </h2>
            <a href="{{ route('admin.hero-slides.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">Crear nuevo slide</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Subtítulo</th>
                        <th>Imagen</th>
                        <th>Enlace</th>
                        <th>Orden</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr>
                            <td>{{ $slide->id }}</td>
                            <td>{{ $slide->title }}</td>
                            <td>{{ $slide->subtitle }}</td>
                            <td>
                                @if($slide->image_path)
                                    <img src="{{ asset('storage/uploads/images/' . $slide->image_path) }}" alt="{{ $slide->title }}" style="width: 90px; border-radius:8px; box-shadow:0 2px 8px rgba(0,158,96,0.10);">
                                @endif
                            </td>
                            <td>{{ $slide->link }}</td>
                            <td>{{ $slide->sort_order }}</td>
                            <td>
                                <span class="badge" style="background:{{ $slide->is_active ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    {{ $slide->is_active ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="{{ route('admin.hero-slides.edit', $slide->id) }}" class="btn" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:100px; text-align:center;">Editar</a>
                                <form action="{{ route('admin.hero-slides.destroy', $slide->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:100px; text-align:center;" onclick="return confirm('¿Eliminar este slide?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No hay slides registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
