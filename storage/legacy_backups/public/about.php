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
