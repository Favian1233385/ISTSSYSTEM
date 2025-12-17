@extends('admin.layout')

@section('content')
    <style>
        .card-table {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
            padding: 2.2rem 2.2rem 1.5rem 2.2rem;
            max-width: 900px;
            margin: 2.5rem auto 0 auto;
        }
        .card-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .card-table th {
            background: #f3f6fd;
            color: #2563eb;
            font-weight: 700;
            font-size: 1.08rem;
            padding: 12px 8px;
            border-bottom: 2px solid #e0e7ef;
            text-align: left;
        }
        .card-table td {
            padding: 13px 8px;
            font-size: 1.01rem;
            border-bottom: 1px solid #f1f5fa;
            vertical-align: middle;
        }
        .action-btns { display: flex; gap: 10px; align-items: center; }
        .btn-toggle, .btn-edit {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 8px 22px;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            transition: background 0.2s;
            min-width: 110px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(37,99,235,0.08);
        }
        .btn-toggle:hover, .btn-edit:hover { background: #1746a2; color: #fff; }
        .btn-new-social {
            display: inline-block;
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 6px;
            font-size: 1.08rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            transition: background 0.2s;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(37,99,235,0.08);
        }
        .btn-new-social:hover {
            background: #1746a2;
            color: #fff;
        }
        .status-label {
            font-weight: 700;
            font-size: 1rem;
            padding: 4px 18px;
            border-radius: 14px;
            display: inline-block;
            letter-spacing: 0.5px;
        }
        .status-active {
            color: #1b8c36;
            background: #e6f9ed;
        }
        .status-inactive {
            color: #888;
            background: #f2f2f2;
        }
        @media (max-width: 900px) {
            .card-table { padding: 1.2rem 0.5rem; }
        }
        @media (max-width: 600px) {
            .card-table { padding: 0.5rem 0.1rem; }
            .card-table th, .card-table td { font-size: 0.97rem; padding: 8px 4px; }
            .btn-toggle, .btn-edit { padding: 7px 10px; min-width: 80px; font-size: 0.95rem; }
        }
    </style>
    <div class="card-table">
        <a href="{{ route('admin.social_links.create') }}" class="btn-new-social mb-3">+ Nueva Red Social</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Red</th>
                    <th>Enlace</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>{{ ucfirst($link->name) }}</td>
                        <td><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
                        <td>
                            @if($link->active)
                                <span class="status-label status-active">Activo</span>
                            @else
                                <span class="status-label status-inactive">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.social_links.edit', $link->id) }}" class="btn-edit">Editar</a>
                                <form action="{{ route('admin.social_links.toggle', $link->id) }}" method="POST" style="display:inline; margin:0;">
                                    @csrf
                                    <button type="submit" class="btn-toggle">{{ $link->active ? 'Desactivar' : 'Activar' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
