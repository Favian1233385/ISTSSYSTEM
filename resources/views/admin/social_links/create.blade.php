@extends('admin.layout')

@section('content')
    <style>
        .card-form {
            max-width: 480px;
            margin: 2.5rem auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
            padding: 2.5rem 2rem 2rem 2rem;
        }
        .card-form h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-group { margin-bottom: 1.3rem; }
        .form-group label { font-weight: 600; color: #1746a2; margin-bottom: 0.4rem; display: block; }
        .form-control {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid #dbeafe;
            border-radius: 8px;
            font-size: 1rem;
            background: #f8fafc;
            color: #222;
            transition: border 0.2s;
        }
        .form-control:focus {
            border-color: #2563eb;
            outline: none;
            background: #fff;
        }
        .form-check {
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-check-label { font-weight: 500; color: #2563eb; }
        .btn-create {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 10px 32px;
            border-radius: 6px;
            font-size: 1.08rem;
            font-weight: 700;
            margin-right: 10px;
            box-shadow: 0 2px 8px rgba(37,99,235,0.08);
            transition: background 0.2s;
        }
        .btn-create:hover { background: #1746a2; color: #fff; }
        .btn-cancel {
            background: #e5e7eb;
            color: #222;
            border: none;
            padding: 10px 28px;
            border-radius: 6px;
            font-size: 1.08rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-cancel:hover { background: #cbd5e1; color: #111; }
        .form-group small { color: #888; font-size: 0.95em; }
    </style>
    <div class="container my-4">
        <div class="card shadow-sm mx-auto" style="max-width:900px;">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-3">
                        <span style="font-size:2.2rem; color:#2563eb;">🔗</span>
                        <h2 class="fw-bold mb-0" style="font-size:1.7rem; letter-spacing:0.5px;">Crear nueva red social</h2>
                    </div>
                    <a href="{{ route('admin.social_links.index') }}" class="btn btn-outline-primary fw-bold">← Volver</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-form">
        <form method="POST" action="{{ route('admin.social_links.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="url">Enlace</label>
                <input type="url" name="url" id="url" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="bg_color">Color de fondo (hex o CSS)</label>
                <input type="text" name="bg_color" id="bg_color" class="form-control" placeholder="#1877f2 o radial-gradient(...)" required>
            </div>
            <div class="form-group">
                <label for="icon_svg">SVG del ícono</label>
                <textarea name="icon_svg" id="icon_svg" class="form-control" rows="3" required></textarea>
                <small>Pega aquí el código SVG (sin etiquetas &lt;script&gt;).</small>
            </div>
            <div class="form-check">
                <input type="checkbox" name="active" id="active" class="form-check-input" checked>
                <label for="active" class="form-check-label">Activo</label>
            </div>
            <button type="submit" class="btn-create">Crear</button>
            <a href="{{ route('admin.social_links.index') }}" class="btn-cancel">Cancelar</a>
        </form>
    </div>
@endsection
