@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👩‍🏫 Editar Docente</h1>
        <p>Modifica el formulario para editar un docente.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        .form-docente {
            max-width: 540px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(30,30,30,0.08);
            padding: 2.5rem 2rem 2rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        .form-docente label {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: 0.3rem;
            display: block;
        }
        .form-docente input[type="text"],
        .form-docente input[type="number"],
        .form-docente input[type="file"],
        .form-docente textarea {
            width: 100%;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            padding: 0.6rem 1rem;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            background: #f8fafc;
            transition: border 0.2s;
        }
        .form-docente input[type="text"]:focus,
        .form-docente input[type="number"]:focus,
        .form-docente textarea:focus {
            border-color: #1976d2;
            outline: none;
        }
        .form-docente textarea {
            min-height: 80px;
            resize: vertical;
        }
        .form-docente .form-row {
            display: flex;
            gap: 1rem;
        }
        .form-docente .form-row > div {
            flex: 1 1 0;
        }
        .form-docente .btn-submit {
            background: linear-gradient(90deg, #1976d2 0%, #43cea2 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 0.8rem 2.2rem;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(30,30,30,0.08);
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0.5rem;
        }
        .form-docente .btn-submit:hover {
            background: linear-gradient(90deg, #43cea2 0%, #1976d2 100%);
        }
        @media (max-width: 600px) {
            .form-docente {
                padding: 1.2rem 0.7rem;
            }
            .form-docente .form-row {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>

    <form class="form-docente" method="POST" action="{{ route('admin.teachers.update', $item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" required>
            </div>
            <div>
                <label for="title">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}">
            </div>
        </div>
        <div class="form-row">
            <div>
                <label for="department">Departamento</label>
                <input type="text" name="department" id="department" value="{{ old('department', $item->department) }}">
            </div>
            <div>
                <label for="order">Orden</label>
                <input type="number" name="order" id="order" value="{{ old('order', $item->order) }}">
            </div>
        </div>
        <div>
            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio">{{ old('bio', $item->bio) }}</textarea>
        </div>
        <div class="form-row">
            <div>
                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*">
                @if($item->image_path)
                    <div style="margin-top:6px; font-size:13px; color:#1976d2;">Imagen actual: <a href="{{ asset('storage/' . $item->image_path) }}" target="_blank">Ver imagen</a></div>
                @endif
            </div>
            <div>
                <label for="pdf">PDF (Currículum)</label>
                <input type="file" name="pdf" id="pdf" accept="application/pdf">
                @if($item->pdf_path)
                    <div style="margin-top:6px; font-size:13px; color:#1976d2;">PDF actual: <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank">Ver PDF</a></div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn-submit">Actualizar Docente</button>
    </form>
</div>
@endsection
