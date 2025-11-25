<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conoce más sobre el Instituto Superior Tecnológico Sudamericano - Nuestra historia, misión y visión">
    <title><?= $title ?? "Sobre Nosotros - ISTS" ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include "app/views/public/header.php"; ?>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1>Instituto Superior Tecnológico Sucua</h1>
            <p>Formando profesionales de excelencia desde 1995</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-content">
        <div class="container">
            <?php if (isset($content) && !empty($content)): ?>
                <div class="content-wrapper">
                    <h2><?= htmlspecialchars($content["title"]) ?></h2>
                    <div class="content-body">
                        <?= $content["content"] ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="content-wrapper">
                    <h2>Nuestra Historia</h2>
                    <p>El Instituto Superior Tecnológico Sucua (ISTS) fue fundado en 1995 con la visión de formar profesionales altamente capacitados en el campo de la tecnología y la innovación. Desde nuestros inicios, hemos mantenido un compromiso inquebrantable con la excelencia académica y la formación integral de nuestros estudiantes.</p>

                    <h3>Misión</h3>
                    <p>Formar profesionales de excelencia en el campo tecnológico, capaces de contribuir al desarrollo sostenible de la sociedad, mediante una educación de calidad, innovadora y comprometida con los valores éticos y la responsabilidad social.</p>

                    <h3>Visión</h3>
                    <p>Ser reconocidos como la institución líder en educación tecnológica, formando profesionales que transformen la sociedad a través de la innovación, la tecnología y el compromiso con el desarrollo sostenible.</p>

                    <h3>Valores</h3>
                    <ul>
                        <li><strong>Excelencia:</strong> Buscamos la perfección en todo lo que hacemos</li>
                        <li><strong>Innovación:</strong> Promovemos la creatividad y el pensamiento disruptivo</li>
                        <li><strong>Integridad:</strong> Actuamos con honestidad y transparencia</li>
                        <li><strong>Responsabilidad Social:</strong> Contribuimos al bienestar de la comunidad</li>
                        <li><strong>Respeto:</strong> Valoramos la diversidad y la inclusión</li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">2,500+</span>
                    <span class="stat-label">Estudiantes</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">8</span>
                    <span class="stat-label">Carreras Tecnológicas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">150+</span>
                    <span class="stat-label">Docentes Calificados</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">95%</span>
                    <span class="stat-label">Inserción Laboral</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="leadership-section">
        <div class="container">
            <h2>Nuestro Equipo Directivo</h2>
        <div class="leadership-grid">
                <div class="leader-card">
                    <div class="leader-image">
                        <img src="/assets/images/director.jpg" alt="Director General">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. Carlos Mendoza</h3>
                        <p class="leader-position">Director General</p>
                        <p class="leader-bio">Doctor en Ingeniería de Sistemas con más de 20 años de experiencia en educación superior y desarrollo tecnológico.</p>
                    </div>
                </div>

                <div class="leader-card">
                    <div class="leader-image">
                        <img src="/assets/images/academic-director.jpg" alt="Directora Académica">
                    </div>
                    <div class="leader-info">
                        <h3>Dra. María González</h3>
                        <p class="leader-position">Directora Académica</p>
                        <p class="leader-bio">Especialista en Pedagogía Tecnológica y líder en innovación educativa con amplia experiencia internacional.</p>
                    </div>
                </div>

                <div class="leader-card">
                    <div class="leader-image">
                        <img src="/assets/images/research-director.jpg" alt="Director de Investigación">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. Roberto Silva</h3>
                        <p class="leader-position">Director de Investigación</p>
                        <p class="leader-bio">Investigador en Inteligencia Artificial y líder de proyectos de innovación tecnológica.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "app/views/public/footer.php"; ?>

    <style>
        .about-hero {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: var(--color-white);
            padding: 4rem 0;
            text-align: center;
        }

        .about-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-family: var(--font-primary);
        }

        .about-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .about-content {
            padding: 4rem 0;
        }

        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .content-wrapper h2 {
            color: var(--color-primary);
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }

        .content-wrapper h3 {
            color: var(--color-dark);
            margin: 2rem 0 1rem;
            font-size: 1.5rem;
        }

        .content-wrapper p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            color: var(--color-dark);
        }

        .content-wrapper ul {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .content-wrapper li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        .content-body {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .leadership-section {
            background-color: var(--color-light);
            padding: 4rem 0;
        }

        .leadership-section h2 {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--color-dark);
            font-size: 2.5rem;
        }

        .leadership-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .leader-card {
            background-color: var(--color-white);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .leader-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .leader-image {
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--color-primary);
        }

        .leader-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .leader-info h3 {
            color: var(--color-primary);
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .leader-position {
            color: var(--color-secondary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .leader-bio {
            color: var(--color-gray);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .about-hero h1 {
                font-size: 2rem;
            }

            .content-wrapper h2 {
                font-size: 2rem;
            }

            .leadership-section h2 {
                font-size: 2rem;
            }

            .leadership-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>
