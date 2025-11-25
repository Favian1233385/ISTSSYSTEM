<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Instituto Superior Tecnológico Sudamericano - Formando profesionales de excelencia">
    <title><?= $title ?? 'ISTS - Instituto Superior Tecnológico Sudamericano' ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/style.css">
    <link rel="icon" type="image/x-icon" href="<?= APP_URL ?>/public/assets/images/favicon.ico">
    <meta name="robots" content="index, follow">
    <meta name="author" content="ISTS">
    <meta property="og:title" content="<?= $title ?? 'ISTS - Instituto Superior Tecnológico Sudamericano' ?>">
    <meta property="og:description" content="Formando profesionales de excelencia desde 1995">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= APP_URL ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $title ?? 'ISTS' ?>">
    <meta name="twitter:description" content="Instituto Superior Tecnológico Sudamericano">
</head>
<body>
    <!-- Header Principal -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <nav class="top-nav">
                    <ul>
                        <li><a href="/admision">Admisión</a></li>
                        <li><a href="/noticias">Noticias</a></li>
                        <li><a href="/contacto">Contacto</a></li>
                        <li><a href="/auth/login" class="login-link">Portal Administrativo</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="header-main">
            <div class="container">
                <div class="logo-section">
                    <img src="<?= APP_URL ?>/public/assets/images/logoists.png" alt="ISTS Logo" class="logo">
                    <h1 class="institution-name">Instituto Superior Tecnológico Sucua</h1>
                </div>

                <nav class="main-nav">
                    <ul>
                        <li><a href="/" <?= (basename($_SERVER['REQUEST_URI']) === '' || basename($_SERVER['REQUEST_URI']) === '/') ? 'class="active"' : '' ?>>Inicio</a></li>
                        <li><a href="/nosotros" <?= basename($_SERVER['REQUEST_URI']) === 'nosotros' ? 'class="active"' : '' ?>>Nosotros</a></li>
                        <li><a href="/carreras" <?= basename($_SERVER['REQUEST_URI']) === 'carreras' ? 'class="active"' : '' ?>>Carreras</a></li>
                        <li><a href="/investigacion" <?= basename($_SERVER['REQUEST_URI']) === 'investigacion' ? 'class="active"' : '' ?>>Investigación</a></li>
                        <li><a href="/estudiantes" <?= basename($_SERVER['REQUEST_URI']) === 'estudiantes' ? 'class="active"' : '' ?>>Estudiantes</a></li>
                        <li><a href="/biblioteca" <?= basename($_SERVER['REQUEST_URI']) === 'biblioteca' ? 'class="active"' : '' ?>>Biblioteca</a></li>
                    </ul>
                </nav>

                <div class="search-box">
                    <input type="search" placeholder="Buscar en ISTS..." id="main-search">
                    <button type="submit">🔍</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Toggle -->
    <div class="mobile-menu-toggle" id="mobile-menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Mobile Menu -->
    <nav class="mobile-menu" id="mobile-menu">
        <div class="mobile-menu-header">
            <img src="<?= APP_URL ?>/public/assets/images/logoists.png" alt="ISTS" class="mobile-logo">
            <button class="mobile-menu-close" id="mobile-menu-close">✕</button>
        </div>

        <ul class="mobile-nav">
            <li><a href="/">Inicio</a></li>
            <li><a href="/nosotros">Nosotros</a></li>
            <li><a href="/carreras">Carreras</a></li>
            <li><a href="/investigacion">Investigación</a></li>
            <li><a href="/estudiantes">Estudiantes</a></li>
            <li><a href="/biblioteca">Biblioteca</a></li>
            <li><a href="/noticias">Noticias</a></li>
            <li><a href="/contacto">Contacto</a></li>
            <li><a href="/auth/login" class="mobile-login">Portal Administrativo</a></li>
        </ul>
    </nav>

    <style>
        /* Mobile Menu Styles */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1001;
            background-color: var(--color-primary);
            border-radius: 4px;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: var(--color-white);
            margin: 3px 0;
            transition: 0.3s;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100vh;
            background-color: var(--color-white);
            z-index: 1000;
            transition: right 0.3s ease;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
        }

        .mobile-menu.active {
            right: 0;
        }

        .mobile-menu-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid var(--color-border);
        }

        .mobile-logo {
            width: 40px;
            height: 40px;
        }

        .mobile-menu-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--color-gray);
        }

        .mobile-nav {
            list-style: none;
            padding: 1rem 0;
        }

        .mobile-nav li {
            margin-bottom: 0.5rem;
        }

        .mobile-nav a {
            display: block;
            padding: 1rem;
            color: var(--color-dark);
            text-decoration: none;
            border-bottom: 1px solid var(--color-border);
            transition: var(--transition);
        }

        .mobile-nav a:hover,
        .mobile-nav a.active {
            background-color: var(--color-light);
            color: var(--color-primary);
        }

        .mobile-login {
            background-color: var(--color-primary);
            color: var(--color-white);
            margin: 1rem;
            border-radius: 4px;
            text-align: center;
        }

        .mobile-login:hover {
            background-color: var(--color-secondary);
            color: var(--color-white);
        }

        /* Active link styles */
        .main-nav a.active {
            color: var(--color-primary);
            border-bottom-color: var(--color-primary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
            }

            .header-top {
                display: none;
            }

            .header-main {
                padding: 0.5rem 0;
            }

            .logo-section {
                flex-direction: column;
                text-align: center;
                margin-bottom: 1rem;
            }

            .institution-name {
                font-size: 1rem;
                margin-top: 0.5rem;
            }

            .main-nav {
                display: none;
            }

            .search-box {
                margin-top: 1rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 0.5rem;
            }

            .logo {
                width: 60px;
                height: 60px;
            }

            .institution-name {
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileClose = document.getElementById('mobile-menu-close');

            if (mobileToggle && mobileMenu) {
                mobileToggle.addEventListener('click', function() {
                    mobileMenu.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });

                mobileClose.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = '';
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!mobileMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                        mobileMenu.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });

                // Close menu when clicking on links
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        document.body.style.overflow = '';
                    });
                });
            }
        });
    </script>
