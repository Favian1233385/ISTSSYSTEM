<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Dashboard - ISTS Admin" ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/style.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/admin.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/harvard-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    <!-- Header Administrativo -->
    <header class="admin-header">
        <div class="admin-header-content">
            <div class="admin-logo">
                <img src="<?= APP_URL ?>/public/assets/images/logo-ists.png" alt="ISTS Logo" class="admin-logo-img">
                <h1>ISTS Admin</h1>
            </div>

            <nav class="admin-nav">
                <ul class="admin-nav-menu">
                    <li><a href="<?= APP_URL ?>/admin/dashboard" class="active">📊 Dashboard</a></li>
                    <li><a href="<?= APP_URL ?>/admin/contents">📝 Contenidos</a></li>
                    <li><a href="<?= APP_URL ?>/admin/news">📰 Noticias</a></li>
                    <li><a href="<?= APP_URL ?>/admin/users">👥 Usuarios</a></li>
                    <li><a href="<?= APP_URL ?>/admin/settings">⚙️ Configuración</a></li>
                </ul>
            </nav>

            <div class="admin-user-menu">
                <div class="user-info">
                    <span class="user-name"><?= $_SESSION["user_email"] ??
                        "Usuario" ?></span>
                    <div class="user-dropdown">
                        <a href="<?= APP_URL ?>/admin/profile">👤 Perfil</a>
                        <a href="<?= APP_URL ?>/auth/change-password">🔒 Cambiar Contraseña</a>
                        <a href="<?= APP_URL ?>/auth/logout">🚪 Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="admin-main">
        <div class="admin-container">
            <!-- Mensajes de éxito/error -->
            <?php if (isset($_GET["success"])): ?>
                <div class="alert alert-success">
                    <span>✅</span>
                    <?= htmlspecialchars($_GET["success"]) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET["error"])): ?>
                <div class="alert alert-error">
                    <span>❌</span>
                    <?= htmlspecialchars($_GET["error"]) ?>
                </div>
            <?php endif; ?>

            <!-- Dashboard Content -->
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>📊 Dashboard Administrativo</h1>
                    <p>Bienvenido al panel de administración del ISTS</p>
                </div>

                <!-- Estadísticas -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📝</div>
                        <div class="stat-content">
                            <h3><?= $stats["total_contents"] ?? 0 ?></h3>
                            <p>Contenidos Totales</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">📰</div>
                        <div class="stat-content">
                            <h3><?= $stats["total_news"] ?? 0 ?></h3>
                            <p>Noticias Totales</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-content">
                            <h3><?= $stats["total_users"] ?? 0 ?></h3>
                            <p>Usuarios Registrados</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">👁️</div>
                        <div class="stat-content">
                            <h3><?= $stats["total_views"] ?? 0 ?></h3>
                            <p>Vistas Totales</p>
                        </div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="quick-actions">
                    <h2>🚀 Acciones Rápidas</h2>
                    <div class="actions-grid">
                        <a href="<?= APP_URL ?>/admin/createContent" class="action-card">
                            <div class="action-icon">📝</div>
                            <h3>Crear Contenido</h3>
                            <p>Agregar nuevo contenido al sitio</p>
                        </a>

                        <a href="<?= APP_URL ?>/admin/createNews" class="action-card">
                            <div class="action-icon">📰</div>
                            <h3>Crear Noticia</h3>
                            <p>Publicar nueva noticia</p>
                        </a>

                        <a href="<?= APP_URL ?>/admin/users" class="action-card">
                            <div class="action-icon">👥</div>
                            <h3>Gestionar Usuarios</h3>
                            <p>Administrar usuarios del sistema</p>
                        </a>

                        <a href="<?= APP_URL ?>/admin/settings" class="action-card">
                            <div class="action-icon">⚙️</div>
                            <h3>Configuración</h3>
                            <p>Ajustar configuración del sistema</p>
                        </a>
                    </div>
                </div>

                <!-- Contenido Reciente -->
                <div class="recent-content">
                    <div class="recent-section">
                        <h2>📝 Contenidos Recientes</h2>
                        <div class="content-list">
                            <?php if (!empty($stats["recent_contents"])): ?>
                                <?php foreach (
                                    $stats["recent_contents"]
                                    as $content
                                ): ?>
                                    <div class="content-item">
                                        <div class="content-info">
                                            <h4><?= htmlspecialchars(
                                                $content["title"],
                                            ) ?></h4>
                                            <p><?= htmlspecialchars(
                                                substr(
                                                    $content["description"],
                                                    0,
                                                    100,
                                                ),
                                            ) ?>...</p>
                                            <span class="content-meta">
                                                <?= date(
                                                    "d/m/Y",
                                                    strtotime(
                                                        $content["created_at"],
                                                    ),
                                                ) ?> •
                                                <?= ucfirst(
                                                    $content["status"],
                                                ) ?>
                                            </span>
                                        </div>
                                        <div class="content-actions">
                                            <a href="<?= APP_URL ?>/contents/edit/<?= $content[
    "id"
] ?>" class="btn btn-sm">✏️ Editar</a>
                                            <a href="<?= APP_URL ?>/contents/delete/<?= $content[
    "id"
] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este contenido?')">🗑️ Eliminar</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="no-content">No hay contenidos recientes</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="recent-section">
                        <h2>📰 Noticias Recientes</h2>
                        <div class="content-list">
                            <?php if (!empty($stats["recent_news"])): ?>
                                <?php foreach (
                                    $stats["recent_news"]
                                    as $news
                                ): ?>
                                    <div class="content-item">
                                        <div class="content-info">
                                            <h4><?= htmlspecialchars(
                                                $news["title"],
                                            ) ?></h4>
                                            <p><?= htmlspecialchars(
                                                substr(
                                                    $news["summary"],
                                                    0,
                                                    100,
                                                ),
                                            ) ?>...</p>
                                            <span class="content-meta">
                                                <?= date(
                                                    "d/m/Y",
                                                    strtotime(
                                                        $news["published_at"],
                                                    ),
                                                ) ?>
                                            </span>
                                        </div>
                                        <div class="content-actions">
                                            <a href="<?= APP_URL ?>/news/edit/<?= $news[
    "id"
] ?>" class="btn btn-sm">✏️ Editar</a>
                                            <a href="<?= APP_URL ?>/news/delete/<?= $news[
    "id"
] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta noticia?')">🗑️ Eliminar</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="no-content">No hay noticias recientes</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Administrativo -->
    <footer class="admin-footer">
        <div class="admin-footer-content">
            <p>&copy; <?= date(
                "Y",
            ) ?> Instituto Superior Tecnológico Sucúa - Panel Administrativo Todos los Derechos reservados F.C</p>
            <div class="admin-footer-links">
                <a href="/" target="_blank">🌐 Ver Sitio Web</a>
                <a href="/admin/help">❓ Ayuda</a>
                <a href="/admin/logs">📋 Logs del Sistema</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?= APP_URL ?>/public/js/admin.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>
