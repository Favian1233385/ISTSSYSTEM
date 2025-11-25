<!DOCTYPE html>
<html lang="es" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gestión de Noticias - ISTS Admin' }}</title>
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
                    <h1>📰 Gestión de Noticias</h1>
                    <p>Administra las noticias del sitio.</p>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Crear Noticia</a>
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

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Estado</th>
                                <th>Vistas</th>
                                <th>Publicado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item["id"] }}</td>
                                    <td>{{ $item["title"] }}</td>
                                    <td>{{ $item["author"] ?? 'N/A' }}</td>
                                    <td><span class="badge status-{{ $item["status"] }}">{{ $item["status"] }}</span></td>
                                    <td>{{ $item["views"] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item["published_at"])->format('d/m/Y') }}</td>
                                    <td class="actions">
                                        <a href="{{ route('admin.news.edit', $item['id']) }}" class="btn btn-sm btn-secondary">Editar</a>
                                        <form action="{{ route('admin.news.destroy', $item['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta noticia?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                {{ $items->links() }}
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
