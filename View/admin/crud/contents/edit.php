<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Editar Contenido - ISTS Admin" ?></title>
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
                    <li><a href="<?= APP_URL ?>/admin/contents" class="active">📝 Contenidos</a></li>
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
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>📝 Editar Contenido</h1>
                    <p>Modifica la información del contenido.</p>
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

                    <form method="POST" action="<?= APP_URL ?>/contents/edit/<?= htmlspecialchars(
    $item["id"] ?? "",
) ?>" enctype="multipart/form-data" class="styled-form">
                        <input type="hidden" name="csrf_token" value="<?= Security::generateCSRFToken() ?>">

                        <div class="form-card">
                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars(
                                    $item["title"] ?? "",
                                ) ?>">
                            </div>

                            <div class="form-group">
                                <label for="category">Categoría</label>
                                <select id="category" name="category" class="form-control" required>
                                    <option value="">Selecciona una categoría</option>
                                    <option value="carreras" <?= ($item[
                                        "category"
                                    ] ??
                                        "") ===
                                    "carreras"
                                        ? "selected"
                                        : "" ?>>Carreras</option>
                                    <option value="noticias" <?= ($item[
                                        "category"
                                    ] ??
                                        "") ===
                                    "noticias"
                                        ? "selected"
                                        : "" ?>>Noticias</option>
                                    <option value="sobre-nosotros" <?= ($item[
                                        "category"
                                    ] ??
                                        "") ===
                                    "sobre-nosotros"
                                        ? "selected"
                                        : "" ?>>Sobre Nosotros</option>
                                    <option value="investigacion" <?= ($item[
                                        "category"
                                    ] ??
                                        "") ===
                                    "investigacion"
                                        ? "selected"
                                        : "" ?>>Investigación</option>
                                    <option value="eventos" <?= ($item[
                                        "category"
                                    ] ??
                                        "") ===
                                    "eventos"
                                        ? "selected"
                                        : "" ?>>Eventos</option>
                                    <option value="servicios" <?= ($item[
                                        "category"
                                    ] ??
                                        "") ===
                                    "servicios"
                                        ? "selected"
                                        : "" ?>>Servicios</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="3"><?= htmlspecialchars(
                                    $item["description"] ?? "",
                                ) ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Contenido</label>
                                <textarea id="content" name="content" class="form-control" rows="10" required><?= htmlspecialchars(
                                    $item["content"] ?? "",
                                ) ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image_file">Subir Nueva Imagen (dejar en blanco para no cambiar)</label>
                                <input type="file" id="image_file" name="image_file" class="form-control">
                                <?php if (!empty($item["image_url"])): ?>
                                    <div class="current-image">
                                        <p>Imagen actual:</p>
                                        <img src="<?= APP_URL .
                                            htmlspecialchars(
                                                $item["image_url"],
                                            ) ?>" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group" @if($item['parent_id']) style="display: none;" @endif id="content-group">
                                <label for="content">Contenido</label>
                                <textarea name="content" id="content" class="form-control" rows="10">{{ old('content', $item['content']) }}</textarea>
                            </div>
                            <div class="form-group" @if($item['parent_id']) style="display: none;" @endif id="image-group">
                                <label for="image_file">Imagen</label>
                                <input type="file" name="image_file" id="image_file" class="form-control">
                                @if($item['image_url'])
                                    <img src="{{ asset($item['image_url']) }}" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
                                @endif
                            </div>
                                        <option value="published" <?= ($item[
                                            "status"
                                        ] ??
                                            "") ===
                                        "published"
                                            ? "selected"
                                            : "" ?>>Publicado</option>
                                        <option value="archived" <?= ($item[
                                            "status"
                                        ] ??
                                            "") ===
                                        "archived"
                                            ? "selected"
                                            : "" ?>>Archivado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="featured">Destacado</label>
                                    <input type="checkbox" id="featured" name="featured" value="1" <?= $item[
                                        "featured"
                                    ] ?? ""
                                        ? "checked"
                                        : "" ?>>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Actualizar Contenido</button>
                            <a href="<?= APP_URL ?>/admin/contents" class="btn btn-secondary">Cancelar</a>
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
