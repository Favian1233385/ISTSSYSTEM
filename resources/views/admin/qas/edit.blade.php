@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>🤖 Editar Q&A</h1>
        <p>Modifica el formulario para editar la pregunta y respuesta.</p>
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

    <form action="{{ route('admin.qas.update', $item) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Pregunta o Palabras Clave</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $item->question) }}" required>
            <small class="form-text text-muted">Puedes usar palabras clave separadas por comas (ej: hola, buenos días, saludo).</small>
        </div>
        <div class="form-group">
            <label for="answer">Respuesta</label>
            <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ old('answer', $item->answer) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Q&A</button>
    </form>
</div>
@endsection
