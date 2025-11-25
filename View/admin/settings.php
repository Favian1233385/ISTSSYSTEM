<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Configuración - ISTS Admin" ?></title>
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
                    <li><a href="<?= APP_URL ?>/admin/users">👥 Usuarios</a></li>
                    <li><a href="<?= APP_URL ?>/admin/settings" class="active">⚙️ Configuración</a></li>
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
                    <h1>⚙️ Configuración del Sistema</h1>
                    <p>Ajusta la configuración general del sitio web y del panel de administración.</p>
                </div>

                <div class="settings-form-container">
                    <form action="<?= APP_URL ?>/admin/settings/update" method="POST" class="settings-form">
                        <div class="form-card">
                            <h2>Configuración General</h2>

                            <div class="form-group">
                                <label for="site_name">Nombre del Sitio</label>
                                <input type="text" id="site_name" name="settings[site_name]" value="<?= $settings[
                                    "site_name"
                                ] ?? "" ?>" class="form-control">
                                <p class="form-text">El título principal que aparece en la pestaña del navegador.</p>
                            </div>

                            <div class="form-group">
                                <label for="site_description">Descripción del Sitio</label>
                                <textarea id="site_description" name="settings[site_description]" class="form-control" rows="3"><?= $settings[
                                    "site_description"
                                ] ?? "" ?></textarea>
                                <p class="form-text">Una breve descripción para los motores de búsqueda.</p>
                            </div>

                            <div class="form-group">
                                <label for="maintenance_mode">Modo Mantenimiento</label>
                                <select id="maintenance_mode" name="settings[maintenance_mode]" class="form-control">
                                    <option value="0" <?= isset(
                                        $settings["maintenance_mode"],
                                    ) && $settings["maintenance_mode"] == 0
                                        ? "selected"
                                        : "" ?>>Desactivado</option>
                                    <option value="1" <?= isset(
                                        $settings["maintenance_mode"],
                                    ) && $settings["maintenance_mode"] == 1
                                        ? "selected"
                                        : "" ?>>Activado</option>
                                </select>
                                <p class="form-text">Si está activado, solo los administradores podrán ver el sitio.</p>
                            </div>
                        </div>

                        <div class="form-card">
                            <h2>Configuración de Contacto</h2>

                            <div class="form-group">
                                <label for="contact_email">Email de Contacto</label>
                                <input type="email" id="contact_email" name="settings[contact_email]" value="<?= $settings[
                                    "contact_email"
                                ] ?? "" ?>" class="form-control">
                                <p class="form-text">El email donde se recibirán los mensajes del formulario de contacto.</p>
                            </div>

                            <div class="form-group">
                                <label for="contact_phone">Teléfono de Contacto</label>
                                <input type="text" id="contact_phone" name="settings[contact_phone]" value="<?= $settings[
                                    "contact_phone"
                                ] ?? "" ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="contact_address">Dirección</label>
                                <input type="text" id="contact_address" name="settings[contact_address]" value="<?= $settings[
                                    "contact_address"
                                ] ?? "" ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
