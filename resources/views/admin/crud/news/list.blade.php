@extends('layouts.admin')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem;">
    <div class="card-body p-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold mb-1" style="font-size:2.3rem; color:#00796b; letter-spacing:-1px;">
                <span style="font-size:2.2rem;">📰</span> Gestión de Noticias
            </h1>
            <p class="text-muted mb-3">Administra las noticias del sitio.</p>
            <a href="{{ route('admin.news.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">Crear Noticia</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
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
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Estado</th>
                        <th>Vistas</th>
                        <th>Publicado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                        <tr style="background: #fff;">
                            <td class="fw-semibold">{{ $item["id"] }}</td>
                            <td style="font-weight:600; @if($item['status']==='published')color:#1a3c34;@endif">{{ $item["title"] }}</td>
                            <td>{{ $item["author"] ?? 'N/A' }}</td>
                            <td>
                                <span class="badge" style="background:{{ $item['status']==='published' ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    {{ $item["status"] }}
                                </span>
                            </td>
                            <td>{{ $item["views"] }}</td>
                            <td>{{ \Carbon\Carbon::parse($item["published_at"])->format('d/m/Y') }}</td>
                            <td class="actions" style="display:flex; gap:0.5em;">
                                <a href="{{ route('admin.news.edit', $item['id']) }}" class="btn" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10);">Editar</a>
                                <form action="{{ route('admin.news.destroy', $item['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta noticia?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">No hay noticias registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
