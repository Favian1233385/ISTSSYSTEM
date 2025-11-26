<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Instituto Superior Tecnológico Sucúa - Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago">
    <title>ISTS Sucúa - Instituto Superior Tecnológico Sucúa</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/harvard-exact.css') }}">
    <style>
        .nav-menu .nav-item .nav-link {
            font-size: 1.2rem; /* Increased font size for menu items */
        }
        .nav-menu .logo-item img {
            height: 100px; /* Further increased logo size */
        }
    </style>
</head>
<body>

    <header class="header">
        <!-- Navigation -->
        <nav class="main-navigation">
            <div class="container">
                <ul class="nav-menu">
                    <li class="nav-item logo-item">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/images/logoists.png') }}" alt="Logo ISTS" style="height: 50px;">
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="/academicos" class="nav-link">Académicos</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Académicos</h3>
                                <p>El aprendizaje en ISTS puede suceder para todo tipo de estudiantes, en cualquier fase de la vida.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Programas de Grado</h4>
                                    <p>Explora todas nuestras carreras tecnológicas y programas de grado.</p>
                                    <ul>
                                        <li><a href="/academicos/desarrollo-software">Desarrollo de Software</a></li>
                                        <li><a href="/academicos/contabilidad">Contabilidad y Asesoría Tributaria</a></li>
                                        <li><a href="/academicos/agroecologia">Agroecología</a></li>
                                        <li><a href="/academicos/educacion-inicial">Educación Inicial</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-column">
                                    <h4>Educación Continua</h4>
                                    <ul>
                                        <li><a href="/academicos/presencial">Modalidad Presencial</a></li>
                                        <li><a href="/academicos/dual">Modalidad Dual</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="/campus" class="nav-link">Campus</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>El Campus del ISTS</h3>
                                <p>Obtén información sobre nuestras instalaciones, biblioteca, y oportunidades de carrera.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Biblioteca</h4>
                                    <p>Explora nuestra biblioteca</p>
                                    <ul>
                                        <li><a href="/campus/biblioteca">Biblioteca Central</a></li>
                                        <li><a href="/campus/recursos">Recursos Digitales</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-column">
                                    <h4>Instalaciones</h4>
                                    <ul>
                                        <li><a href="/campus/laboratorios">Laboratorios</a></li>
                                        <li><a href="/campus/aulas">Aulas Tecnológicas</a></li>
                                        <li><a href="/campus/eventos">Eventos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{ url('/enfoque') }}" class="nav-link">Transparencia</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Transparencia</h3>
                                <p>Explora un análisis de la investigación, trabajo académico y comunidad del ISTS.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Documentos y Reglamentos</h4>
                                    <ul>
                                        <li><a href="{{ url('/transparencia/reglamentos-internos') }}">Reglamentos Internos</a></li>
                                        <li><a href="{{ url('/transparencia/lotaip') }}">LOTAIP</a></li>
                                        <li><a href="{{ url('/transparencia/otros-documentos') }}">Otros Documentos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/visitar') }}" class="nav-link">Visitar</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{ url('/acerca') }}" class="nav-link">Acerca</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Acerca del ISTS</h3>
                                <p>Aprende cómo está estructurado el ISTS, explora nuestra historia y descubre nuestra comunidad extendida.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Historia del ISTS</h4>
                                    <ul>
                                        <li><a href="{{ url('/acerca/historia') }}">Línea de tiempo</a></li>
                                        <li><a href="{{ url('/acerca/mision-vision') }}">Misión y Visión</a></li>
                                        <li><a href="{{ url('/acerca/autoridades') }}">Autoridades</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-column">
                                    <h4>Liderazgo y Gobierno</h4>
                                    <ul>
                                        <li><a href="{{ url('/acerca/rector') }}">Rector</a></li>
                                        <li><a href="{{ url('/acerca/vicerrector') }}">Vicerrector</a></li>
                                        <li><a href="{{ url('/acerca/organigrama') }}">Organigrama</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/noticias') }}" class="nav-link">Noticias</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ url('/tramites') }}" class="nav-link">Trámites</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Trámites Disponibles</h3>
                                <p>Encuentra información y guías sobre los trámites institucionales.</p>
                            </div>
                            <div class="dropdown-grid">
                                @if (isset($tramites) && !empty($tramites))
                                    @foreach ($tramites as $tramite)
                                        <div class="dropdown-column">
                                            <h4>{{ htmlspecialchars($tramite['title']) }}</h4>
                                            <p>{{ htmlspecialchars($tramite['description']) }}</p>
                                            <a href="{{ url('/contents/' . htmlspecialchars($tramite['slug'])) }}" class="btn btn-outline">Leer más</a>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No hay trámites disponibles en este momento.</p>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-background" style="background-image: url('{{ asset('assets/images/hero.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">Instituto Superior Tecnológico Sucúa</h1>
                            <p class="hero-subtitle">Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago</p>
                            <div class="hero-actions">
                                <a href="{{ url('/academicos') }}" class="btn btn-primary">Explorar Carreras</a>
                                <a href="{{ url('/contacto') }}" class="btn btn-secondary">Solicitar Información</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- In Focus Section -->
        <section class="focus-section">
            <div class="container">
                <div class="focus-header">
                    <h2> Enfoque</h2>
                    <p>Explora la investigación, trabajo académico y comunidad del ISTS. Temas recientes incluyen:</p>
                </div>

                <div class="focus-grid">
                    <div class="focus-card">
                        <div class="focus-image">
                            <img src="{{ asset('assets/images/tecnologia.png') }}" alt="Tecnología">
                        </div>
                        <div class="focus-content">
                            <h3>Tecnología</h3>
                            <p>Dentro de cada línea de código, esperando ser decodificada, están las tecnologías que nos hacen quienes somos. Los investigadores del ISTS están trabajando para entender cómo estas pequeñas instrucciones ejercen una influencia tan grande en nuestras vidas.</p>
                            <div class="focus-actions">
                                <a href="{{ url('/enfoque/tecnologia') }}" class="btn btn-outline">Descifrar los misterios</a>
                            </div>
                        </div>
                    </div>

                    <div class="focus-card">
                        <div class="focus-image">
                            <img src="{{ asset('assets/images/tecnologia.jpg') }}" alt="Vanguardia en Desarrollo de Software">
                        </div>
                        <div class="focus-content">
                            <h3>El ISTS y la Vanguardia en Desarrollo de Software</h3>
                            <p>El ISTS forma tecnólogos de tercer nivel en Desarrollo de Software. Preparamos profesionales altamente competentes, enfocados en diseñar e implementar soluciones digitales innovadoras, desde aplicaciones web hasta sistemas empresariales. Nuestros graduados están listos para liderar la vanguardia tecnológica y cubrir las demandas prácticas de la industria.</p>
                            <div class="focus-actions">
                                <a href="{{ url('/enfoque/salud-digital') }}" class="btn btn-outline">Explora el Desarrollo de Software en el ISTS</a>
                            </div>
                        </div>
                    </div>

                    <div class="focus-card">
                        <div class="focus-image">
                            <img src="{{ asset('assets/images/bienvenida.jpg') }}" alt="Bienvenida">
                        </div>
                        <div class="focus-content">
                            <h3>Bienvenido al ISTS</h3>
                            <p>En nuestro campus, profesores de clase mundial y estudiantes talentosos se unen para crear un mundo mejor a través de investigación innovadora, innovaciones de vanguardia y trabajo académico transformador.</p>
                            <div class="focus-actions">
                                <a href="{{ url('/acerca') }}" class="btn btn-outline">Únete a nosotros</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Content Section -->
        <section class="focus-section">
            <div class="container">
                <div class="focus-header">
                    <h2>Contenido Reciente</h2>
                    <p>Explora nuestros artículos y publicaciones más recientes.</p>
                </div>

                <div class="focus-grid">
                    @if (isset($contents) && !empty($contents))
                        @foreach ($contents as $content)
                            <div class="focus-card">
                                @if (!empty($content["image_url"]))
                                    <div class="focus-image">
                                        <img src="{{ asset(htmlspecialchars($content["image_url"])) }}" alt="{{ htmlspecialchars($content["title"]) }}">
                                    </div>
                                @endif
                                <div class="focus-content">
                                    <h3>{{ htmlspecialchars($content["title"]) }}</h3>
                                    <p>{{ htmlspecialchars($content["description"]) }}</p>
                                    <div class="focus-actions">
                                        <a href="{{ url('/contenido/' . htmlspecialchars($content["slug"])) }}" class="btn btn-outline">Leer más</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No hay contenido reciente disponible.</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Academic Programs Section -->
        <section class="programs-section">
            <div class="container">
                <div class="section-header">
                    <h2>¡Tenemos una carrera para ti!</h2>
                    <p>Descubre nuestras ofertas académicas diseñadas para el futuro</p>
                </div>

                <div class="programs-grid">
                    <div class="program-card">
                        <div class="program-icon">💻</div>
                        <h3>Desarrollo de Software</h3>
                        <p>Formación en programación y desarrollo de aplicaciones modernas</p>
                        <a href="{{ url('/academicos/desarrollo-software') }}" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">📊</div>
                        <h3>Contabilidad y Asesoría Tributaria</h3>
                        <p>Especialización en contabilidad y asesoría fiscal</p>
                        <a href="{{ url('/academicos/contabilidad') }}" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">🌱</div>
                        <h3>Agroecología</h3>
                        <p>Desarrollo sostenible y agricultura ecológica</p>
                        <a href="{{ url('/academicos/agroecologia') }}" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">👶</div>
                        <h3>Educación Inicial</h3>
                        <p>Formación docente para educación inicial</p>
                        <a href="{{ url('/academicos/educacion-inicial') }}" class="btn btn-primary">Más información</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- News Section - Harvard Style -->
        <section class="news-section">
            <div class="container">
                <div class="section-header">
                    <h2>La Gaceta del ISTS</h2>
                    <p>Noticias oficiales del Instituto Superior Tecnológico Sucúa sobre ciencia, tecnología, vida del campus, temas universitarios y preocupaciones nacionales y globales más amplias.</p>
                </div>

                <div class="news-grid">
                    <div class="news-card featured">
                        <div class="news-image">
                            <img src="{{ asset('assets/images/noticia-principal.jpg') }}" alt="Noticia Principal">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Tecnología</span>
                            <h3>Nuevas Tecnologías en el ISTS</h3>
                            <p>El Instituto Superior Tecnológico Sucúa implementa nuevas tecnologías para mejorar la experiencia educativa de nuestros estudiantes.</p>
                            <a href="{{ url('/noticias/tecnologia-ists') }}" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="{{ asset('assets/images/noticia-2.jpg') }}" alt="Noticia 2">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Académico</span>
                            <h3>Nuevas Carreras Disponibles</h3>
                            <p>Conoce las nuevas carreras que el ISTS ofrece para el próximo semestre.</p>
                            <a href="{{ url('/noticias/nuevas-carreras') }}" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="{{ asset('assets/images/noticia-3.jpg') }}" alt="Noticia 3">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Campus</span>
                            <h3>Mejoras en el Campus</h3>
                            <p>El ISTS continúa mejorando sus instalaciones para brindar una mejor experiencia educativa.</p>
                            <a href="{{ url('/noticias/mejoras-campus') }}" class="read-more">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="news-actions">
                    <a href="{{ url('/noticias') }}" class="btn btn-primary">Ver todas las noticias</a>
                    <a href="{{ url('/noticias/suscribirse') }}" class="btn btn-outline">Suscribirse a la Gaceta Diaria</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section class="quick-links">
            <div class="container">
                <h2>Enlaces Rápidos de Navegación</h2>
                <div class="links-grid">
                    <a href="{{ url('/indice') }}" class="quick-link">Índice A-Z</a>
                    <a href="{{ url('/buscar-persona') }}" class="quick-link">Buscar una persona</a>
                    <a href="{{ url('/eventos') }}" class="quick-link">Eventos</a>
                    <a href="{{ url('/relaciones-publicas') }}" class="quick-link">Relaciones Públicas</a>
                    <a href="{{ url('/egresados') }}" class="quick-link">Egresados</a>
                    <a href="{{ url('/donar') }}" class="quick-link">Donar Ahora</a>
                    <a href="{{ url('/emergencia') }}" class="quick-link">Emergencia</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-widget">
        <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Abrir Chatbot">
        🤖
        </button>

        <div id="chatbot-window" class="chatbot-window" style="display: none;">
            <div class="chatbot-header">
                <h3>Asistente Virtual ISTS</h3>
                <button id="chatbot-close" aria-label="Cerrar Chatbot">✕</button>
            </div>

            <div id="chatbot-messages" class="chatbot-messages">
                <div class="bot-message">
                    <p>¡Hola! 👋 Soy el asistente virtual del ISTS. ¿En qué puedo ayudarte?</p>
                </div>
            </div>

            <form id="chatbot-form" class="chatbot-form">
                <input type="hidden" id="chat-session-id" value="">
                @csrf
                <input type="text"
                       id="chatbot-input"
                       name="message"
                       placeholder="Escribe tu pregunta..."
                       maxlength="500"
                       required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Seguridad y Marca</h4>
                    <ul>
                        <li><a href="{{ url('/reportar-copyright') }}">Reportar Infracción de Derechos de Autor</a></li>
                        <li><a href="{{ url('/reportar-seguridad') }}">Reportar Problema de Seguridad</a></li>
                        <li><a href="{{ url('/aviso-marca') }}">Aviso de Marca</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Sitio Web</h4>
                    <ul>
                        <li><a href="{{ url('/accesibilidad') }}">Accesibilidad</a></li>
                        <li><a href="{{ url('/accesibilidad-digital') }}">Accesibilidad Digital</a></li>
                        <li><a href="{{ url('/declaracion-privacidad') }}">Declaración de Privacidad</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Ponte en Contacto</h4>
                    <ul>
                        <li><a href="{{ url('/contacto') }}">Contactar ISTS</a></li>
                        <li><a href="{{ url('/mapas-direcciones') }}">Mapas y Direcciones</a></li>
                        <li><a href="{{ url('/trabajos') }}">Trabajos</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date("Y") }} Todos Los derechos Reservados. Autor: Cumbanama</p>
                <div class="footer-social">
                    <a href="#" aria-label="Instagram">📷</a>
                    <a href="#" aria-label="TikTok">🎵</a>
                    <a href="#" aria-label="LinkedIn">💼</a>
                    <a href="#" aria-label="Facebook">📘</a>
                    <a href="#" aria-label="YouTube">📺</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script src="{{ asset('js/harvard-interactions.js') }}"></script>
</body>
</html>
