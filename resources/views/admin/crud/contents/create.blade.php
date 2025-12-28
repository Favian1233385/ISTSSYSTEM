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
                    <h1>📝 Crear Nueva Sección de Transparencia</h1>
                    <p>Completa el formulario para agregar una nueva sección a la tarjeta de Transparencia.</p>
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
                                        <option value="tramites">Trámites</option>
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

                            <div class="form-group" id="description-group" style="display: none;">
                                <label for="description">Descripción (opcional)</label>
                                <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group" id="content-group" style="display: none;">
                                <label for="content">Contenido (opcional)</label>
                                <textarea id="content" name="content" class="form-control" rows="10">{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group" id="image-group" style="display: none;">
                                <label for="image_url">Imagen (opcional)</label>
                                <input type="file" id="image_url" name="image_url" class="form-control">
                            </div>
    <script>
        // Mostrar/ocultar campos según la categoría seleccionada
        document.addEventListener('DOMContentLoaded', function() {
            function toggleFields() {
                var cat = document.getElementById('category').value;
                document.getElementById('description-group').style.display = (cat !== 'tramites') ? '' : 'none';
                document.getElementById('content-group').style.display = (cat !== 'tramites') ? '' : 'none';
                document.getElementById('image-group').style.display = (cat !== 'tramites') ? '' : 'none';
            }
            var catSelect = document.getElementById('category');
            if (catSelect) {
                catSelect.addEventListener('change', toggleFields);
                toggleFields();
            }
        });
    </script>

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

                        <div class="admin-action-buttons" style="display:flex !important; flex-direction:row !important; justify-content:flex-end !important; align-items:center !important; gap:1.2rem !important; width:100%; margin-top:1.5rem; margin-bottom:0;">
                            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center">
                                <i class="bi bi-x-circle me-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center">
                                <i class="bi bi-save me-2"></i> Crear Sección
                            </button>
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
