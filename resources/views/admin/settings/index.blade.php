@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>⚙️ Configuración General</h1>
        <p>Administra la configuración general del sitio web.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h3>Información del Instituto</h3>
                <div class="form-group">
                    <label for="institute_name">Nombre del Instituto</label>
                    <input type="text" name="institute_name" id="institute_name" class="form-control" value="{{ old('institute_name', $settings['institute_name'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="institute_motto">Lema del Instituto</label>
                    <input type="text" name="institute_motto" id="institute_motto" class="form-control" value="{{ old('institute_motto', $settings['institute_motto'] ?? '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <h3>Información de Contacto</h3>
                <div class="form-group">
                    <label for="contact_address">Dirección</label>
                    <input type="text" name="contact_address" id="contact_address" class="form-control" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="contact_phone">Teléfono</label>
                    <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="contact_email">Email</label>
                    <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="contact_hours">Horario de Atención</label>
                    <input type="text" name="contact_hours" id="contact_hours" class="form-control" value="{{ old('contact_hours', $settings['contact_hours'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="contact_whatsapp">WhatsApp (con código de país)</label>
                    <input type="text" name="contact_whatsapp" id="contact_whatsapp" class="form-control" value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '') }}" placeholder="+593991234567">
                    <small class="form-text text-muted">Ejemplo: +593991234567 (incluir código de país)</small>
                </div>
                <div class="form-group">
                    <label for="contact_whatsapp_message">Mensaje predeterminado de WhatsApp</label>
                    <input type="text" name="contact_whatsapp_message" id="contact_whatsapp_message" class="form-control" value="{{ old('contact_whatsapp_message', $settings['contact_whatsapp_message'] ?? '') }}" placeholder="Hola, quiero información sobre el ISTS Sucúa">
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Redes Sociales</h3>
                <div class="form-group">
                    <label for="social_facebook">Facebook URL</label>
                    <input type="url" name="social_facebook" id="social_facebook" class="form-control" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="social_twitter">Twitter URL</label>
                    <input type="url" name="social_twitter" id="social_twitter" class="form-control" value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="social_instagram">Instagram URL</label>
                    <input type="url" name="social_instagram" id="social_instagram" class="form-control" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="social_linkedin">LinkedIn URL</label>
                    <input type="url" name="social_linkedin" id="social_linkedin" class="form-control" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="social_telegram">Telegram (Grupo/Canal)</label>
                    <input type="url" name="social_telegram" id="social_telegram" class="form-control" value="{{ old('social_telegram', $settings['social_telegram'] ?? '') }}" placeholder="https://t.me/istssucua">
                </div>
                <div class="form-group">
                    <label for="social_youtube">YouTube (Canal)</label>
                    <input type="url" name="social_youtube" id="social_youtube" class="form-control" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" placeholder="https://youtube.com/@istssucua">
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>📚 Enlaces Externos del Campus</h3>
                <div class="form-group">
                    <label for="biblioteca_url">Biblioteca (URL Externa)</label>
                    <input type="url" name="biblioteca_url" id="biblioteca_url" class="form-control" 
                           value="{{ old('biblioteca_url', $settings['biblioteca_url'] ?? '') }}"
                           placeholder="https://biblioteca.ejemplo.com">
                    <small class="form-text text-muted">Este enlace aparecerá en el menú Campus del sitio público</small>
                </div>
                <div class="form-group">
                    <label for="seguimiento_graduados_url">Seguimiento a Graduados (URL Externa)</label>
                    <input type="url" name="seguimiento_graduados_url" id="seguimiento_graduados_url" class="form-control" 
                           value="{{ old('seguimiento_graduados_url', $settings['seguimiento_graduados_url'] ?? '') }}"
                           placeholder="https://graduados.ejemplo.com">
                    <small class="form-text text-muted">Este enlace aparecerá en el menú Campus del sitio público</small>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Guardar Configuración</button>
    </form>
</div>
@endsection
