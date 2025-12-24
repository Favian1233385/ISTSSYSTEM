<!DOCTYPE html>
<html lang="es" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Crear Noticia - ISTS Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @if(app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('css/app-rtl.css') }}">
    @endif
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoists.png') }}" sizes="32x32">
</head>
<body class="admin-body">
    <!-- Header Administrativo -->
    <header class="admin-header">
        <div class="admin-header-content">
                <div class="admin-logo">
                <img src="{{ asset('assets/images/logoists.png') }}" alt="ISTS Logo" class="admin-logo-img">
                <h1>ISTS Admin</h1>
            </div>

            <nav class="admin-nav">
                <ul class="admin-nav-menu">
                    <li><a href="{{ url('/admin/dashboard') }}">📊 Dashboard</a></li>
                    <li><a href="{{ url('/admin/contents') }}">📝 Contenidos</a></li>
                    <li><a href="{{ url('/admin/news') }}" class="active">📰 Noticias</a></li>
                    <li><a href="{{ url('/admin/users') }}">👥 Usuarios</a></li>
                    <li><a href="{{ url('/admin/settings') }}">⚙️ Configuración</a></li>
                </ul>
            </nav>

            <div class="admin-user-menu">
                <div class="user-info">
                    <span class="user-name">{{ optional(Auth::user())->email ?? 'Usuario' }}</span>
                    <div class="user-dropdown">
                        <a href="{{ url('/admin/profile') }}">👤 Perfil</a>
                        <a href="{{ url('/auth/change-password') }}">🔒 Cambiar Contraseña</a>
                        <a href="{{ url('/auth/logout') }}">🚪 Cerrar Sesión</a>
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
                    <h1>📰 Crear Noticia</h1>
                    <p>Rellena el formulario para crear una nueva noticia.</p>
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

                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="summary">Resumen</label>
                        <textarea name="summary" id="summary" class="form-control" rows="3">{{ old('summary') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <textarea name="content" id="content" class="form-control" rows="10">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="images">Imágenes</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                        <small>Puedes seleccionar varias imágenes. La primera será la principal.</small>
                    </div>
                                        <div class="form-group">
                                            <label for="order">Orden/Prioridad</label>
                                            <input type="number" name="order" id="order" class="form-control" min="1" value="{{ old('order') }}">
                                            <small>1 = más importante. Si se deja vacío, se ordena por fecha.</small>
                                        </div>
                    <div class="form-group">
                        <label for="category">Categoría</label>
                        <select name="category" id="category" class="form-control">
                            <option value="noticias" @if(old('category') == 'noticias') selected @endif>Noticias</option>
                            <option value="institucional" @if(old('category') == 'institucional') selected @endif>Institucional</option>
                            <option value="eventos" @if(old('category') == 'eventos') selected @endif>Eventos</option>
                            <option value="comunicados" @if(old('category') == 'comunicados') selected @endif>Comunicados</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select name="status" id="status" class="form-control">
                            <option value="draft" @if(old('status') == 'draft') selected @endif>Borrador</option>
                            <option value="published" @if(old('status') == 'published') selected @endif>Publicado</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Noticia</button>
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
                var form = document.querySelector('form[action][method="POST"]');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        if (window.tinymce) {
                            tinymce.triggerSave(); // Actualiza los textareas con el contenido de TinyMCE
                        }
                    });
                }
            });
        </script>
</body>
</html>
