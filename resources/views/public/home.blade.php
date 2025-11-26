@extends('layouts.public')

@section('title', 'ISTS Sucúa - Instituto Superior Tecnológico Sucúa')

@section('content')
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
        @include('public.partials.quick_links')
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
@endsection

@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script src="{{ asset('js/harvard-interactions.js') }}"></script>
@endpush
