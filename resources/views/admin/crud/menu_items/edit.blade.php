@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Elemento del Menú</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.menu_items.update', $item) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" id="url" class="form-control" value="{{ $item->url }}" placeholder="Ej: /acerca">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Padre (opcional)</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">Ninguno</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ $item->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order">Orden</label>
                            <input type="number" name="order" id="order" class="form-control" value="{{ $item->order }}">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Activo</label>
                            <input type="checkbox" name="is_active" id="is_active" {{ $item->is_active ? 'checked' : '' }}>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
