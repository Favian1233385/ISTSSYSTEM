<?php
// Iniciar sesión si no está iniciada (necesario antes de cualquier output)
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// Permitir rutas públicas del admin (login, auth, logout)
$currentUrl = $_GET['url'] ?? '';
$publicAllowed = ['admin/login', 'admin/auth', 'admin/logout'];
$allowed = false;
foreach ($publicAllowed as $p) {
	if (stripos($currentUrl, $p) === 0) { $allowed = true; break; }
}

// Si la ruta no está permitida y no hay sesión admin, redirigir al login
if (!$allowed) {
	if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
		header('Location: /ISTSSYSTEM/public/index.php?url=admin/login');
		exit;
	}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "ISTS Admin" ?></title>
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
                    <li><a href="<?= APP_URL ?>/contents/create">📝 Contenidos</a></li>
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
                        <a href="/admin/profile">👤 Perfil</a>
                        <a href="/auth/change-password">🔒 Cambiar Contraseña</a>
                        <a href="/ISTSSYSTEM/public/index.php?url=auth/logout">🚪 Cerrar Sesión</a>
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

            <!-- Contenido de la página -->
            <div class="admin-content">
                <?php
                // Incluir el contenido específico de cada página
                $viewFile =
                    __DIR__ .
                    "/admin/" .
                    basename($_SERVER["REQUEST_URI"]) .
                    ".php";
                if (file_exists($viewFile)) {
                    include $viewFile;
                } else {
                    echo '<div class="admin-page-content">';
                    echo "<h2>" .
                        ($title ?? "Página de Administración") .
                        "</h2>";
                    echo "<p>Contenido de la página administrativa.</p>";
                    echo "</div>";
                }
                ?>
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
