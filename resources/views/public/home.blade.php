@extends('layouts.public')

@section('title', 'ISTS Sucúa - Instituto Superior Tecnológico Sucúa')

@section('content')
    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($heroSlides ?? [] as $index => $slide)
                        @if($slide->is_active)
                        <div class="carousel-item @if($index === 0) active @endif">
                            <div class="hero-background" style="background-image: url('{{ asset('uploads/images/' . $slide->image_path) }}'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 400px;">
                                <div class="hero-overlay">
                                    <div class="container">
                                        <div class="hero-content">
                                            <h1 class="hero-title">{{ $slide->title }}</h1>
                                            <p class="hero-subtitle">{{ $slide->subtitle }}</p>
                                            <div class="hero-actions">
                                                <a href="{{ url('/academicos') }}" class="btn btn-primary">Explorar Carreras</a>
                                                <a href="{{ url('/contacto') }}" class="btn btn-secondary">Solicitar Información</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </section>




        <!-- Misión y Visión Section (reemplaza Enfoque) -->
        @include('public.partials.home_mision_vision', ['content' => $misionVision ?? null])

        <!-- Últimas actualizaciones multimedia -->
        @include('public.partials.updates', ['updates' => $updates ?? []])

        <!-- Academic Programs Section - Profesional e Institucional -->
        <section class="careers-section" style="padding: 3.5rem 0; background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
            <div class="container">
                <div class="programs-header">
                    <h2>¡Tenemos una carrera para ti!</h2>
                    <p>Descubre nuestras ofertas académicas diseñadas para el futuro, con carreras tecnológicas de alto impacto y formación docente de excelencia.</p>
                </div>
                <div class="careers-grid">
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="{{ asset('uploads/images/69389bfbe28ab-software.jpeg') }}" alt="Desarrollo de Software">
                        </div>
                        <div class="career-content">
                            <h3>Desarrollo de Software</h3>
                            <p>Formación en programación, ingeniería de software y desarrollo de aplicaciones modernas para la industria 4.0.</p>
                            <a href="{{ url('/academicos/desarrollo-software') }}" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="{{ asset('uploads/images/690b6155ab769-conta.jpg') }}" alt="Contabilidad y Asesoría Tributaria">
                        </div>
                        <div class="career-content">
                            <h3>Contabilidad y Asesoría Tributaria</h3>
                            <p>Especialización en contabilidad, asesoría fiscal y gestión financiera para empresas y emprendimientos.</p>
                            <a href="{{ url('/academicos/contabilidad') }}" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="{{ asset('uploads/images/690b625993c58-agro.jpeg') }}" alt="Agroecología">
                        </div>
                        <div class="career-content">
                            <h3>Agroecología</h3>
                            <p>Desarrollo sostenible, agricultura ecológica y gestión ambiental para el futuro del planeta.</p>
                            <a href="{{ url('/academicos/agroecologia') }}" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="{{ asset('uploads/images/690b6389a6930-educacion.jpg') }}" alt="Educación Inicial">
                        </div>
                        <div class="career-content">
                            <h3>Educación Inicial</h3>
                            <p>Formación docente de excelencia para la educación inicial y el desarrollo integral de la niñez.</p>
                            <a href="{{ url('/academicos/educacion-inicial') }}" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="programs-cta">
                    <a href="{{ url('/academicos') }}" class="btn-primary-large">Ver todas las carreras</a>
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

        <!-- Mensaje del Rector -->
        @include('public.partials.rector', ['rector' => $rector ?? null])

        <!-- Sección duplicada de carreras eliminada: ya existe una versión profesional más arriba -->

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
                            <img src="{{ asset('uploads/images/69388a0728100-RENDICION DE CUENTAS 20242.jpg') }}" alt="Noticia Principal">
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
                            <img src="{{ asset('uploads/images/69388a38bb063-foto.jpeg') }}" alt="Noticia 2">
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
                            <img src="{{ asset('uploads/images/69388a533e4a0-luis.jpg') }}" alt="Noticia 3">
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
            <img src="{{ asset('assets/images/chatbot-avatar.gif') }}" alt="Chatbot ISTS" class="chatbot-avatar" style="width: 64px; height: 64px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.12);">
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
    <script src="{{ asset('ISTSSYSTEM/js/chatbot.js') }}"></script>
    <script src="{{ asset('js/harvard-interactions.js') }}"></script>
@endpush
