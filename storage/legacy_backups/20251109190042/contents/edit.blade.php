<!DOCTYPE html>
<html lang="es" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Editar Contenido - ISTS Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @if(app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('css/app-rtl.css') }}">
    @endif
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
                    <li><a href="{{ url('/admin/contents') }}" class="active">📝 Contenidos</a></li>
                    <li><a href="{{ url('/admin/news') }}">📰 Noticias</a></li>
                    <li><a href="{{ url('/admin/leadership') }}">👨‍🏫 Equipo</a></li>
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
                    <h1>📝 Editar Contenido</h1>
                    <p>Modifica el formulario para editar el contenido.</p>
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

                <form action="{{ route('admin.contents.update', $item['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item['title']) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $item['description']) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <textarea name="content" id="content" class="form-control" rows="10" required>{{ old('content', $item['content']) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_file">Imagen</label>
                        <input type="file" name="image_file" id="image_file" class="form-control">
                        @if($item['image_url'])
                            <img src="{{ asset($item['image_url']) }}" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select name="status" id="status" class="form-control">
                            <option value="draft" @if(old('status', $item['status']) == 'draft') selected @endif>Borrador</option>
                            <option value="published" @if(old('status', $item['status']) == 'published') selected @endif>Publicado</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Contenido</button>
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
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
