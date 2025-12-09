<!DOCTYPE html>
<html lang="es" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Crear Contenido - ISTS Admin' }}</title>
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
                    <h1>📝 Crear Nuevo Contenido</h1>
                    <p>Completa el formulario para agregar nuevo contenido al sitio.</p>
                </div>

                <div class="form-container">
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

                    <form method="POST" action="{{ route('admin.contents.store') }}" enctype="multipart/form-data" id="content-form" class="styled-form">
                        @csrf
                        @if(request('parent_id'))
                            <input type="hidden" name="category" value="transparency">
                            <input type="hidden" name="parent_id" value="{{ request('parent_id') }}">
                        @endif

                        <div class="form-card">
                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" id="title" name="title" class="form-control" required value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="category">Categoría</label>
                                @if(request('parent_id'))
                                    <input type="text" class="form-control" value="Transparencia" disabled readonly>
                                @else
                                    <select id="category" name="category" class="form-control" required>
                                        <option value="">Selecciona una categoría</option>
                                        <option value="transparency">Transparencia</option>
                                        <option value="carreras">Carreras</option>
                                        <option value="course">Cursos</option>
                                        <option value="noticias">Noticias</option>
                                        <option value="sobre-nosotros">Sobre Nosotros</option>
                                        <option value="investigacion">Investigación</option>
                                        <option value="eventos">Eventos</option>
                                        <option value="servicios">Servicios</option>
                                    </select>
                                @endif
                            </div>

                            @if(request('category') !== 'tramites' && old('category') !== 'tramites')
                                <div class="form-group">
                                    <label for="description">Descripcin</label>
                                    <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Contenido</label>
                                    <textarea id="content" name="content" class="form-control" rows="10" @if(request('parent_id')) style="display:none;" @endif>{{ old('content') }}</textarea>
                                </div>
                            @endif
                            @if(request('category') === 'tramites' || old('category') === 'tramites')
                                <!-- Solo mostrar título, archivo PDF, enlace externo y estado -->
                                <!-- Los campos de descripción, contenido e imagen quedan ocultos -->
                            @endif


                            @if(request('category') !== 'tramites' && old('category') !== 'tramites')
                                <div class="form-group">
                                    <label for="image_url">Imagen</label>
                                    <input type="file" id="image_url" name="image_url" class="form-control">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="file_url">Archivo PDF o Enlace externo</label>
                                <input type="file" name="file_url" id="file_url" class="form-control" accept="application/pdf">
                                <input type="url" name="url" id="url" class="form-control" value="{{ old('url') }}" placeholder="https://example.com (opcional)">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="draft">Borrador</option>
                                        <option value="published">Publicado</option>
                                        <option value="archived">Archivado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="featured">Destacado</label>
                                    <input type="checkbox" id="featured" name="featured" value="1">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Crear Contenido</button>
                            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
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
    <script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description, #content',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
            toolbar: 'undo redo | blocks | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
            menubar: false,
            language: 'es',
            branding: false,
            height: 300,
            content_style: 'body { font-family:Inter,sans-serif; font-size:16px; text-align:justify; }',
            forced_root_block: 'p',
            toolbar_mode: 'sliding',
            entity_encoding: 'raw',
        });
    </script>
</body>
</html>
