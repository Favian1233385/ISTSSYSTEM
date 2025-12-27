<style>
    .header-public {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        /* Azul más suave y transparencia */
        background: linear-gradient(90deg, rgba(52,152,219,0.85) 0%, rgba(72,224,164,0.85) 100%);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.4s cubic-bezier(0.4,0,0.2,1);
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let lastScrollTop = window.scrollY;
        let ticking = false;
        const header = document.querySelector('.header-public');
        function onScroll() {
            let st = window.scrollY;
            if (st > lastScrollTop && st > 30) {
                header.style.transform = 'translateY(-100%)';
            } else if (st < lastScrollTop) {
                header.style.transform = 'translateY(0)';
            }
            lastScrollTop = st;
        }
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    onScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
    });
</script>


<header class="header-public">
    @php
        $allCareers = \App\Models\Career::where('is_active', true)->orderBy('name')->get();
        $tramites = \Illuminate\Support\Facades\DB::table('contents')->where('category', 'tramites')->where('status', 'published')->orderBy('title')->get();
        $menuItems = \App\Models\MenuItem::whereNull('parent_id')->where('is_active', true)->with('children')->orderBy('order')->get();
        $contentModel = new \App\Models\Content();
        $aboutContents = $contentModel->getByCategory('about');
        $acercaMenuItem = $menuItems->firstWhere('title', 'ACERCA');
        $visitSections = \App\Models\VisitSection::active()->ordered()->get();
        $campusItems = \App\Models\CampusItem::active()->where('category', 'servicios')->ordered()->get();
        $vidaEstudiantilItems = \App\Models\CampusItem::active()->where('category', 'Vida Estudiantil')->ordered()->get();
        $icons = [
            'asesoria-juridica' => '⚖️',
            'bienestar-institucional' => '❤️',
            'planificacion-estrategica' => '📈',
            'relaciones-internacionales' => '🌍',
            'secretaria-general' => '📋',
            'seguridad-salud-ocupacional' => '🛡️',
            'talento-humano' => '👥',
            'tecnologias-informacion' => '💻',
            'unidad-administrativa' => '🏢',
            'unidad-comunicacion' => '📢',
        ];
        $transparencyContents = $transparencyContents ?? [];
    @endphp
    <nav class="header-navbar" style="width: 100%; background: transparent; box-shadow: none; display: flex; justify-content: center; align-items: center; padding: 0.75rem 0;">
        <ul class="header-menu" style="display: flex; flex-direction: row; align-items: center; gap: 2.5rem; list-style: none; margin: 0 auto; padding: 0; justify-content: center;">
            <li style="margin-right: 2.5rem; display: flex; align-items: center;">
                <a href="{{ url('/') }}" style="display: flex; align-items: center;">
                    <img src="{{ asset('assets/images/logoists.png') }}" alt="Logo ISTS" style="height: 56px; vertical-align: middle; margin-right: 1rem;">
                </a>
            </li>
            <li class="dropdown" style="position: relative;">
                <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">ACERCA</a>
                <div class="dropdown-content academic-dropdown">
                    <div class="academic-dropdown-header">
                        <h3>Acerca</h3>
                        
                    </div>
                    <div class="academic-dropdown-columns">
                        <div class="academic-column">
                            <div class="academic-title">Secciones</div>
                            <div class="academic-underline"></div>
                            <ul>
                                @foreach($aboutContents as $section)
                                    @if(Str::lower($section['title']) !== 'sobre el ists')
                                        <li>
                                            @if(Str::lower($section['title']) === 'autoridades')
                                                <a href="{{ url('/autoridades') }}">{{ $section['title'] }}</a>
                                            @elseif(Str::lower($section['title']) === 'planta docente')
                                                <a href="{{ url('/planta-docente') }}">{{ $section['title'] }}</a>
                                            @else
                                                <a href="{{ url('/contenido/'.$section['slug']) }}">{{ $section['title'] }}</a>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                                @if($acercaMenuItem && count($acercaMenuItem->children) > 0)
                                    @foreach($acercaMenuItem->children as $child)
                                        @if(Str::lower($child->title) !== 'sobre el ists')
                                            <li>
                                                <a href="{{ url($child->url) }}">{{ $child->title }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            @foreach($menuItems as $item)
                @php $title = strtoupper($item->title); @endphp
                @if($title == 'ACERCA')
                    @continue
                @elseif($title == 'ACADÉMICOS')
                    <li class="dropdown" style="position: relative;">
                        <a href="{{ route('academicos') }}" class="header-link{{ request()->is('academicos') ? ' active' : '' }}" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">ACADÉMICOS</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Académicos</h3>
                                
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Programas de Grado</div>
                                    <div class="academic-underline"></div>
                                   
                                    <ul>
                                        @foreach($allCareers as $career)
                                            <li><a href="{{ route('career.show', $career->slug) }}">{{ $career->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Educación Continua</div>
                                    <div class="academic-underline"></div>
                                    @php
                                        $modalidades = \App\Models\AcademicModality::where('is_active', true)->orderBy('order')->get();
                                    @endphp
                                    <ul class="educacion-continua-list" style="list-style:none; padding-left:0;">
                                        @foreach($modalidades as $mod)
                                            <li class="modalidad-item" style="margin-bottom:10px;">
                                                <div class="modalidad-title" style="font-weight:bold; margin-bottom:4px;">{{ $mod->title }}</div>
                                                @if($mod->programs()->where('is_active', true)->count())
                                                    <ul class="programas-list" style="margin-left:20px; list-style:disc;">
                                                        @foreach($mod->programs()->where('is_active', true)->orderBy('order')->get() as $prog)
                                                            <li class="programa-item" style="margin-bottom:4px;">
                                                                <a href="{{ route('inscripcion.create', $prog->id) }}" class="programa-link" style="color:#007bff; text-decoration:underline; cursor:pointer; font-weight:500;" target="_blank">{{ $prog->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <div style="margin-left:20px; color:#888; font-size:13px;">No hay cursos registrados.</div>
                                                @endif
                                                @if($mod->description)
                                                    <div class="modalidad-desc" style="margin-left:20px; color:#666; font-size:13px;">{{ $mod->description }}</div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($title == 'CAMPUS')
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">SERVICIOS</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Servicios</h3>
                               
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Servicios e Infraestructura</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        @foreach($campusItems ?? [] as $campusItem)
                                            <li>
                                                <a href="{{ $campusItem->url ?? '#' }}" style="font-weight:bold;">{{ $campusItem->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Vida Estudiantil</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        @foreach(($vidaEstudiantilItems ?? []) as $campusItem)
                                            <li>
                                                <a href="{{ $campusItem->url ?? '#' }}" style="font-weight:bold;">{{ $campusItem->title }}</a>
                                                @if($campusItem->contents && $campusItem->contents->count())
                                                    <ul style="margin-left:20px;">
                                                        @foreach($campusItem->contents as $content)
                                                            <li>
                                                                <a href="{{ $content->external_url ?? '#' }}" target="_blank" style="color:#007bff; text-decoration:underline;">{{ $content->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($title == 'VISITAR')
                    @php
                        $total = count($visitSections);
                        $half = ceil($total / 2);
                        $firstCol = $visitSections->slice(0, $half);
                        $secondCol = $visitSections->slice($half);
                    @endphp
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">VISITAR</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Visitar</h3>
                               
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Secciones Institucionales</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        @foreach($firstCol as $section)
                                            <li>
                                                <a href="{{ url('/visitar/'.$section->slug) }}">
                                                    {{ $icons[$section->slug] ?? '' }} {{ $section->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Más Secciones</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        @foreach($secondCol as $section)
                                            <li>
                                                <a href="{{ url('/visitar/'.$section->slug) }}">
                                                    {{ $icons[$section->slug] ?? '' }} {{ $section->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($title == 'NOTICIAS')
                    <li><a href="/noticias" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">NOTICIAS</a></li>
                @elseif($title == 'TRANSPARENCIA')
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">TRANSPARENCIA</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Transparencia</h3>
                               
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Secciones</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        @foreach($transparencyContents as $parent)
                                            <li class="dropdown-item">
                                                @php
                                                    $url = isset($parent['file_url']) && filter_var($parent['file_url'], FILTER_VALIDATE_URL)
                                                        ? $parent['file_url']
                                                        : (isset($parent['file_url']) && $parent['file_url'] ? asset($parent['file_url']) : url('transparency/' . $parent['slug']));
                                                    $target = (isset($parent['file_url']) && $parent['file_url']) ? '_blank' : '_self';
                                                @endphp
                                                <a href="{{ $url }}" target="{{ $target }}">{{ $parent['title'] }}</a>
                                                @if(!empty($parent['children']))
                                                    <ul class="dropdown-submenu">
                                                        @foreach($parent['children'] as $child)
                                                            @if($parent['title'] === 'Reglamentos Internos')
                                                                <li class="dropdown-subitem">
                                                                    @php
                                                                        $url = isset($child['file_url']) && filter_var($child['file_url'], FILTER_VALIDATE_URL)
                                                                            ? $child['file_url']
                                                                            : (isset($child['file_url']) && $child['file_url'] ? asset($child['file_url']) : url('transparency/' . $child['slug']));
                                                                        $target = (isset($child['file_url']) && $child['file_url']) ? '_blank' : '_self';
                                                                    @endphp
                                                                    <a href="{{ $url }}" target="{{ $target }}">{{ $child['title'] }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($title == 'TRÁMITES')
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">DOCUMENTOS</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Documentos</h3>
                              
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <ul>
                                        @foreach($tramites as $tramite)
                                            @php
                                                $url = $tramite->url ?? null;
                                                $file = $tramite->file_url ?? null;
                                                $isExternalUrl = $url && filter_var($url, FILTER_VALIDATE_URL);
                                                $isFile = $file && !$isExternalUrl;
                                            @endphp
                                            <li class="dropdown-item">
                                                @if($isExternalUrl)
                                                    <a href="{{ $url }}" target="_blank">{{ $tramite->title }}</a>
                                                @elseif($isFile)
                                                    <a href="{{ asset($file) }}" target="_blank">{{ $tramite->title }}</a>
                                                @else
                                                    <span>{{ $tramite->title }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <li><a href="{{ $item->url }}" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">{{ $item->title }}</a></li>
                @endif
            @endforeach
        </ul>
    </nav>
</header>
