<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Gestión de Contenidos - ISTS Admin" ?></title>
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
                    <li><a href="<?= APP_URL ?>/dashboard">📊 Dashboard</a></li>
                    <li><a href="<?= APP_URL ?>/contents/create" class="active">📝 Contenidos</a></li>
                    <li><a href="<?= APP_URL ?>/news/create">📰 Noticias</a></li>
                    <li><a href="<?= APP_URL ?>/users">👥 Usuarios</a></li>
                    <li><a href="<?= APP_URL ?>/settings">⚙️ Configuración</a></li>
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
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>📝 Gestión de Contenidos</h1>
                    <p>Administra los contenidos del sitio.</p>
                    <a href="<?= APP_URL ?>/contents/create" class="btn btn-primary">Crear Contenido</a>
                </div>

                <?php if (isset($_GET["success"])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars(
                        $_GET["success"],
                    ) ?></div>
                <?php endif; ?>
                <?php if (isset($_GET["error"])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars(
                        $_GET["error"],
                    ) ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Categoría</th>
                                <th>Estado</th>
                                <th>Vistas</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars(
                                        $item["id"],
                                    ) ?></td>
                                    <td><?= htmlspecialchars(
                                        $item["title"],
                                    ) ?></td>
                                    <td><?= htmlspecialchars(
                                        $item["category"] ?? "N/A",
                                    ) ?></td>
                                    <td><span class="badge status-<?= htmlspecialchars(
                                        $item["status"],
                                    ) ?>"><?= htmlspecialchars(
    $item["status"],
) ?></span></td>
                                    <td><?= htmlspecialchars(
                                        $item["views"],
                                    ) ?></td>
                                    <td><?= htmlspecialchars(
                                        date(
                                            "d/m/Y",
                                            strtotime($item["created_at"]),
                                        ),
                                    ) ?></td>
                                    <td class="actions">
                                        <a href="<?= APP_URL ?>/contents/edit/<?= (int) $item[
    "id"
] ?>" class="btn btn-sm btn-secondary">Editar</a>
                                        <form action="<?= APP_URL ?>/contents/delete/<?= (int) $item[
    "id"
] ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contenido?');">
                                            <input type="hidden" name="csrf_token" value="<?= Security::generateCSRFToken() ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <?php if ($totalPages > 1): ?>
                    <nav class="pagination">
                        <ul>
                            <?php if ($currentPage > 1): ?>
                                <li><a href="?page=<?= $currentPage -
                                    1 ?>">Anterior</a></li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li>
                                    <a href="?page=<?= $i ?>" class="<?= $i ==
$currentPage
    ? "active"
    : "" ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li><a href="?page=<?= $currentPage +
                                    1 ?>">Siguiente</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer Administrativo -->
    <footer class="admin-footer">
        <div class="admin-footer-content">
            <p>&copy; <?= date(
                "Y",
            ) ?> Instituto Superior Tecnológico Sucúa - Panel Administrativo</p>
            <div class="admin-footer-links">
                <a href="/" target="_blank">🌐 Ver Sitio Web</a>
                <a href="/admin/help">❓ Ayuda</a>
                <a href="/admin/logs">📋 Logs del Sistema</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?= APP_URL ?>/public/js/admin.js"></script>
</body>
</html>
