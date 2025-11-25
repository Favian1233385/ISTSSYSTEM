<!DOCTYPE html>
<html lang="es" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - ISTS Admin' }}</title>
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
                    <li><a href="{{ url('/admin/dashboard') }}" class="active">📊 Dashboard</a></li>
                    <li><a href="{{ url('/admin/contents') }}">📝 Contenidos</a></li>
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
            <!-- Mensajes de éxito/error -->
            @if(request()->query('success'))
                <div class="alert alert-success">
                    <span>✅</span>
                    {{ request()->query('success') }}
                </div>
            @endif

            @if(request()->query('error'))
                <div class="alert alert-error">
                    <span>❌</span>
                    {{ request()->query('error') }}
                </div>
            @endif

            <!-- Dashboard Content -->
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>📊 Dashboard Administrativo</h1>
                    <p>Bienvenido al panel de administración del ISTS</p>
                </div>

                <!-- Estadísticas -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📝</div>
                        <div class="stat-content">
                            <h3>{{ $stats['total_contents'] ?? 0 }}</h3>
                            <p>Contenidos Totales</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">📰</div>
                        <div class="stat-content">
                            <h3>{{ $stats['total_news'] ?? 0 }}</h3>
                            <p>Noticias Totales</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-content">
                            <h3>{{ $stats['total_users'] ?? 0 }}</h3>
                            <p>Usuarios Registrados</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">👁️</div>
                        <div class="stat-content">
                            <h3>{{ $stats['total_views'] ?? 0 }}</h3>
                            <p>Vistas Totales</p>
                        </div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="quick-actions">
                    <h2>🚀 Acciones Rápidas</h2>
                    <div class="actions-grid">
                        <a href="{{ url('/admin/createContent') }}" class="action-card">
                            <div class="action-icon">📝</div>
                            <h3>Crear Contenido</h3>
                            <p>Agregar nuevo contenido al sitio</p>
                        </a>

                        <a href="{{ url('/admin/createNews') }}" class="action-card">
                            <div class="action-icon">📰</div>
                            <h3>Crear Noticia</h3>
                            <p>Publicar nueva noticia</p>
                        </a>

                        <a href="{{ url('/admin/leadership') }}" class="action-card">
                            <div class="action-icon">👨‍🏫</div>
                            <h3>Gestionar Equipo</h3>
                            <p>Administrar el equipo directivo</p>
                        </a>

                        <a href="{{ url('/admin/users') }}" class="action-card">
                            <div class="action-icon">👥</div>
                            <h3>Gestionar Usuarios</h3>
                            <p>Administrar usuarios del sistema</p>
                        </a>

                        <a href="{{ url('/admin/settings') }}" class="action-card">
                            <div class="action-icon">⚙️</div>
                            <h3>Configuración</h3>
                            <p>Ajustar configuración del sistema</p>
                        </a>
                    </div>
                </div>

                <!-- Contenido Reciente -->
                <div class="recent-content">
                    <div class="recent-section">
                        <h2>📝 Contenidos Recientes</h2>
                        <div class="content-list">
                            @if(!empty($stats['recent_contents']))
                                @foreach($stats['recent_contents'] as $content)
                                    <div class="content-item">
                                        <div class="content-info">
                                            <h4>{{ $content['title'] }}</h4>
                                            <p>{{
                                                Illuminate\Support\Str::limit($content['description'] ?? '', 100)
                                            }}...</p>
                                            <span class="content-meta">
                                                {{ optional(\Carbon\Carbon::parse($content['created_at'] ?? null))->format('d/m/Y') }} • {{ ucfirst($content['status'] ?? '') }}
                                            </span>
                                        </div>
                                        <div class="content-actions">
                                            <a href="{{ route('admin.contents.edit', $content['id']) }}" class="btn btn-sm">✏️ Editar</a>
                                            <form action="{{ route('admin.contents.destroy', $content['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este contenido?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="no-content">No hay contenidos recientes</p>
                            @endif
                        </div>
                    </div>

                    <div class="recent-section">
                        <h2>📰 Noticias Recientes</h2>
                        <div class="content-list">
                            @if(!empty($stats['recent_news']))
                                @foreach($stats['recent_news'] as $news)
                                    <div class="content-item">
                                        <div class="content-info">
                                            <h4>{{ $news['title'] }}</h4>
                                            <p>{{ Illuminate\Support\Str::limit($news['summary'] ?? '', 100) }}...</p>
                                            <span class="content-meta">
                                                {{ optional(\Carbon\Carbon::parse($news['published_at'] ?? null))->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <div class="content-actions">
                                            <a href="{{ route('admin.news.edit', $news['id']) }}" class="btn btn-sm">✏️ Editar</a>
                                            <form action="{{ route('admin.news.destroy', $news['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar esta noticia?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="no-content">No hay noticias recientes</p>
                            @endif
                        </div>
                    </div>
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
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>
