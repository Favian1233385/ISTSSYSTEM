@extends('layouts.admin')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem;">
    <div class="card-body p-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold mb-1" style="font-size:2.3rem; color:#00796b; letter-spacing:-1px;">
                <span style="font-size:2.2rem;">📄</span> Gestión de Documentos
            </h1>
            <p class="text-muted mb-3">Administra los contenidos del sitio.</p>
            <a href="{{ route('admin.contents.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">Crear Sección</a>
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

        <div class="card-table" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10); padding: 2.2rem 2.2rem 1.5rem 2.2rem; max-width: 1100px; margin: 2.5rem auto 0 auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                <thead style="background: #f3f6fd; color: #2563eb; font-weight: 700; font-size: 1.08rem;">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Documentos</th>
                        <th>Sitios Externos</th>
                        <th>Estado</th>
                        <th>Creado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($is_hierarchical) && $is_hierarchical)
                        @foreach ($items as $parent)
                            <tr>
                                <td>{{ $parent["id"] }}</td>
                                <td><strong>{{ $parent["title"] }}</strong></td>
                                <td>
                                    @if(!empty($parent['file_url']))
                                        @php $files = json_decode($parent['file_url'], true); @endphp
                                        @if(is_array($files))
                                            @foreach($files as $file)
                                                <a href="{{ asset($file) }}" target="_blank">Ver Archivo</a><br>
                                            @endforeach
                                        @elseif(filter_var($parent['file_url'], FILTER_VALIDATE_URL))
                                            <a href="{{ $parent['file_url'] }}" target="_blank">Ver Archivo Externo</a>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($parent['is_external']) && !empty($parent['url']))
                                        <a href="{{ $parent['url'] }}" target="_blank">{{ $parent['url'] }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><span class="badge" style="background:{{ $parent['status']==='published' ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">{{ $parent["status"] }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($parent["created_at"])->format('d/m/Y') }}</td>
                                <td class="actions" style="display:flex; gap:0.5em;">
                                    <a href="{{ route('admin.contents.edit', $parent['id']) }}" class="btn btn-edit-uniform" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10); min-width:120px; text-align:center;">Editar</a>
                                    <form action="{{ route('admin.contents.destroy', $parent['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);">Eliminar</button>
                                    </form>
                                    @if($parent['category'] !== 'tramites')
                                        <a href="{{ route('admin.contents.create', ['parent_id' => $parent['id']]) }}" class="btn" style="background: #009e60; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(0,158,96,0.10);">Agregar Subreglamento</a>
                                    @endif
                                </td>
                            </tr>
                        @if($parent['category'] !== 'tramites' && !empty($parent['children']))
                            @foreach($parent['children'] as $child)
                                <tr style="background-color: #f9f9f9;">
                                    <td>{{ $child["id"] }}</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;└─ {{ $child["title"] }} <small>(Sub-reglamento)</small></td>
                                    <td>
                                        @if(!empty($child['file_url']))
                                            @php $files = json_decode($child['file_url'], true); @endphp
                                            @if(is_array($files))
                                                @foreach($files as $file)
                                                    <a href="{{ asset($file) }}" target="_blank">Ver Archivo</a><br>
                                                @endforeach
                                            @elseif(filter_var($child['file_url'], FILTER_VALIDATE_URL))
                                                <a href="{{ $child['file_url'] }}" target="_blank">Ver Archivo Externo</a>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($child['is_external']) && !empty($child['url']))
                                            <a href="{{ $child['url'] }}" target="_blank">{{ $child['url'] }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td><span class="badge" style="background:{{ $child['status']==='published' ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">{{ $child["status"] }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($child["created_at"])->format('d/m/Y') }}</td>
                                    <td class="actions" style="display:flex; gap:0.5em;">
                                        <a href="{{ route('admin.contents.edit', $child['id']) }}" class="btn btn-edit-uniform" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10); min-width:120px; text-align:center;">Editar</a>
                                        <form action="{{ route('admin.contents.destroy', $child['id']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @endforeach
                    @else
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item["id"] }}</td>
                                <td>{{ $item["title"] }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td><span class="badge" style="background:{{ $item['status']==='published' ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">{{ $item["status"] }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item["created_at"])->format('d/m/Y') }}</td>
                                <td class="actions" style="display:flex; gap:0.5em;">
                                    <a href="{{ route('admin.contents.edit', $item['id']) }}" class="btn btn-edit-uniform" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10); min-width:120px; text-align:center;">Editar</a>
                                    <form action="{{ route('admin.contents.destroy', $item['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <style>
            .btn-edit-uniform {
                min-width: 120px !important;
                min-height: 44px !important;
                height: 44px !important;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
        </style>
        <div class="d-flex justify-content-center mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
