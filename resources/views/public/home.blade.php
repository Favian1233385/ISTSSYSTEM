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


    <!-- Redes sociales flotantes lado izquierdo -->
    <div id="social-widget"
         style="position:fixed; bottom:7.5rem; left:1.5rem; z-index:2147483646; display:flex; flex-direction:column; gap:12px; align-items:center;">
        <a href="https://www.facebook.com/share/14NqPxg6y5t/" target="_blank" rel="noopener" title="Facebook" style="background:#1877f2; border-radius:50%; width:44px; height:44px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
            <svg width="22" height="22" fill="white" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/></svg>
        </a>
        
        <a href="https://instagram.com/istsucua" target="_blank" rel="noopener" title="Instagram" style="background:radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); border-radius:50%; width:44px; height:44px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
            <svg width="22" height="22" fill="white" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.974.974 1.246 2.242 1.308 3.608.058 1.266.069 1.646.069 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.974.974-2.242 1.246-3.608 1.308-1.266.058-1.646.069-4.85.069s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.974-.974-1.246-2.242-1.308-3.608C2.175 15.647 2.163 15.267 2.163 12s.012-3.584.07-4.85c.062-1.366.334-2.633 1.308-3.608.974-.974 2.242-1.246 3.608-1.308C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.013 7.052.072 5.771.131 4.659.425 3.678 1.406c-.98.98-1.274 2.092-1.333 3.373C2.013 8.332 2 8.741 2 12c0 3.259.013 3.668.072 4.948.059 1.281.353 2.393 1.333 3.373.98.98 2.092 1.274 3.373 1.333C8.332 23.987 8.741 24 12 24s3.668-.013 4.948-.072c1.281-.059 2.393-.353 3.373-1.333.98-.98 1.274-2.092 1.333-3.373.059-1.28.072-1.689.072-4.948 0-3.259-.013-3.668-.072-4.948-.059-1.281-.353-2.393-1.333-3.373-.98-.98-2.092-1.274-3.373-1.333C15.668.013 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
        </a>
        <a href="https://tiktok.com/@ist_sucua" target="_blank" rel="noopener" title="TikTok" style="background:#000; border-radius:50%; width:44px; height:44px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
            <svg width="22" height="22" fill="white" viewBox="0 0 24 24"><path d="M12.004 2.003c-5.523 0-10 4.477-10 10s4.477 10 10 10 10-4.477 10-10-4.477-10-10-10zm3.993 10.993c-.001 1.657-1.346 3.002-3.003 3.002-1.657 0-3.002-1.345-3.002-3.002 0-1.657 1.345-3.002 3.002-3.002.553 0 1.07.151 1.513.414v1.13c-.293-.14-.617-.22-.963-.22-1.104 0-2 .896-2 2 0 1.104.896 2 2 2 1.104 0 2-.896 2-2v-5.002h1.45c.001 1.657 1.346 3.002 3.003 3.002v1.45c-1.657 0-3.002-1.345-3.002-3.002z"/></svg>
        </a>
        <a href="https://wa.me/593999999999" target="_blank" rel="noopener" title="WhatsApp" style="background:#25d366; border-radius:50%; width:44px; height:44px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
            <svg width="22" height="22" fill="white" viewBox="0 0 24 24"><path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.01L0 24l6.18-1.62A11.93 11.93 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.63-.5-5.18-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.93 9.93 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.48-.84-2.03-.22-.53-.45-.46-.61-.47-.16-.01-.35-.01-.54-.01-.19 0-.5.07-.76.34-.26.27-1 1-.97 2.43.03 1.43 1.03 2.81 1.18 3 .15.19 2.03 3.1 4.93 4.23.69.3 1.23.48 1.65.61.69.22 1.32.19 1.81.12.55-.08 1.65-.67 1.89-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"/></svg>
        </a>
    </div>

    <!-- Widget flotante de eventos, circular, animado y llamativo -->
        <div id="event-widget"
             style="position:fixed; bottom:1.5rem; left:1.5rem; z-index:2147483647; min-width:0; min-height:0;"
             class="flex flex-col items-center">
            <div onclick="window.location.href='{{ route('public.events.index') }}'"
                 style="background: linear-gradient(135deg, #2563eb 0%, #22d3ee 100%); box-shadow: 0 8px 24px 2px rgba(0,0,0,0.25); border: 3px solid #fff; border-radius: 9999px; min-width: 120px; height: 56px; display: flex; align-items: center; justify-content: center; cursor: pointer; animation: bounce 1.2s infinite alternate; position: relative; padding: 0 18px; gap: 10px;"
                 title="Ver eventos">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="white">
                    <rect x="3" y="5" width="18" height="16" rx="3" fill="#fff" fill-opacity=".15" stroke="white" stroke-width="1.5"/>
                    <path d="M8 3v2m8-2v2M3 9h18" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <span style="color:#fff; font-size:1.1rem; font-weight:600; letter-spacing:1px;">Eventos</span>
            </div>
        </div>

        <style>
        @keyframes bounce {
          0% { transform: translateY(0); }
          100% { transform: translateY(-12px); }
        }
        </style>

@endsection

@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
   
    <script src="{{ asset('js/harvard-interactions.js') }}"></script>
@endpush

