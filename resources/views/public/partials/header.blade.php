
<header class="header-public">
    <div class="header-logo-bar">
        <img src="{{ asset('assets/images/logoists.png') }}" alt="Instituto Superior Tecnológico Sucúa" class="header-logo">
        <div class="header-logo-text">
            <span class="header-logo-title">Instituto Superior Tecnológico</span><br>
            <span class="header-logo-subtitle">Sucúa</span>
        </div>
    </div>
    <nav class="header-navbar">
        <ul class="header-menu">
            <li><a href="{{ url('/academicos') }}" class="header-link{{ request()->is('academicos*') ? ' active' : '' }}">ACADÉMICOS</a></li>
            <li><a href="{{ url('/campus') }}" class="header-link{{ request()->is('campus*') ? ' active' : '' }}">CAMPUS</a></li>
            <li><a href="{{ url('/transparencia') }}" class="header-link{{ request()->is('transparencia*') ? ' active' : '' }}">TRANSPARENCIA</a></li>
            <li><a href="{{ url('/visitar') }}" class="header-link{{ request()->is('visitar*') ? ' active' : '' }}">VISITAR</a></li>
            <li><a href="{{ url('/acerca') }}" class="header-link{{ request()->is('acerca*') ? ' active' : '' }}">ACERCA</a></li>
            <li><a href="{{ url('/noticias') }}" class="header-link{{ request()->is('noticias*') ? ' active' : '' }}">NOTICIAS</a></li>
            <li><a href="{{ url('/tramites') }}" class="header-link{{ request()->is('tramites*') ? ' active' : '' }}">TRÁMITES</a></li>
        </ul>
    </nav>
</header>

<style>
.header-public {
    width: 100%;
    background: rgba(255,255,255,0.85);
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    position: relative;
    z-index: 100;
}
.header-logo-bar {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 10px;
    padding-bottom: 0.5rem;
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
    gap: 2.5rem;
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
</style>
