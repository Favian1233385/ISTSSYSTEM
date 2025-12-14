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
            <textarea name="answer" id="answer" class="form-control" rows="5">{{ old('answer', $qa->answer ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Q&A</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#answer',
        height: 250,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        language: 'es',
        branding: false
    });
</script>
@endpush
