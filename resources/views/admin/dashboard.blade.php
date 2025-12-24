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
                        <a href="{{ route('admin.profile') }}">👤 Perfil</a>
                        <a href="{{ route('password.confirm') }}">🔒 Cambiar Contraseña</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer;">🚪 Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="admin-main">
        <div class="admin-container">
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
            <div class="dashboard-header">
                <h1>📊 Panel Administrativo</h1>
                <p>Bienvenido al panel de administración del ISTS</p>
            </div>

    <!-- Estadísticas (recuperadas de la versión previa) -->
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

    <!-- Gestión de Contenido - Cajas Cuadradas -->
        <div class="quick-actions" id="gestion-contenidos">
            <h2>➕ GESTIÓN DE CONTENIDO</h2>
            <div class="actions-grid">
                <a href="{{ route('admin.contents.index') }}" class="action-card">
                    <div class="action-icon">📝</div>
                    <h3>Todos los Contenidos</h3>
                    <p>{{ $totalContents }} artículos totales</p>
                </a>

                <a href="{{ route('admin.qas.index') }}" class="action-card">
                    <div class="action-icon">💬</div>
                    <h3>Chatbot Q&A</h3>
                    <p>{{ $qasCount }} preguntas y respuestas</p>
                </a>

                <a href="{{ route('admin.chatbot.index') }}" class="action-card">
                    <div class="action-icon">🤖</div>
                    <h3>Gestión de Chatbot</h3>
                    <p>Administrar mensajes del asistente virtual</p>
                </a>

                <a href="{{ route('admin.updates.index') }}" class="action-card">
                    <div class="action-icon">📢</div>
                    <h3>Actualizaciones</h3>
                    <p>{{ $updatesActiveCount }} novedades activas</p>
                </a>

                <a href="{{ route('admin.news.index') }}" class="action-card">
                    <div class="action-icon">📰</div>
                    <h3>Noticias</h3>
                    <p>Gestionar La Gaceta del ISTS</p>
                </a>


                <a href="{{ route('admin.events.index') }}" class="action-card">
                    <div class="action-icon">📅</div>
                    <h3>Eventos</h3>
                    <p>Gestionar eventos institucionales</p>
                </a>

                <a href="{{ route('admin.academic-calendar.index') }}" class="action-card">
                    <div class="action-icon">📆</div>
                    <h3>Calendario Académico</h3>
                    <p>Gestionar fechas y periodos académicos</p>
                </a>

                {{-- <a href="{{ route('admin.contents.rector.index') }}" class="action-card">
                    <div class="action-icon">🧑‍🏫</div>
                    <h3>Mensaje del Rector</h3>
                    <p>Editar el mensaje que se muestra en la página principal</p>
                </a> --}}

                <a href="{{ route('admin.visit-sections.index') }}" class="action-card">
                    <div class="action-icon">🏢</div>
                    <h3>Secciones Visitar</h3>
                    <p>Gestionar áreas institucionales</p>
                </a>

                <a href="{{ route('admin.transparency.index') }}" class="action-card">
                    <div class="action-icon">📄</div>
                    <h3>Transparencia</h3>
                    <p>Gestionar documentos de transparencia institucional</p>
                </a>

                <a href="{{ route('admin.tramites.index') }}" class="action-card">
                    <div class="action-icon">📂</div>
                    <h3>Documentos</h3>
                    <p>{{ $tramitesCount ?? 0 }} documentos</p>
                </a>

                {{-- <a href="{{ route('admin.menu-items.index') }}" class="action-card">
                    <div class="action-icon">🧭</div>
                    <h3>Menú de Navegación</h3>
                    <p>Gestionar elementos del menú público</p>
                </a> --}}


                <a href="{{ route('admin.social_links.index') }}" class="action-card" style="background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%); border: 2px solid #00bcd4;">
                    <div class="action-icon">🔗</div>
                    <h3>Redes Sociales</h3>
                    <p>Gestionar enlaces y WhatsApp flotante</p>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="action-card" style="background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); border: 2px solid #ff9800;">
                    <div class="action-icon">⚙️</div>
                    <h3>Configuración General</h3>
                    <p>WhatsApp, email, redes sociales</p>
                </a>

                <a href="{{ route('about.index') }}" class="action-card">
                    <div class="action-icon">ℹ️</div>
                    <h3>Acerca</h3>
                    <p>Gestionar secciones de Acerca, autoridades, rector, etc.</p>
                </a>

                <a href="{{ route('admin.hero-slides.index') }}" class="action-card" style="background: linear-gradient(135deg, #e0f7fa 0%, #80deea 100%); border: 2px solid #00bcd4;">
                    <div class="action-icon">🖼️</div>
                    <h3>Gestionar Carrusel</h3>
                    <p>Administra las imágenes del carrusel principal</p>
                </a>

                <a href="{{ route('admin.popups.index') }}" class="action-card">
                    <div class="action-icon">🎯</div>
                    <h3>PopUp</h3>
                    <p>Gestionar banner destacado del sitio</p>
                </a>
            </div>
        </div>

    <!-- Sección Académicos -->
    <div class="quick-actions" id="seccion-academicos">
        <h2>🎓 SECCIÓN ACADÉMICOS</h2>
        <div class="actions-grid">

            <a href="{{ route('admin.careers.index') }}" class="action-card">
                <div class="action-icon">🎓</div>
                <h3>Programas de Grado</h3>
                <p>{{ $careers->count() }} carreras tecnológicas</p>
                <a href="{{ route('admin.careers.create') }}" class="btn btn-sm btn-outline-primary mt-2">Crear Nueva Carrera</a>
            </a>

            <a href="{{ route('admin.academic_modalities.index') }}" class="action-card">
                <div class="action-icon">📚</div>
                <h3>Educación Continua</h3>
                <p>Gestionar modalidades y programas</p>
            </a>

            <a href="{{ route('admin.teachers.index') }}" class="action-card">
                <div class="action-icon">👨‍🏫</div>
                <h3>Docentes</h3>
                <p>{{ $teachersCount ?? 0 }} profesores registrados</p>
            </a>

            <a href="{{ route('admin.careers.create') }}" class="action-card" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                <div class="action-icon">➕</div>
                <h3>Nueva Carrera</h3>
                <p>Agregar programa de grado</p>
            </a>

            <a href="{{ route('admin.academic-sections.create') }}" class="action-card" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                <div class="action-icon">➕</div>
                <h3>Nuevo Curso</h3>
                <p>Agregar educación continua</p>
            </a>
        </div>
    </div>

    <!-- Sección Servicios -->
    <div class="quick-actions" id="seccion-campus">
        <h2>🏛️ SECCIÓN SERVICIOS</h2>
        <div class="actions-grid">
            <a href="{{ route('admin.campus-items.index') }}" class="action-card">
                <div class="action-icon">🏛️</div>
                <h3>Servicios</h3>
                <p>{{ $campusItems->count() }} servicios disponibles</p>
            </a>

            <a href="{{ route('admin.campus-items.create') }}" class="action-card" style="background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);">
                <div class="action-icon">➕</div>
                <h3>Nuevo Servicio</h3>
                <p>Agregar servicio del campus</p>
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

