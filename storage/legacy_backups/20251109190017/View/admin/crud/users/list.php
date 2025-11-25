<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Gestión de Usuarios - ISTS Admin" ?></title>
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
                    <li><a href="<?= APP_URL ?>/admin/dashboard">📊 Dashboard</a></li>
                    <li><a href="<?= APP_URL ?>/admin/contents">📝 Contenidos</a></li>
                    <li><a href="<?= APP_URL ?>/admin/news">📰 Noticias</a></li>
                    <li><a href="<?= APP_URL ?>/admin/users" class="active">👥 Usuarios</a></li>
                    <li><a href="<?= APP_URL ?>/admin/settings">⚙️ Configuración</a></li>
                </ul>
            </nav>

            <div class="admin-user-menu">
                <div class="user-info">
                    <span class="user-name"><?= $_SESSION["user_email"] ?? "Usuario" ?></span>
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
                    <h1>👥 Gestión de Usuarios</h1>
                    <p>Administra los usuarios del sistema.</p>
                    <a href="<?= APP_URL ?>/users/create" class="btn btn-primary">Crear Usuario</a>
                </div>

                <?php if (isset($_GET["success"])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($_GET["success"]) ?></div>
                <?php endif; ?>
                <?php if (isset($_GET["error"])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_GET["error"]) ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Último Login</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item["id"]) ?></td>
                                    <td><?= htmlspecialchars($item["username"]) ?></td>
                                    <td><?= htmlspecialchars($item["email"]) ?></td>
                                    <td><span class="badge role-<?= htmlspecialchars($item["role"]) ?>"><?= htmlspecialchars($item["role"]) ?></span></td>
                                    <td><span class="badge status-<?= htmlspecialchars($item["status"]) ?>"><?= htmlspecialchars($item["status"]) ?></span></td>
                                    <td><?= htmlspecialchars($item["last_login"] ?? "Nunca") ?></td>
                                    <td class="actions">
                                        <a href="<?= APP_URL ?>/users/edit/<?= (int) $item["id"] ?>" class="btn btn-sm btn-secondary">Editar</a>
                                        <form action="<?= APP_URL ?>/users/delete/<?= (int) $item["id"] ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
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
                                <li><a href="?page=<?= $currentPage - 1 ?>">Anterior</a></li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li>
                                    <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? "active" : "" ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li><a href="?page=<?= $currentPage + 1 ?>">Siguiente</a></li>
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
            <p>&copy; <?= date("Y") ?> Instituto Superior Tecnológico Sucúa - Panel Administrativo</p>
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
