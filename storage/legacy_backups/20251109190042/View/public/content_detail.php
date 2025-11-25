                        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($content['description'] ?? '') ?>">
    <title><?= htmlspecialchars($title ?? 'Contenido - ISTS') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include 'app/views/public/header.php'; ?>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1><?= htmlspecialchars($content['title'] ?? 'Contenido') ?></h1>
        </div>
    </section>

    <!-- Content -->
    <section class="about-content">
        <div class="container">
            <?php if (isset($content) && !empty($content)): ?>
                <div class="content-wrapper">
                    <?php if (!empty($content['image_url'])): ?>
                        <div class="content-image">
                            <img src="<?= APP_URL ?>/public<?= htmlspecialchars($content['image_url']) ?>" alt="<?= htmlspecialchars($content['title']) ?>">
                        </div>
                    <?php endif; ?>
                    <div class="content-body">
                        <?= $content['content'] ?>
                    </div>
                </div>
            <?php else: ?>
                <p>El contenido no está disponible.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'app/views/public/footer.php'; ?>

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

        .about-content {
            padding: 4rem 0;
        }

        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .content-image {
            margin-bottom: 2rem;
            text-align: center;
        }

        .content-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .content-body {
            font-size: 1.1rem;
            line-height: 1.8;
        }
    </style>
</body>
</html>
