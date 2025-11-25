<?php
require_once __DIR__ . "/../layout.php"; ?>

<div class="admin-content">
    <div class="dashboard-section">
        <div class="section-header">
            <h2><?= htmlspecialchars($title ?? "Editar") ?></h2>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php
        $action_link = "";
        $cancel_link = "";

        switch ($type) {
            case "users":
                $action_link =
                    "/ISTSSYSTEM/public/index.php?url=admin/editUser/";
                $cancel_link = "/ISTSSYSTEM/public/index.php?url=admin/users";
                break;
            case "contents":
                $action_link =
                    "/ISTSSYSTEM/public/index.php?url=admin/editContent/";
                $cancel_link =
                    "/ISTSSYSTEM/public/index.php?url=admin/contents";
                break;
            case "news":
                $action_link =
                    "/ISTSSYSTEM/public/index.php?url=admin/editNews/";
                $cancel_link = "/ISTSSYSTEM/public/index.php?url=admin/news";
                break;
        }
        ?>

                <form action="<?= $action_link .
                    htmlspecialchars(
                        $item["id"]??"",
                    ) ?>" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="csrf_token" value="<?= Security::generateCSRFToken() ?>">



                    <?php if ($type === "users"): ?>

                        <div class="form-group">

                            <label for="username">Nombre de usuario</label>

                            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars(
                                $item["username"] ?? "",
                            ) ?>" required>

                        </div>

                        <div class="form-group">

                            <label for="email">Email</label>

                            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars(
                                $item["email"] ?? "",
                            ) ?>" required>

                        </div>

                        <div class="form-group">

                            <label for="password">Nueva Contraseña (dejar en blanco para no cambiar)</label>

                            <input type="password" id="password" name="password" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="role">Rol</label>

                            <select id="role" name="role" class="form-control">

                                <option value="user" <?= ($item["role"] ??
                                    "") ===
                                "user"
                                    ? "selected"
                                    : "" ?>>Usuario</option>

                                <option value="editor" <?= ($item["role"] ??
                                    "") ===
                                "editor"
                                    ? "selected"
                                    : "" ?>>Editor</option>

                                <option value="admin" <?= ($item["role"] ??
                                    "") ===
                                "admin"
                                    ? "selected"
                                    : "" ?>>Administrador</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label for="status">Estado</label>

                            <select id="status" name="status" class="form-control">

                                <option value="active" <?= ($item["status"] ??
                                    "") ===
                                "active"
                                    ? "selected"
                                    : "" ?>>Activo</option>

                                <option value="inactive" <?= ($item["status"] ??
                                    "") ===
                                "inactive"
                                    ? "selected"
                                    : "" ?>>Inactivo</option>

                                <option value="suspended" <?= ($item[
                                    "status"
                                ] ??
                                    "") ===
                                "suspended"
                                    ? "selected"
                                    : "" ?>>Suspendido</option>

                            </select>

                        </div>

                    <?php elseif ($type === "contents"): ?>

                        <div class="form-group">

                            <label for="title">Título</label>

                            <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars(
                                $item["title"] ?? "",
                            ) ?>" required>

                        </div>

                        <div class="form-group">

                            <label for="description">Descripción</label>

                            <textarea id="description" name="description" class="form-control" rows="3" required><?= htmlspecialchars(
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

                            <label for="category">Categoría</label>

                            <input type="text" id="category" name="category" class="form-control" value="<?= htmlspecialchars(
                                $item["category"] ?? "",
                            ) ?>">

                        </div>

                        <div class="form-group">

                            <label for="status">Estado</label>

                            <select id="status" name="status" class="form-control">

                                <option value="draft" <?= ($item["status"] ??
                                    "") ===
                                "draft"
                                    ? "selected"
                                    : "" ?>>Borrador</option>

                                <option value="published" <?= ($item[
                                    "status"
                                ] ??
                                    "") ===
                                "published"
                                    ? "selected"
                                    : "" ?>>Publicado</option>

                            </select>

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

                    <?php elseif ($type === "news"): ?>

                        <div class="form-group">

                            <label for="title">Título</label>

                            <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars(
                                $item["title"] ?? "",
                            ) ?>" required>

                        </div>

                        <div class="form-group">

                            <label for="summary">Resumen</label>

                            <textarea id="summary" name="summary" class="form-control" rows="3" required><?= htmlspecialchars(
                                $item["summary"] ?? "",
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

                    <?php endif; ?>



                    <button type="submit" class="btn btn-primary">Actualizar</button>

                    <a href="<?= $cancel_link ?>" class="btn btn-secondary">Cancelar</a>

                </form>
    </div>
</div>
