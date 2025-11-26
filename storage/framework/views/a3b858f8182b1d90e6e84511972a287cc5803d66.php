<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Instituto Superior Tecnológico Sucúa - Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago">
    <title>ISTS Sucúa - Instituto Superior Tecnológico Sucúa</title>
    <link rel="stylesheet" href="<?php echo e(asset('public/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/harvard-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/harvard-exact.css')); ?>">
    <style>
        .nav-menu .nav-item .nav-link {
            font-size: 1.2rem; /* Increased font size for menu items */
        }
        .nav-menu .logo-item img {
            height: 100px; /* Further increased logo size */
        }

        /* General Styles */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 80vh;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            text-align: center;
            color: white;
            max-width: 800px;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #007bff;
            color: white;
            border: 2px solid #007bff;
        }

        .btn-primary:hover {
            background: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #007bff;
        }

        .btn-outline {
            background: transparent;
            color: #007bff;
            border: 2px solid #007bff;
        }

        .btn-outline:hover {
            background: #007bff;
            color: white;
        }

        /* Focus Section */
        .focus-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .focus-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .focus-header h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .focus-header p {
            font-size: 1.2rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
        }

        .focus-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .focus-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .focus-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .focus-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .focus-content {
            padding: 1.5rem;
        }

        .focus-content h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .focus-content p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        .focus-actions {
            text-align: center;
        }

        /* Programs Section */
        .programs-section {
            padding: 80px 0;
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .program-card {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .program-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .program-card h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .program-card p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        /* News Section */
        .news-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .news-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .news-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .news-card.featured {
            grid-row: span 2;
        }

        .news-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-content {
            padding: 1.5rem;
        }

        .news-category {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 3px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }

        .news-content h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .news-content p {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .read-more {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .read-more:hover {
            text-decoration: underline;
        }

        .news-actions {
            text-align: center;
        }

        /* Quick Links */
        .quick-links {
            padding: 60px 0;
            background: #2c3e50;
            color: white;
        }

        .quick-links h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .quick-link {
            display: block;
            background: rgba(255,255,255,0.1);
            color: white;
            padding: 1rem;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s ease;
        }

        .quick-link:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Footer */
        .footer {
            background: #1a252f;
            color: white;
            padding: 40px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            color: #007bff;
            margin-bottom: 1rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: #ccc;
            text-decoration: none;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .footer-social a {
            color: #ccc;
            font-size: 1.5rem;
        }

        .footer-social a:hover {
            color: white;
        }

        /* Chatbot */
        .chatbot-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .chatbot-toggle {
            background: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .chatbot-window {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 350px;
            height: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .chatbot-header {
            background: #007bff;
            color: white;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chatbot-messages {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
        }

        .chatbot-form {
            padding: 1rem;
            border-top: 1px solid #eee;
            display: flex;
        }

        .chatbot-form input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
        }

        .chatbot-form button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
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
                        <a href="<?php echo e(url('/')); ?>">
                            <img src="<?php echo e(asset('assets/images/logoists.png')); ?>" alt="Logo ISTS" style="height: 50px;">
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
                        <a href="<?php echo e(url('/enfoque')); ?>" class="nav-link">Transparencia</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Transparencia</h3>
                                <p>Explora un análisis de la investigación, trabajo académico y comunidad del ISTS.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Documentos y Reglamentos</h4>
                                    <ul>
                                        <li><a href="<?php echo e(url('/transparencia/reglamentos-internos')); ?>">Reglamentos Internos</a></li>
                                        <li><a href="<?php echo e(url('/transparencia/lotaip')); ?>">LOTAIP</a></li>
                                        <li><a href="<?php echo e(url('/transparencia/otros-documentos')); ?>">Otros Documentos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo e(url('/visitar')); ?>" class="nav-link">Visitar</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="<?php echo e(url('/acerca')); ?>" class="nav-link">Acerca</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Acerca del ISTS</h3>
                                <p>Aprende cómo está estructurado el ISTS, explora nuestra historia y descubre nuestra comunidad extendida.</p>
                            </div>
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Historia del ISTS</h4>
                                    <ul>
                                        <li><a href="<?php echo e(url('/acerca/historia')); ?>">Línea de tiempo</a></li>
                                        <li><a href="<?php echo e(url('/acerca/mision-vision')); ?>">Misión y Visión</a></li>
                                        <li><a href="<?php echo e(url('/acerca/autoridades')); ?>">Autoridades</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-column">
                                    <h4>Liderazgo y Gobierno</h4>
                                    <ul>
                                        <li><a href="<?php echo e(url('/acerca/rector')); ?>">Rector</a></li>
                                        <li><a href="<?php echo e(url('/acerca/vicerrector')); ?>">Vicerrector</a></li>
                                        <li><a href="<?php echo e(url('/acerca/organigrama')); ?>">Organigrama</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo e(url('/noticias')); ?>" class="nav-link">Noticias</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="<?php echo e(url('/tramites')); ?>" class="nav-link">Trámites</a>
                        <div class="dropdown-content">
                            <div class="dropdown-section">
                                <h3>Trámites Disponibles</h3>
                                <p>Encuentra información y guías sobre los trámites institucionales.</p>
                            </div>
                            <div class="dropdown-grid">
                                <?php if(isset($tramites) && !empty($tramites)): ?>
                                    <?php $__currentLoopData = $tramites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tramite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="dropdown-column">
                                            <h4><?php echo e(htmlspecialchars($tramite['title'])); ?></h4>
                                            <p><?php echo e(htmlspecialchars($tramite['description'])); ?></p>
                                            <a href="<?php echo e(url('/contents/' . htmlspecialchars($tramite['slug']))); ?>" class="btn btn-outline">Leer más</a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <p>No hay trámites disponibles en este momento.</p>
                                <?php endif; ?>
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
            <div class="hero-background" style="background-image: url('<?php echo e(asset('assets/images/hero.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">Instituto Superior Tecnológico Sucúa</h1>
                            <p class="hero-subtitle">Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago</p>
                            <div class="hero-actions">
                                <a href="<?php echo e(url('/academicos')); ?>" class="btn btn-primary">Explorar Carreras</a>
                                <a href="<?php echo e(url('/contacto')); ?>" class="btn btn-secondary">Solicitar Información</a>
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
                            <img src="<?php echo e(asset('assets/images/tecnologia.png')); ?>" alt="Tecnología">
                        </div>
                        <div class="focus-content">
                            <h3>Tecnología</h3>
                            <p>Dentro de cada línea de código, esperando ser decodificada, están las tecnologías que nos hacen quienes somos. Los investigadores del ISTS están trabajando para entender cómo estas pequeñas instrucciones ejercen una influencia tan grande en nuestras vidas.</p>
                            <div class="focus-actions">
                                <a href="<?php echo e(url('/enfoque/tecnologia')); ?>" class="btn btn-outline">Descifrar los misterios</a>
                            </div>
                        </div>
                    </div>

                    <div class="focus-card">
                        <div class="focus-image">
                            <img src="<?php echo e(asset('assets/images/tecnologia.jpg')); ?>" alt="Vanguardia en Desarrollo de Software">
                        </div>
                        <div class="focus-content">
                            <h3>El ISTS y la Vanguardia en Desarrollo de Software</h3>
                            <p>El ISTS forma tecnólogos de tercer nivel en Desarrollo de Software. Preparamos profesionales altamente competentes, enfocados en diseñar e implementar soluciones digitales innovadoras, desde aplicaciones web hasta sistemas empresariales. Nuestros graduados están listos para liderar la vanguardia tecnológica y cubrir las demandas prácticas de la industria.</p>
                            <div class="focus-actions">
                                <a href="<?php echo e(url('/enfoque/salud-digital')); ?>" class="btn btn-outline">Explora el Desarrollo de Software en el ISTS</a>
                            </div>
                        </div>
                    </div>

                    <div class="focus-card">
                        <div class="focus-image">
                            <img src="<?php echo e(asset('assets/images/bienvenida.jpg')); ?>" alt="Bienvenida">
                        </div>
                        <div class="focus-content">
                            <h3>Bienvenido al ISTS</h3>
                            <p>En nuestro campus, profesores de clase mundial y estudiantes talentosos se unen para crear un mundo mejor a través de investigación innovadora, innovaciones de vanguardia y trabajo académico transformador.</p>
                            <div class="focus-actions">
                                <a href="<?php echo e(url('/acerca')); ?>" class="btn btn-outline">Únete a nosotros</a>
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
                    <?php if(isset($contents) && !empty($contents)): ?>
                        <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="focus-card">
                                <?php if(!empty($content["image_url"])): ?>
                                    <div class="focus-image">
                                        <img src="<?php echo e(asset(htmlspecialchars($content["image_url"]))); ?>" alt="<?php echo e(htmlspecialchars($content["title"])); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="focus-content">
                                    <h3><?php echo e(htmlspecialchars($content["title"])); ?></h3>
                                    <p><?php echo e(htmlspecialchars($content["description"])); ?></p>
                                    <div class="focus-actions">
                                        <a href="<?php echo e(url('/contenido/' . htmlspecialchars($content["slug"]))); ?>" class="btn btn-outline">Leer más</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <a href="<?php echo e(url('/academicos/desarrollo-software')); ?>" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">📊</div>
                        <h3>Contabilidad y Asesoría Tributaria</h3>
                        <p>Especialización en contabilidad y asesoría fiscal</p>
                        <a href="<?php echo e(url('/academicos/contabilidad')); ?>" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">🌱</div>
                        <h3>Agroecología</h3>
                        <p>Desarrollo sostenible y agricultura ecológica</p>
                        <a href="<?php echo e(url('/academicos/agroecologia')); ?>" class="btn btn-primary">Más información</a>
                    </div>

                    <div class="program-card">
                        <div class="program-icon">👶</div>
                        <h3>Educación Inicial</h3>
                        <p>Formación docente para educación inicial</p>
                        <a href="<?php echo e(url('/academicos/educacion-inicial')); ?>" class="btn btn-primary">Más información</a>
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
                            <img src="<?php echo e(asset('assets/images/noticia-principal.jpg')); ?>" alt="Noticia Principal">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Tecnología</span>
                            <h3>Nuevas Tecnologías en el ISTS</h3>
                            <p>El Instituto Superior Tecnológico Sucúa implementa nuevas tecnologías para mejorar la experiencia educativa de nuestros estudiantes.</p>
                            <a href="<?php echo e(url('/noticias/tecnologia-ists')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="<?php echo e(asset('assets/images/noticia-2.jpg')); ?>" alt="Noticia 2">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Académico</span>
                            <h3>Nuevas Carreras Disponibles</h3>
                            <p>Conoce las nuevas carreras que el ISTS ofrece para el próximo semestre.</p>
                            <a href="<?php echo e(url('/noticias/nuevas-carreras')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="<?php echo e(asset('assets/images/noticia-3.jpg')); ?>" alt="Noticia 3">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Campus</span>
                            <h3>Mejoras en el Campus</h3>
                            <p>El ISTS continúa mejorando sus instalaciones para brindar una mejor experiencia educativa.</p>
                            <a href="<?php echo e(url('/noticias/mejoras-campus')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="news-actions">
                    <a href="<?php echo e(url('/noticias')); ?>" class="btn btn-primary">Ver todas las noticias</a>
                    <a href="<?php echo e(url('/noticias/suscribirse')); ?>" class="btn btn-outline">Suscribirse a la Gaceta Diaria</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section class="quick-links">
            <div class="container">
                <h2>Enlaces Rápidos de Navegación</h2>
                <div class="links-grid">
                    <a href="<?php echo e(url('/indice')); ?>" class="quick-link">Índice A-Z</a>
                    <a href="<?php echo e(url('/buscar-persona')); ?>" class="quick-link">Buscar una persona</a>
                    <a href="<?php echo e(url('/eventos')); ?>" class="quick-link">Eventos</a>
                    <a href="<?php echo e(url('/relaciones-publicas')); ?>" class="quick-link">Relaciones Públicas</a>
                    <a href="<?php echo e(url('/egresados')); ?>" class="quick-link">Egresados</a>
                    <a href="<?php echo e(url('/donar')); ?>" class="quick-link">Donar Ahora</a>
                    <a href="<?php echo e(url('/emergencia')); ?>" class="quick-link">Emergencia</a>
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
                <?php echo csrf_field(); ?>
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
                        <li><a href="<?php echo e(url('/reportar-copyright')); ?>">Reportar Infracción de Derechos de Autor</a></li>
                        <li><a href="<?php echo e(url('/reportar-seguridad')); ?>">Reportar Problema de Seguridad</a></li>
                        <li><a href="<?php echo e(url('/aviso-marca')); ?>">Aviso de Marca</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Sitio Web</h4>
                    <ul>
                        <li><a href="<?php echo e(url('/accesibilidad')); ?>">Accesibilidad</a></li>
                        <li><a href="<?php echo e(url('/accesibilidad-digital')); ?>">Accesibilidad Digital</a></li>
                        <li><a href="<?php echo e(url('/declaracion-privacidad')); ?>">Declaración de Privacidad</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Ponte en Contacto</h4>
                    <ul>
                        <li><a href="<?php echo e(url('/contacto')); ?>">Contactar ISTS</a></li>
                        <li><a href="<?php echo e(url('/mapas-direcciones')); ?>">Mapas y Direcciones</a></li>
                        <li><a href="<?php echo e(url('/trabajos')); ?>">Trabajos</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo e(date("Y")); ?> Todos Los derechos Reservados. Autor: Cumbanama</p>
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
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chatbot.js')); ?>"></script>
    <script src="<?php echo e(asset('js/harvard-interactions.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/home.blade.php ENDPATH**/ ?>