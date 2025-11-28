<header class="header-public">
    {{-- Menu dinámico implementado --}}
    @php
        // Cargar datos para los menús
        $allCareers = \App\Models\Career::where('is_active', true)->orderBy('name')->get();
        $tramites = \Illuminate\Support\Facades\DB::table('contents')->where('category', 'tramites')->where('status', 'published')->orderBy('title')->get();
        $menuItems = \App\Models\MenuItem::whereNull('parent_id')->where('is_active', true)->with('children')->orderBy('order')->get();

        // Cargar los contenidos de la categoría 'about' (Historia, Misión, etc.) para el menú dinámico
        $contentModel = new \App\Models\Content();
        $aboutContents = $contentModel->getByCategory('about');

        // Encontrar el ítem de menú "ACERCA" para buscar sus hijos configurados en el admin
        $acercaMenuItem = $menuItems->firstWhere('title', 'ACERCA');
    @endphp

    {{-- Header limpio y profesional --}}
    <nav class="header-navbar">
        <ul class="header-menu">
            <li>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logoists.png') }}" alt="Logo ISTS" style="height: 50px; vertical-align: middle;">
                </a>
            </li>

            {{-- Dropdown de Acerca dinámico (CORREGIDO) --}}
            <li class="dropdown">
                <a href="#" class="header-link">ACERCA</a>
                <div class="dropdown-content academic-dropdown">
                    <div class="academic-dropdown-header">
                        <h3>Acerca</h3>
                        <p>Aprende cómo está estructurado el ISTS, explora nuestra historia y descubre nuestra comunidad extendida.</p>
                    </div>
                    <div class="academic-dropdown-columns">
                        <div class="academic-column">
                            <div class="academic-title">Secciones</div>
                            <div class="academic-underline"></div>
                            <ul>
                                {{-- 1. Mostrar las páginas de contenido de la categoría "about" --}}
                                @foreach($aboutContents as $section)
                                    <li>
                                        @if(Str::lower($section['title']) === 'autoridades')
                                            <a href="{{ url('/autoridades') }}">{{ $section['title'] }}</a>
                                        @else
                                            <a href="{{ url('/contenido/'.$section['slug']) }}">{{ $section['title'] }}</a>
                                        @endif
                                    </li>
                                @endforeach

                                {{-- 2. Mostrar los sub-items configurados en "Gestión de Menús" (como "Autoridades") --}}
                                @if($acercaMenuItem && count($acercaMenuItem->children) > 0)
                                    @foreach($acercaMenuItem->children as $child)
                                        <li>
                                            <a href="{{ url($child->url) }}">{{ $child->title }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </li>

            {{-- Iterar sobre el resto de los elementos del menú --}}
            @foreach($menuItems as $item)
                @php $title = strtoupper($item->title); @endphp
                @if($title == 'ACERCA')
                    @continue {{-- Ya se renderizó arriba --}}
                @elseif($title == 'ACADÉMICOS')
                    <li class="dropdown">
                        <a href="{{ route('academicos') }}" class="header-link{{ request()->is('academicos') ? ' active' : '' }}">ACADÉMICOS</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Académicos</h3>
                                <p>El aprendizaje en ISTS puede suceder para todo tipo de estudiantes, en cualquier fase de la vida.</p>
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Programas de Grado</div>
                                    <div class="academic-underline"></div>
                                    <div class="academic-desc">Explora todas nuestras carreras tecnológicas y programas de grado.</div>
                                    <ul>
                                        @foreach($allCareers as $career)
                                            <li><a href="{{ route('career.show', $career->slug) }}">{{ $career->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Educación Continua</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <li>Modalidad Presencial</li>
                                        <li>Modalidad Dual</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($title == 'CAMPUS')
                    @continue {{-- Se omite para usar el hardcodeado de abajo --}}
                @elseif($title == 'VISITAR')
                    <li class="dropdown">
                        <a href="#" class="header-link">VISITAR</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Visitar</h3>
                                <p>Conoce las unidades, servicios y áreas que puedes visitar en el ISTS.</p>
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Historia y Presentación</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <li><a href="/visitar/historia">Historia de Visitar</a></li>
                                        <li><a href="/visitar/presentacion">Presentación</a></li>
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Unidades y Servicios</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <li><a href="/visitar/talento-humano">Talento Humano</a></li>
                                        <li><a href="/visitar/unidad-administrativa">Unidad Administrativa</a></li>
                                        <li><a href="/visitar/unidad-comunicacion">Unidad de Comunicación</a></li>
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Áreas y Recursos</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <li><a href="/visitar/tecnologias-informacion">Tecnologías de la Información</a></li>
                                        <li><a href="/visitar/biblioteca">Biblioteca</a></li>
                                        <li><a href="/visitar/laboratorios">Laboratorios</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                {{-- CORRECCIÓN: Usar count() en lugar de ->count() --}}
                @elseif(count($item->children) > 0 && !in_array($title, ['ACERCA', 'CAMPUS']))
                    <li class="dropdown">
                        <a href="{{ $item->url ?? '#' }}" class="header-link{{ request()->is(str_replace('/', '', $item->url).'/*') ? ' active' : '' }}">{{ $item->title }}</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>{{ $item->title }}</h3>
                                @if($item->description)
                                    <p>{{ $item->description }}</p>
                                @else
                                    <p>Opciones disponibles para {{ strtolower($item->title) }}.</p>
                                @endif
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Opciones</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        @foreach($item->children as $child)
                                            <li><a href="{{ $child->url }}">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($item->url && $item->url != '#')
                    <li>
                        <a href="{{ $item->url }}" class="header-link{{ request()->is(ltrim($item->url, '/')) ? ' active' : '' }}">{{ $item->title }}</a>
                    </li>
                @endif
            @endforeach
            {{-- Dropdown de CAMPUS (fijo, moderno) --}}
            <li class="dropdown">
                <a href="#" class="header-link">CAMPUS</a>
                <div class="dropdown-content academic-dropdown">
                    <div class="academic-dropdown-header">
                        <h3>Campus</h3>
                        <p>Explora los servicios, instalaciones y recursos del campus ISTS.</p>
                    </div>
                    <div class="academic-dropdown-columns">
                        <div class="academic-column">
                            <div class="academic-title">Servicios e Infraestructura</div>
                            <div class="academic-underline"></div>
                            <ul>
                                <li><a href="/campus/biblioteca">Biblioteca</a></li>
                                <li><a href="/campus/laboratorios">Laboratorios</a></li>
                                <li><a href="/campus/tecnologias">Tecnologías de la Información</a></li>
                            </ul>
                        </div>
                        <div class="academic-column">
                            <div class="academic-title">Vida Estudiantil</div>
                            <div class="academic-underline"></div>
                            <ul>
                                <li><a href="/campus/bienestar">Bienestar Estudiantil</a></li>
                                <li><a href="/campus/deportes">Deportes</a></li>
                                <li><a href="/campus/comedor">Comedor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="header-link">TRÁMITES</a>
                <div class="dropdown-content academic-dropdown">
                    <div class="academic-dropdown-header">
                        <h3>Trámites</h3>
                        <p>Consulta y accede a los trámites institucionales disponibles en el ISTS.</p>
                    </div>
                    <div class="academic-dropdown-columns">
                        <div class="academic-column">
                            <div class="academic-title">Trámites Disponibles</div>
                            <div class="academic-underline"></div>
                            <ul>
                                @foreach($tramites as $tramite)
                                    <li><a href="{{ url('/tramites/'.$tramite->slug) }}">{{ $tramite->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>

<style>
    /* Reset Box Sizing para mejor control de layout */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    .header-public {
        width: 100%;
        background: transparent;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1030; /* Incrementado para asegurar que esté por encima de otros elementos */
        transition: background 0.3s, box-shadow 0.3s, transform 0.3s ease-in-out;
        transform: translateY(0);
    }
    .header-hidden {
        transform: translateY(-100%);
    }
    .scrolled-header {
        background: rgba(44,62,80,0.95) !important;
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
.dropdown {
    position: relative; /* Esencial para que el dropdown-content se posicione correctamente */
}
.dropdown-content {
    /* Estado inicial para escritorio */
    display: none;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease; /* Transiciones suaves */

    position: absolute;
    top: 100%; /* Posiciona justo debajo del elemento padre */
    left: 50%;
    transform: translateX(-50%);
    min-width: 300px;
    background: #ffffff;
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    border-radius: 6px;
    padding: 1rem;
    z-index: 9999; /* Asegura que esté por encima de todo */
    margin-top: 0.5rem;
    /* Añadido para prevenir que el texto fuerce anchos excesivos */
    white-space: normal;
}
        /* Estilos específicos para el menú académico */
        .academic-dropdown {
            min-width: 600px;
            max-width: 700px;
            padding: 0;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            overflow: hidden;
            left: 50%;
            transform: translateX(-50%);
        }
        .academic-dropdown-header {
            background: linear-gradient(90deg, #1766a3 0%, #1abc9c 100%);
            color: #fff;
            padding: 1.2rem 2rem 1rem 2rem;
        }
        .academic-dropdown-header h3 {
            margin: 0 0 0.3rem 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffb300;
            letter-spacing: 0.5px;
        }
        .academic-dropdown-header p {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 400;
            color: #fff;
        }
        .academic-dropdown-columns {
            display: flex;
            gap: 2.5rem;
            padding: 2rem 2rem 1.5rem 2rem;
            background: #fff;
        }
        .academic-column {
            flex: 1;
            min-width: 200px;
        }
        .academic-title {
            color: #10b981;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        .academic-underline {
            width: 60px;
            height: 3px;
            background: #ffb300;
            margin-bottom: 0.7rem;
            border-radius: 2px;
        }
        .academic-desc {
            font-size: 1rem;
            color: #444;
            margin-bottom: 0.7rem;
        }
        .academic-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .academic-column li {
            margin-bottom: 0.5rem;
            font-size: 1.05rem;
            color: #222;
        }
        .academic-column a {
            color: #1766a3;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .academic-column a:hover {
            color: #10b981;
            text-decoration: underline;
        }
        @media (max-width: 900px) {
            .academic-dropdown {
                min-width: 100vw;
                max-width: 100vw;
                padding: 0;
                left: 0;
                transform: none;
            }
            .academic-dropdown-columns {
                flex-direction: column;
                gap: 1.2rem;
                padding: 1.2rem;
            }
        }
    .two-column {
        display: flex;
        gap: 2rem;
        /* Limita el ancho máximo para evitar que se extienda demasiado */
        max-width: 600px; /* Ajusta este valor según tu diseño */
        min-width: 400px; /* Asegura un ancho mínimo para dos columnas */
    }
    .two-column .column {
        flex: 1;
        /* box-sizing: border-box; ya en el reset universal */
    }
    .two-column .column h4 {
        color: #333;
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }
    .two-column .column ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .two-column .column li {
        margin-bottom: 0.4rem;
    }

    /* Reglas para mostrar el dropdown al pasar el mouse (escritorio) */
    .dropdown:hover > .dropdown-content,
    .dropdown:focus-within > .dropdown-content {
        display: block; /* Muestra el elemento */
        opacity: 1;
        visibility: visible;
    }

    .dropdown-content li {
        margin-bottom: 0.5rem;
    }
    .dropdown-content li:last-child {
        margin-bottom: 0;
    }
    .dropdown-content a {
        color: #007bff;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        display: block; /* Para que el área de clic sea más grande */
        padding: 0.2rem 0; /* Pequeño padding para cada enlace */
    }
    .dropdown-content a:hover {
        color: #0056b3;
    }
    .header-logo {
        width: 70px;
        height: auto;
        margin-bottom: 0.2rem;
    }
    .header-logo-text {
        text-align: center;
        font-family: 'Inter', Arial, sans-serif;
        font-size: 1rem;
        color: #1a3c2b;
        font-weight: 500;
        line-height: 1.1;
    }
    .header-logo-title {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .header-logo-subtitle {
        color: #2eaf3b;
        font-size: 1.2rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .header-navbar {
        width: 100%;
        display: flex;
        justify-content: center;
        background: transparent;
        border-top: 1px solid rgba(0,0,0,0.04);
        border-bottom: 1px solid rgba(0,0,0,0.07);
        margin-bottom: 0.5rem;
    }
    .header-menu {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 2.5rem; /* Espacio entre los elementos del menú principal */
        list-style: none;
        margin: 0;
        padding: 0.7rem 0;
    }
    .header-link {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 1px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.25);
        transition: color 0.2s;
        padding: 0.2rem 0.7rem;
        border-radius: 3px;
        position: relative;
    }
    .header-link.active,
    .header-link:hover {
        color: #2eaf3b;
        background: rgba(255,255,255,0.15);
    }

    /* Media queries para responsividad */
    @media (max-width: 992px) { /* Tablet y móvil */
        .dropdown-content {
            position: static; /* Cambia a posición estática para fluir con el contenido */
            min-width: 100%;
            box-shadow: none;
            background: #fff;
            padding: 0.5rem 1rem;
            opacity: 1; /* Asegura visibilidad en móvil */
            visibility: visible;
            transition: none; /* Deshabilita transiciones para móvil */
        }
        .dropdown.open > .dropdown-content {
            display: block !important; /* Muestra si la clase 'open' está presente (controlado por JS) */
        }
        .two-column {
            flex-direction: column; /* Columnas apiladas en móvil */
            max-width: 100%;
            min-width: unset;
        }
    }

    @media (max-width: 900px) {
        .header-menu {
            gap: 1.2rem;
        }
        .header-link {
            font-size: 1rem;
        }
        .header-logo {
            width: 50px;
        }
    }
    @media (max-width: 600px) {
        .header-menu {
            flex-wrap: wrap;
            gap: 0.7rem;
        }
        .header-logo-bar {
            padding-bottom: 0.2rem;
        }
    }

    /* Reglas específicas para pantallas de escritorio grandes (mantener original si aplica) */
    @media (min-width: 993px) {
        .header-navbar .header-link {
            font-size: 1.05rem !important;
            letter-spacing: 0.5px;
            padding: 0.7rem 1.2rem;
        }
        .header-navbar .header-menu > li {
            margin-right: 0.5rem;
        }
        .header-navbar img[alt="Logo ISTS"] {
            height: 80px !important;
            max-width: 180px;
            width: auto;
            vertical-align: middle;
        }
    }
</style>

<script>
let lastScrollTop = 0;
const header = document.querySelector('.header-public');
const scrollThreshold = 50; // a little bit of scroll before anything happens

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
        // Scroll Down
        header.classList.add('header-hidden');
    } else {
        // Scroll Up
        header.classList.remove('header-hidden');
    }

    if (scrollTop > 30) {
        header.classList.add('scrolled-header');
    } else {
        header.classList.remove('scrolled-header');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
}, false);


document.addEventListener('DOMContentLoaded', function () {
    // Eliminar el estilo inline 'display: none;' o 'opacity: 0' de los dropdown-content
    // Esto asegura que las reglas CSS de :hover/clase 'open' puedan tomar efecto.
    document.querySelectorAll('.dropdown-content').forEach(function(content) {
        if (content.style.display === 'none') {
            content.style.removeProperty('display');
        }
        if (content.style.opacity === '0') {
            content.style.removeProperty('opacity');
        }
        if (content.style.visibility === 'hidden') {
            content.style.removeProperty('visibility');
        }
    });

    // Solo para móvil/tablet
    if(window.innerWidth <= 992) {
        document.querySelectorAll('.dropdown > .header-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var parent = this.parentElement;
                parent.classList.toggle('open');
                // Cierra otros dropdowns
                document.querySelectorAll('.dropdown').forEach(function(drop) {
                    if(drop !== parent) drop.classList.remove('open');
                });
            });
        });
        // Cierra dropdowns al hacer click fuera
        document.addEventListener('click', function(e) {
            if(!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown').forEach(function(drop) {
                    drop.classList.remove('open');
                });
            }
        });
    }
});
</script>
