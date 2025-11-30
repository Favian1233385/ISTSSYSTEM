
@extends('layouts.public')

@section('content')

<div class="container main-content" style="max-width: 600px; margin: 0 auto;">
    <div class="inscripcion-form-box" style="margin-top: 5rem; margin-bottom: 3rem; background: var(--color-light); border-radius: 16px; box-shadow: var(--shadow-lg); padding: 2.5rem 2rem;">
        <div class="text-center mb-4">
            <h1 class="section-title" style="font-family: var(--font-heading); color: var(--color-secondary); font-size: 2.2rem; font-weight: 700; margin-bottom: 1.2rem; letter-spacing: 1px;">Inscripción al curso</h1>
            <div class="mb-3" style="font-size:1.1rem; color:var(--color-gray);">
                <span class="badge" style="background: var(--color-primary); color: #fff; font-size:1rem; padding: 0.5em 1.2em; border-radius: 8px;">Modalidad: {{ $modalidad->title ?? '' }}</span>
                <span class="badge" style="background: var(--color-secondary); color: #fff; font-size:1rem; padding: 0.5em 1.2em; border-radius: 8px; margin-left: 0.5em;">Curso: {{ $programa->title }}</span>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('inscripcion.store') }}">
            @csrf
            <input type="hidden" name="modalidad_id" value="{{ $modalidad->id ?? '' }}">
            <input type="hidden" name="programa_id" value="{{ $programa->id }}">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Nombre completo <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form-control" required value="{{ old('nombre') }}">
                    @error('nombre')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}">
                    @error('cedula')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                    @error('telefono')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Especialidad</label>
                    <input type="text" name="especialidad" class="form-control" value="{{ old('especialidad') }}">
                    @error('especialidad')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                    @error('observaciones')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Inscribirse</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Regresar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
