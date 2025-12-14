@extends('layouts.public')

@section('title', 'ISTS Sucúa - Instituto Superior Tecnológico Sucúa')

@section('content')
    <!-- Main Content -->
    <main id="main-content" class="main-content p-0 m-0">
        <!-- Hero Section -->
        <section class="hero-section p-0 m-0" style="height:100vh; min-height:100vh; overflow:hidden;">
            @if (isset($heroSlides) && $heroSlides->count() > 0)
                <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="5000">
                    <!-- Indicadores -->
                    <div class="carousel-indicators">
                        @foreach ($heroSlides->where('is_active', true)->values() as $index => $slide)
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner h-100">
                        @foreach ($heroSlides as $index => $slide)
                            @if($slide->image_path)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                                <img src="{{ asset('uploads/images/' . $slide->image_path) }}"
                                    class="d-block w-100 h-100 object-fit-cover" alt="{{ $slide->title }}"
                                    style="object-fit:cover;"
                                    onerror="this.src='{{ asset('uploads/images/placeholder.jpg') }}'">

                                <div
                                    class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                                    <div class="p-4 rounded-4"
                                        style="background:rgba(30,30,30,0.03); backdrop-filter:blur(4px); box-shadow:0 2px 8px rgba(0,0,0,0.03); max-width:700px; width:100%;">
                                        <h1 class="fw-bold text-white"
                                            style="font-size:4.2rem; text-shadow:0 2px 12px rgba(0,0,0,0.5); line-height:1.1;">
                                            {{ $slide->title }}
                                        </h1>
                                        <p class="lead text-white mb-4"
                                            style="font-size:2rem; text-shadow:0 1px 8px rgba(0,0,0,0.35); line-height:1.2;">
                                            {{ $slide->subtitle }}
                                        </p>
                                        <div class="d-flex justify-content-center gap-3">
                                            @if ($slide->link)
                                                <a href="{{ $slide->link }}" class="btn btn-warning btn-lg fw-bold"
                                                    style="box-shadow:0 2px 8px rgba(0,0,0,0.2);">
                                                    EXPLORAR CARRERAS
                                                </a>
                                            @endif
                                            <a href="#" class="btn btn-outline-light btn-lg fw-bold"
                                                style="box-shadow:0 2px 8px rgba(0,0,0,0.2);">
                                                SOLICITAR INFORMACIÓN
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Controles -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            @else
                <!-- Fallback si no hay slides -->
                <div class="d-flex justify-content-center align-items-center h-100 bg-dark text-white">
                    <div class="text-center">
                        <h1>Bienvenido al ISTS Sucúa</h1>
                        <p class="lead">No hay slides disponibles en este momento</p>
                    </div>
                </div>
            @endif
        </section>

        <!-- Script adicional para asegurar funcionamiento -->
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const carousel = document.querySelector('#heroCarousel');
                    if (carousel) {
                        // Inicializar el carrusel manualmente
                        const bsCarousel = new bootstrap.Carousel(carousel, {
                            interval: 5000,
                            wrap: true,
                            keyboard: true,
                            pause: 'hover'
                        });

                        console.log('Carrusel inicializado correctamente');
                    }
                });
            </script>
        @endpush




        <!-- Misión y Visión Section (reemplaza Enfoque) -->
        @include('public.partials.home_mision_vision', ['content' => $misionVision ?? null])

        <!-- Últimas actualizaciones multimedia -->
        @include('public.partials.updates', ['updates' => $updates ?? []])

        <!-- Academic Programs Section - Profesional e Institucional -->
        <section class="careers-section"
            style="padding: 3.5rem 0; background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
            <div class="container">
                <div class="programs-header">
                    <h2 style="
                        font-size:2.3rem;
                        font-weight:800;
                        color:#00796b;
                        margin-bottom:0.7rem;
                        letter-spacing:-1px;
                        text-align:center;
                        position:relative;">
                        ¡Tenemos una carrera para ti!
                        <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
                    </h2>
                    <p style="font-size:1.18rem; color:#1976d2; text-align:center; max-width:700px; margin:0 auto 1.7rem auto; font-weight:500;">
                        Descubre nuestras ofertas académicas diseñadas para el futuro, con carreras tecnológicas de alto impacto y formación docente de excelencia.
                    </p>
                </div>
                <div class="careers-grid">
                    @foreach($careers as $career)
                        <div class="career-card has-image">
                            <div class="career-banner-thumb" style="width:100%;height:140px;overflow:hidden;position:relative;background:#e8f5f1;">
                                @if($career->image_path)
                                    <img src="{{ asset('storage/' . $career->image_path) }}" alt="{{ $career->name }}" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                @elseif($career->image_path_2)
                                    <img src="{{ asset('storage/' . $career->image_path_2) }}" alt="{{ $career->name }}" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                @else
                                    <img src="{{ asset('uploads/images/placeholder.jpg') }}" alt="{{ $career->name }}" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                @endif
                            </div>
                            <div class="career-info">
                                <h3 style="text-align: center; color: var(--color-primary);">
                                    <a href="{{ route('career.show', $career->slug) }}">{{ $career->name }}</a>
                                </h3>
                                @if($career->description)
                                    <p>{{ Str::limit($career->description, 100) }}</p>
                                @endif
                                <a href="{{ route('career.show', $career->slug) }}" class="btn btn-primary">Más información</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Botón 'Ver todas las carreras' eliminado por solicitud -->
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
                                @if (!empty($content['image_url']))
                                    <div class="focus-image">
                                        <img src="{{ asset(htmlspecialchars($content['image_url'])) }}"
                                            alt="{{ htmlspecialchars($content['title']) }}">
                                    </div>
                                @endif
                                <div class="focus-content">
                                    <h3>{{ htmlspecialchars($content['title']) }}</h3>
                                    <p>{{ htmlspecialchars($content['description']) }}</p>
                                    <div class="focus-actions">
                                        <a href="{{ url('/contenido/' . htmlspecialchars($content['slug'])) }}"
                                            class="btn btn-outline">Leer más</a>
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
                <div class="section-header" style="text-align:center;">
                    <h2 style="
                        font-size:2.3rem;
                        font-weight:800;
                        color:#00796b;
                        margin-bottom:0.7rem;
                        letter-spacing:-1px;
                        display:inline-block;
                        position:relative;">
                        La Gaceta del ISTS
                        <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
                    </h2>
                    <p style="font-size:1.18rem; color:#1976d2; text-align:center; max-width:700px; margin:0 auto 1.7rem auto; font-weight:500;">
                        Noticias oficiales del Instituto Superior Tecnológico Sucúa sobre ciencia, tecnología, vida del campus, temas universitarios y preocupaciones nacionales y globales más amplias.
                    </p>
                </div>

                <div class="news-grid">
                    @php
                        $newsList = \App\Models\News::where('status', 'published')->orderBy('published_at', 'desc')->take(3)->get();
                    @endphp
                    @forelse($newsList as $n)
                        <div class="news-card @if($loop->first) featured @endif">
                            <div class="news-image">
                                @if(is_array($n->images) && count($n->images) > 0)
                                    <img src="{{ asset('storage/' . ltrim($n->images[0], '/')) }}" alt="{{ $n->title }}">
                                @else
                                    <img src="{{ asset('uploads/images/placeholder.jpg') }}" alt="{{ $n->title }}">
                                @endif
                            </div>
                            <div class="news-content">
                                <span class="news-category">{{ ucfirst($n->category ?? 'Noticias') }}</span>
                                <h3>{{ $n->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($n->summary), 120) }}</p>
                                <a href="{{ route('noticias.show', $n->slug) }}" class="read-more">Leer más →</a>
                            </div>
                        </div>
                    @empty
                        <p>No hay noticias recientes.</p>
                    @endforelse
                </div>

                <div class="news-actions">
                    <a href="{{ url('/noticias') }}" class="btn btn-primary">Ver todas las noticias</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        @include('public.partials.quick_links')
    </main>

    <!-- Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-widget">
        <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Abrir Chatbot">
            <img src="{{ asset('assets/images/chatbot-avatar.gif') }}" alt="Chatbot ISTS" class="chatbot-avatar"
                style="width: 64px; height: 64px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.12);">
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
                <input type="text" id="chatbot-input" name="message" placeholder="Escribe tu pregunta..."
                    maxlength="500" required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
   
    <script src="{{ asset('js/harvard-interactions.js') }}"></script>
@endpush

