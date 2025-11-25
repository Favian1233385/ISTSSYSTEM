<header class="header">
    {{-- Top black bar with main site sections, matches legacy look --}}
    <div class="topbar">
        <div class="topbar-inner container">
            <nav class="topbar-nav">
                <ul>
                    <li {{ request()->is('academicos') ? 'class="active"' : '' }}>
                        <a href="{{ url(ltrim(($base ?? '') . '/academicos','/')) }}">ACADÉMICOS</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-section">
                                <h4>🎓 Programas de Grado</h4>
                                <p>Explora todas nuestras carreras tecnológicas y programas de grado.</p>
                                @php
                                    $careers = \App\Models\Career::active()->ordered()->get();
                                @endphp
                                @foreach($careers as $career)
                                    <a href="{{ url(ltrim(($base ?? '') . '/carrera/' . $career->slug,'/')) }}">{{ $career->name }}</a>
                                @endforeach
                                <div class="dropdown-modes">
                                    <span>Modalidad Presencial</span>
                                    <span>Modalidad Dual</span>
                                </div>
                            </div>
                            <div class="dropdown-section">
                                <h4>📚 Educación Continua</h4>
                                <p>Cursos y programas de formación continua.</p>
                                @php
                                    $sections = \App\Models\AcademicSection::active()->ordered()->get();
                                @endphp
                                @foreach($sections as $section)
                                    <a href="{{ url(ltrim(($base ?? '') . '/educacion-continua/' . $section->slug,'/')) }}">{{ $section->title }}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li {{ request()->is('campus') ? 'class="active"' : '' }}>
                        <a href="{{ url(ltrim(($base ?? '') . '/campus','/')) }}">CAMPUS</a>
                    </li>

                    <li {{ request()->is('enfoque') ? 'class="active"' : '' }}>
                        <a href="{{ url(ltrim(($base ?? '') . '/enfoque','/')) }}">ENFOQUE</a>
                    </li>

                    <li {{ request()->is('visitar') ? 'class="active"' : '' }}>
                        <a href="{{ url(ltrim(($base ?? '') . '/visitar','/')) }}">VISITAR</a>
                    </li>

                    <li {{ request()->is('acerca') ? 'class="active"' : '' }}>
                        <a href="{{ url(ltrim(($base ?? '') . '/acerca','/')) }}">ACERCA</a>
                    </li>

                    <li {{ request()->is('noticias*') ? 'class="active"' : '' }}>
                        <a href="{{ url(ltrim(($base ?? '') . '/noticias','/')) }}">NOTICIAS</a>
                    </li>

                    <li {{ request()->is('egresados') ? 'class="active"' : '' }}>
                        <a href="{{ url(ltrim(($base ?? '') . '/egresados','/')) }}">EGRESADOS</a>
                    </li>
    </div>

    {{-- Main header with logo, navigation, and search --}}
    <div class="header-main">
        <div class="container">
            <div class="logo-section">
                <h1 class="institution-name">Instituto Superior de Tecnología y Servicios</h1>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="{{ url(ltrim(($base ?? '') . '/','/')) }}" {{ request()->is('/') ? 'class="active"' : '' }}>Inicio</a></li>
                    <li><a href="{{ url(ltrim(($base ?? '') . '/academicos','/')) }}" {{ request()->is('academicos*') ? 'class="active"' : '' }}>Académicos</a></li>
                    <li><a href="{{ url(ltrim(($base ?? '') . '/campus','/')) }}" {{ request()->is('campus*') ? 'class="active"' : '' }}>Campus</a></li>
                    <li><a href="{{ url(ltrim(($base ?? '') . '/noticias','/')) }}" {{ request()->is('noticias*') ? 'class="active"' : '' }}>Noticias</a></li>
                    <li><a href="{{ url(ltrim(($base ?? '') . '/contacto','/')) }}" {{ request()->is('contacto*') ? 'class="active"' : '' }}>Contacto</a></li>
                </ul>
            </nav>

            <div class="search-box">
                <input type="text" placeholder="Buscar...">
                <button type="submit">Buscar</button>
            </div>
        </div>
    </div>

</header>
