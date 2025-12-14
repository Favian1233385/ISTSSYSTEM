@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Índice A-Z</h1>
    <ul class="nav nav-tabs mb-4" id="azTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="personas-tab" data-bs-toggle="tab" data-bs-target="#personas" type="button" role="tab">Personas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="areas-tab" data-bs-toggle="tab" data-bs-target="#areas" type="button" role="tab">Áreas/Servicios</button>
        </li>
    </ul>
    <div class="tab-content" id="azTabsContent">
        <div class="tab-pane fade show active" id="personas" role="tabpanel">
            <h3 class="mb-3">Personas</h3>
            <input type="text" class="form-control mb-3" placeholder="Buscar persona...">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $p)
                        <tr>
                            <td>{{ $p->name ?? ($p->first_name . ' ' . $p->last_name) }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->role ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="areas" role="tabpanel">
            <h3 class="mb-3">Áreas y Servicios</h3>
            <input type="text" class="form-control mb-3" placeholder="Buscar área o servicio...">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Nombre/Título</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carreras as $c)
                        <tr>
                            <td>Carrera</td>
                            <td>{{ $c->name }}</td>
                        </tr>
                    @endforeach
                    @foreach($secciones as $s)
                        <tr>
                            <td>Sección Académica</td>
                            <td>{{ $s->name }}</td>
                        </tr>
                    @endforeach
                    @foreach($servicios as $srv)
                        <tr>
                            <td>Servicio</td>
                            <td>{{ $srv->title }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
