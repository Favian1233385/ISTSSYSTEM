@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <h2>Crear Contenido para {{ $campusItem->title }}</h2>
    <form action="{{ route('admin.campus-item-contents.store', $campusItem) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título *</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="external_url" class="form-label">Enlace externo</label>
            <input type="url" name="external_url" id="external_url" class="form-control">
        </div>
        <div class="mb-3">
            <label for="pdf_file" class="form-label">Archivo PDF</label>
            <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept="application/pdf">
        </div>
        <div class="mb-3">
            <label for="image_file" class="form-label">Imagen (local) <span class="text-muted">(opcional)</span></label>
            <input type="file" name="image_file" id="image_file" class="form-control" accept="image/*">
            <small class="form-text text-muted">Puedes dejar vacío si no deseas agregar una imagen.</small>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Imagen (URL externa) <span class="text-muted">(opcional)</span></label>
            <input type="url" name="image_url" id="image_url" class="form-control" placeholder="https://...">
            <small class="form-text text-muted">Puedes dejar vacío si no deseas agregar una imagen externa.</small>
        </div>
        <div class="mb-3">
            <label for="video_file" class="form-label">Video (local) <span class="text-muted">(opcional)</span></label>
            <input type="file" name="video_file" id="video_file" class="form-control" accept="video/*">
            <small class="form-text text-muted">Puedes dejar vacío si no deseas agregar un video.</small>
        </div>
        <div class="mb-3">
            <label for="video_url" class="form-label">Video (URL externa) <span class="text-muted">(opcional)</span></label>
            <input type="url" name="video_url" id="video_url" class="form-control" placeholder="https://...">
            <small class="form-text text-muted">Puedes dejar vacío si no deseas agregar un video externo.</small>
        </div>
        <div class="mb-3">
            <label for="contact_name" class="form-label">Nombre del docente/contacto</label>
            <input type="text" name="contact_name" id="contact_name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Email de contacto</label>
            <input type="email" name="contact_email" id="contact_email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="contact_phone" class="form-label">Teléfono de contacto</label>
            <input type="text" name="contact_phone" id="contact_phone" class="form-control">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="enable_default_form" id="enable_default_form" class="form-check-input" value="1" checked onclick="toggleDefaultForm()">
            <label for="enable_default_form" class="form-check-label">Activar formulario predeterminado</label>
        </div>
        <div id="defaultFormFields">
            <h5>Formulario predeterminado</h5>
            <div class="mb-2"><label class="form-label">Nombres</label><input type="text" class="form-control" disabled></div>
            <div class="mb-2"><label class="form-label">Cédula</label><input type="text" class="form-control" disabled></div>
            <div class="mb-2"><label class="form-label">Carrera</label><input type="text" class="form-control" disabled></div>
            <div class="mb-2"><label class="form-label">Ciclo</label><input type="text" class="form-control" disabled></div>
            <div class="mb-2"><label class="form-label">Nivel al que va</label><input type="text" class="form-control" disabled></div>
            <div class="mb-2"><label class="form-label">Nombre de la institución</label><input type="text" class="form-control" disabled></div>
            <div class="mb-2"><label class="form-label">Cargar PDF</label><input type="file" class="form-control" disabled></div>
            <small class="form-text text-muted">Estos campos serán incluidos automáticamente en el formulario para los usuarios.</small>
        </div>
        <div id="customFormHtml" style="display:none;">
            <label for="form_html" class="form-label">Formulario personalizado (HTML)</label>
            <textarea name="form_html" id="form_html" class="form-control" rows="5"></textarea>
            <small class="form-text text-muted">Puedes pegar aquí el HTML de un formulario personalizado.</small>
        </div>
        <script>
            function toggleDefaultForm() {
                var checked = document.getElementById('enable_default_form').checked;
                document.getElementById('defaultFormFields').style.display = checked ? 'block' : 'none';
                document.getElementById('customFormHtml').style.display = checked ? 'none' : 'block';
            }
            document.addEventListener('DOMContentLoaded', function() {
                toggleDefaultForm();
            });
        </script>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" checked>
            <label for="is_active" class="form-check-label">Activo</label>
        </div>
        <button type="submit" class="btn btn-primary">Guardar contenido</button>
    </form>
</div>
@endsection
