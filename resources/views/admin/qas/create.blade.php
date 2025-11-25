@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>🤖 Añadir Q&A</h1>
        <p>Rellena el formulario para añadir una nueva pregunta y respuesta al chatbot.</p>
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

    <form action="{{ route('admin.qas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Pregunta o Palabras Clave</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
            <small class="form-text text-muted">Puedes usar palabras clave separadas por comas (ej: hola, buenos días, saludo).</small>
        </div>
        <div class="form-group">
            <label for="answer">Respuesta</label>
            <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ old('answer') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Añadir Q&A</button>
    </form>
</div>
@endsection
