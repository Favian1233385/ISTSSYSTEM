@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Crear Rector</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.contents.rector.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>Cargo</label>
            <input type="text" name="position" class="form-control" value="{{ old('position') }}" placeholder="e.g. Rector, Director(a)">
        </div>

        <div class="form-group">
            <label>Título académico</label>
            <input type="text" name="academic_title" class="form-control" value="{{ old('academic_title') }}" placeholder="e.g. Ph.D., MSc, Ing.">
        </div>

        <div class="form-group">
            <label>Mensaje (completo)</label>
            <textarea name="message" id="rector-message-editor" class="form-control" rows="6">{{ old('message') }}</textarea>
        </div>

        <div class="form-group">
            <label>Imagen (jpg, png)</label>
            <input type="file" name="image" accept="image/*" class="form-control">
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="is_active" value="1" checked> Mostrar en la página pública</label>
        </div>

        <button class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#rector-message-editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 300
    });
</script>
@endpush
