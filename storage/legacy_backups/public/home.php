<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Instituto Superior Tecnológico Sucúa - Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago">
    <title>ISTS Sucúa - Instituto Superior Tecnológico Sucúa</title>
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/style.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/harvard-style.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/harvard-exact.css">
</head>
<body>

    <header class="header">
    

       <!-- <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <div class="logo-section">
                        <img src="<?= APP_URL ?>/public/assets/images/logoists.png" alt="ISTS Sucúa Logo" class="logo">
                        <h1 class="institution-name">ISTS</h1>
                    </div>

                    <div class="header-actions">
                        <div class="search-container">
                            <button class="search-toggle" aria-label="Buscar">🔍</button>
                            <div class="search-dropdown">
                                <input type="search" placeholder="Buscar en ISTS..." id="main-search">
                                <div class="search-suggestions">
                                    <a href="#" class="suggestion">Índice A-Z</a>
                                </div>
                            </div>
                        </div>

                        <button class="menu-toggle" aria-label="Menú">☰</button>
                    </div>
                </div>
            </div>
        </div>-->

        <!-- Navigation -->
        <nav class="main-navigation">
            <div class="container">
                <ul class="nav-menu">
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
                        <a href="/enfoque" class="nav-link">Enfoque</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>En Enfoque</h3>
                                <p>Explora un análisis de la investigación, trabajo académico y comunidad del ISTS.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Tecnología</h4>
                                    <p>Dentro de cada línea de código, esperando ser decodificada, están las tecnologías que nos hacen quienes somos.</p>
                                    <ul>
                                        <li><a href="/enfoque/desarrollo-software">¿Qué hay dentro?</a></li>
                                        <li><a href="/enfoque/programacion">¿Por qué eres tan bueno programando?</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-column">
                                    <h4>El ISTS y la Vanguardia en Desarrollo de Software</h4>
                                    <p>El ISTS, como institución educativa de tercer nivel, está comprometido
                                        con la formación de los futuros líderes tecnológicos. Nuestra carrera
                                        de Desarrollo de Software se enfoca en preparar profesionales altamente
                                        competentes, capaces de diseñar e implementar soluciones digitales innovadoras,
                                        desde aplicaciones web complejas hasta sistemas de gestión empresarial.</p>
                                    <ul>
                                        <li><a href="/enfoque/salud-digital">Explora la salud digital en ISTS</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="/visitar" class="nav-link">Visitar</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="/acerca" class="nav-link">Acerca</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Acerca del ISTS</h3>
                                <p>Aprende cómo está estructurado el ISTS, explora nuestra historia y descubre nuestra comunidad extendida.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Historia del ISTS</h4>
                                    <ul>
                                        <li><a href="/acerca/historia">Línea de tiempo</a></li>
                                        <li><a href="/acerca/mision-vision">Misión y Visión</a></li>
                                        <li><a href="/acerca/autoridades">Autoridades</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-column">
                                    <h4>Liderazgo y Gobierno</h4>
                                    <ul>
                                        <li><a href="/acerca/rector">Rector</a></li>
                                        <li><a href="/acerca/vicerrector">Vicerrector</a></li>
                                        <li><a href="/acerca/organigrama">Organigrama</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="/noticias" class="nav-link">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a href="/noticias" class="nav-link">Egresados</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-background" style="background-image: url('<?= APP_URL ?>/public/assets/images/hero.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">Instituto Superior Tecnológico Sucúa</h1>
                            <p class="hero-subtitle">Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago</p>
                            <div class="hero-actions">
                                <a href="/academicos" class="btn btn-primary">Explorar Carreras</a>
                                <a href="/contacto" class="btn btn-secondary">Solicitar Información</a>
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
                            <img src="assets/images/tecnologia.png" alt="Tecnología">
                        </div>
                        <div class="focus-content">
                            <h3>Tecnología</h3>
                            <p>Dentro de cada línea de código, esperando ser decodificada, están las tecnologías que nos hacen quienes somos. Los investigadores del ISTS están trabajando para entender cómo estas pequeñas instrucciones ejercen una influencia tan grande en nuestras vidas.</p>
                            <div class="focus-actions">
                                <a href="/enfoque/tecnologia" class="btn btn-outline">Descifrar los misterios</a>
                            </div>
                        </div>
                    </div>

                    <div class="focus-card">
                        <div class="focus-image">
                            <img src="/assets/images/tecnologia.jpg" alt="Vanguardia en Desarrollo de Software">
                        </div>
                        <div class="focus-content">
                            <h3>El ISTS y la Vanguardia en Desarrollo de Software</h3>
                            <p>El ISTS forma tecnólogos de tercer nivel en Desarrollo de Software. Preparamos profesionales altamente competentes, enfocados en diseñar e implementar soluciones digitales innovadoras, desde aplicaciones web hasta sistemas empresariales. Nuestros graduados están listos para liderar la vanguardia tecnológica y cubrir las demandas prácticas de la industria.</p>
                            <div class="focus-actions">
                                <a href="/enfoque/salud-digital" class="btn btn-outline">Explora el Desarrollo de Software en el ISTS</a>
                            </div>
                        </div>
                    </div>

                    <div class="focus-card">
                        <div class="focus-image">
                            <img src="/assets/images/bienvenida.jpg" alt="Bienvenida">
                        </div>
                        <div class="focus-content">
                            <h3>Bienvenido al ISTS</h3>
                            <p>En nuestro campus, profesores de clase mundial y estudiantes talentosos se unen para crear un mundo mejor a través de investigación innovadora, innovaciones de vanguardia y trabajo académico transformador.</p>
                            <div class="focus-actions">
                                <a href="/acerca" class="btn btn-outline">Únete a nosotros</a>
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
                    <?php if (isset($contents) && !empty($contents)): ?>
                        <?php foreach ($contents as $content): ?>
                            <div class="focus-card">
                                <?php if (!empty($content["image_url"])): ?>
                                    <div class="focus-image">
                                        <img src="<?= APP_URL ?>/public<?= htmlspecialchars(
    $content["image_url"],
) ?>" alt="<?= htmlspecialchars($content["title"]) ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="focus-content">
                                    <h3><?= htmlspecialchars(
                                        $content["title"],
                                    ) ?></h3>
                                    <p><?= htmlspecialchars(
                                        $content["description"],
                                    ) ?></p>
                                    <div class="focus-actions">
                                        <a href="/contenido/<?= htmlspecialchars(
                                            $content["slug"],
                                        ) ?>" class="btn btn-outline">Leer más</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay contenido reciente disponible.</p>
                    <?php endif; ?>
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
                        <a href="/academicos/desarrollo-software" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">📊</div>
                        <h3>Contabilidad y Asesoría Tributaria</h3>
                        <p>Especialización en contabilidad y asesoría fiscal</p>
                        <a href="/academicos/contabilidad" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">🌱</div>
                        <h3>Agroecología</h3>
                        <p>Desarrollo sostenible y agricultura ecológica</p>
                        <a href="/academicos/agroecologia" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">👶</div>
                        <h3>Educación Inicial</h3>
                        <p>Formación docente para educación inicial</p>
                        <a href="/academicos/educacion-inicial" class="btn btn-primary">Más información</a>
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
                            <img src="<?= APP_URL ?>/public/assets/images/noticia-principal.jpg" alt="Noticia Principal">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Tecnología</span>
                            <h3>Nuevas Tecnologías en el ISTS</h3>
                            <p>El Instituto Superior Tecnológico Sucúa implementa nuevas tecnologías para mejorar la experiencia educativa de nuestros estudiantes.</p>
                            <a href="/noticias/tecnologia-ists" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="<?= APP_URL ?>/public/assets/images/noticia-2.jpg" alt="Noticia 2">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Académico</span>
                            <h3>Nuevas Carreras Disponibles</h3>
                            <p>Conoce las nuevas carreras que el ISTS ofrece para el próximo semestre.</p>
                            <a href="/noticias/nuevas-carreras" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="<?= APP_URL ?>/public/assets/images/noticia-3.jpg" alt="Noticia 3">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Campus</span>
                            <h3>Mejoras en el Campus</h3>
                            <p>El ISTS continúa mejorando sus instalaciones para brindar una mejor experiencia educativa.</p>
                            <a href="/noticias/mejoras-campus" class="read-more">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="news-actions">
                    <a href="/noticias" class="btn btn-primary">Ver todas las noticias</a>
                    <a href="/noticias/suscribirse" class="btn btn-outline">Suscribirse a la Gaceta Diaria</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section class="quick-links">
            <div class="container">
                <h2>Enlaces Rápidos de Navegación</h2>
                <div class="links-grid">
                    <a href="/indice" class="quick-link">Índice A-Z</a>
                    <a href="/buscar-persona" class="quick-link">Buscar una persona</a>
                    <a href="/eventos" class="quick-link">Eventos</a>
                    <a href="/relaciones-publicas" class="quick-link">Relaciones Públicas</a>
                    <a href="/egresados" class="quick-link">Egresados</a>
                    <a href="/donar" class="quick-link">Donar Ahora</a>
                    <a href="/emergencia" class="quick-link">Emergencia</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-widget">
