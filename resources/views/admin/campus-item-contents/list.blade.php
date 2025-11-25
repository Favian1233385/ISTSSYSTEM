@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <h2>Contenidos de {{ $campusItem->title }}</h2>
    <a href="{{ route('admin.campus-item-contents.create', $campusItem) }}" class="btn btn-primary mb-3">Crear nuevo contenido</a>
    @if($contents->count() === 0)
        <p>No hay contenidos asociados.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Imagen</th>
                    <th>Video</th>
                    <th>Contacto</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $content)
                <tr>
                    <td>{{ $content->title }}</td>
                    <td>{{ $content->date }}</td>
                    <td>
                        @if($content->image_path)
                            <img src="{{ asset($content->image_path) }}" alt="img" style="max-width:80px;max-height:60px;">
                        @elseif($content->image_url)
                            <img src="{{ $content->image_url }}" alt="img" style="max-width:80px;max-height:60px;">
                        @endif
                    </td>
                    <td>
                        @if($content->video_path)
                            <video src="{{ asset($content->video_path) }}" style="max-width:80px;max-height:60px;" controls></video>
                        @elseif($content->video_url)
                            <video src="{{ $content->video_url }}" style="max-width:80px;max-height:60px;" controls></video>
                        @endif
                    </td>
                    <td>{{ $content->contact_name }}</td>
                    <td>{{ $content->is_active ? 'Sí' : 'No' }}</td>
                    <td>
                        <!-- Aquí irían los enlaces de editar/eliminar si se implementan -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
