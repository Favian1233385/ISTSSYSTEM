<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Editar Noticia - ISTS Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoists.png') }}" sizes="32x32">
</head>
<body class="admin-body">
    <!-- Header Administrativo -->
    <header class="admin-header">
        <div class="admin-header-content">
            <div class="admin-logo">
                <img src="{{ asset('public/assets/images/logo-ists.png') }}" alt="ISTS Logo" class="admin-logo-img">
                <h1>ISTS Admin</h1>
            </div>

            <nav class="admin-nav">
                <ul class="admin-nav-menu">
                    <li><a href="{{ url('admin/dashboard') }}">📊 Dashboard</a></li>
                    <li><a href="{{ url('admin/contents') }}">📝 Contenidos</a></li>
                    <li><a href="{{ url('admin/news') }}" class="active">📰 Noticias</a></li>
                    <li><a href="{{ url('admin/users') }}">👥 Usuarios</a></li>
                    <li><a href="{{ url('admin/settings') }}">⚙️ Configuración</a></li>
                </ul>
            </nav>

            <div class="admin-user-menu">
                <div class="user-info">
                    <span class="user-name">{{ session('user_email', 'Usuario') }}</span>
                    <div class="user-dropdown">
                        <a href="{{ url('admin/profile') }}">👤 Perfil</a>
                        <a href="{{ url('auth/change-password') }}">🔒 Cambiar Contraseña</a>
                        <a href="{{ url('auth/logout') }}">🚪 Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>📰 Editar Noticia</h1>
                    <p>Modifica el formulario para editar la noticia.</p>
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

                <form action="{{ route('admin.news.update', $news['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $news['title']) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="summary">Resumen</label>
                        <textarea name="summary" id="summary" class="form-control tinymce-editor" rows="3">{{ old('summary', $news['summary']) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <textarea name="content" id="content" class="form-control tinymce-editor" rows="10">{{ old('content', $news['content']) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="images">Imágenes</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                        <small>Puedes seleccionar varias imágenes. La primera será la principal.</small>
                        @if(isset($news['images']) && is_array($news['images']))
                            <div style="margin-top:10px;">
                                @foreach($news['images'] as $idx => $img)
                                    <div style="display:inline-block; margin-right:8px; margin-bottom:8px; text-align:center;">
                                        <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="Imagen" style="max-width: 120px; display:block; margin-bottom:4px;">
                                        <label style="font-size:12px;">
                                            <input type="checkbox" name="remove_images[]" value="{{ $idx }}"> Eliminar
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select name="status" id="status" class="form-control">
                            <option value="draft" @if(old('status', $news['status']) == 'draft') selected @endif>Borrador</option>
                            <option value="published" @if(old('status', $news['status']) == 'published') selected @endif>Publicado</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Noticia</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer Administrativo -->
    <footer class="admin-footer">
        <div class="admin-footer-content">
            <p>&copy; {{ date('Y') }} Instituto Superior Tecnológico Sucúa - Panel Administrativo Todos los Derechos reservados F.C</p>
            <div class="admin-footer-links">
                <a href="{{ url('/') }}" target="_blank">🌐 Ver Sitio Web</a>
                <a href="{{ url('/admin/help') }}">❓ Ayuda</a>
                <a href="{{ url('/admin/logs') }}">📋 Logs del Sistema</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
</script>
        <script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#summary, #content',
                height: 200,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                language: 'es',
            });
</script>
        <script>
            // Forzar sincronización de TinyMCE antes de enviar el formulario
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.querySelector('form[action][method]');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        if (window.tinymce) {
                            tinymce.triggerSave();
                        }
                    });
                }
            });
        </script>
</body>
</html>
