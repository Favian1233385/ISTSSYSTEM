@extends('admin.layout')

@section('content')
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
                <h3>{{ $totalContents ?? 0 }}</h3>
                <p>Contenidos Totales</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📰</div>
            <div class="stat-content">
                <h3>{{ $totalNews ?? 0 }}</h3>
                <p>Noticias Totales</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                    <h3>{{ $totalUsers ?? 0 }}</h3>
                <p>Usuarios Registrados</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👁️</div>
            <div class="stat-content">
                <h3>{{ $totalViews ?? 0 }}</h3>
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

@endsection

