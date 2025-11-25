<!--<!DOCTYPE html>-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Crear Usuario - ISTS Admin" ?></title>
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
                    <h1>👥 Crear Nuevo Usuario</h1>
                    <p>Completa el formulario para agregar un nuevo usuario al sistema.</p>
                </div>

                <div class="form-container">
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= APP_URL ?>/users/create" class="styled-form">
                        <input type="hidden" name="csrf_token" value="<?= Security::generateCSRFToken() ?>">

                        <div class="form-card">
                            <div class="form-group">
                                <label for="username">Nombre de usuario</label>
                                <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars(
                                    $form_data["username"] ?? "",
                                ) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars(
                                    $form_data["email"] ?? "",
                                ) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Rol</label>
                                <select id="role" name="role" class="form-control">
                                    <option value="user" <?= ($form_data[
                                        "role"
                                    ] ??
                                        "") ===
                                    "user"
                                        ? "selected"
                                        : "" ?>>Usuario</option>
                                    <option value="editor" <?= ($form_data[
                                        "role"
                                    ] ??
                                        "") ===
                                    "editor"
                                        ? "selected"
                                        : "" ?>>Editor</option>
                                    <option value="admin" <?= ($form_data[
                                        "role"
                                    ] ??
                                        "") ===
                                    "admin"
                                        ? "selected"
                                        : "" ?>>Administrador</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Estado</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active" <?= ($form_data[
                                        "status"
                                    ] ??
                                        "") ===
                                    "active"
                                        ? "selected"
                                        : "" ?>>Activo</option>
                                    <option value="inactive" <?= ($form_data[
                                        "status"
                                    ] ??
                                        "") ===
                                    "inactive"
                                        ? "selected"
                                        : "" ?>>Inactivo</option>
                                    <option value="suspended" <?= ($form_data[
                                        "status"
                                    ] ??
                                        "") ===
                                    "suspended"
                                        ? "selected"
                                        : "" ?>>Suspendido</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                            <a href="<?= APP_URL ?>/users" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
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
