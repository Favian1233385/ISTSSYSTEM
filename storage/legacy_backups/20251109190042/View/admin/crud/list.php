<?php
/**
 * Vista genérica para listar registros (CRUD)
 * Utilizada para Usuarios, Contenidos, Noticias, etc.
 */

// Cargar el layout principal del admin
// Esto carga el sidebar, header, etc.
require_once __DIR__ . "/../layout.php";

// Definir las cabeceras de la tabla según el tipo de contenido
$headers = [];
switch ($type) {
    case "users":
        $headers = [
            "ID",
            "Username",
            "Email",
            "Rol",
            "Estado",
            "Último Login",
            "Acciones",
        ];
        break;
    case "contents":
        $headers = [
            "ID",
            "Título",
            "Categoría",
            "Estado",
            "Vistas",
            "Creado",
            "Acciones",
        ];
        break;
    case "news":
        $headers = [
            "ID",
            "Título",
            "Autor",
            "Estado",
            "Vistas",
            "Publicado",
            "Acciones",
        ];
        break;
}
?>

<!-- Contenido principal -->
<div class="admin-content">
    <div class="dashboard-section">
        <div class="section-header">
            <h2><?= htmlspecialchars($title ?? "Gestión") ?></h2>
                                    <?php
                                    $create_link = "";
                                    switch ($type) {
                                        case "users":
                                            $create_link =
                                                "/ISTSSYSTEM/public/index.php?url=users/create";
                                            break;
                                        case "contents":
                                            $create_link =
                                                "/ISTSSYSTEM/public/index.php?url=contents/create";
                                            break;
                                        case "news":
                                            $create_link =
                                                "/ISTSSYSTEM/public/index.php?url=news/create";
                                            break;
                                    }
                                    ?>
                                    <a href="<?= $create_link ?>" class="btn btn-primary">
                                        <span class="icon">➕</span> Crear Nuevo
                                    </a>        </div>

        <?php if (isset($_GET["success"])): ?>
            <div class="alert alert-success"><?= htmlspecialchars(
                $_GET["success"],
            ) ?></div>
        <?php endif; ?>
        <?php if (isset($_GET["error"])): ?>
            <div class="alert alert-error"><?= htmlspecialchars(
                $_GET["error"],
            ) ?></div>
        <?php endif; ?>

        <?php if (empty($items)): ?>
            <div class="alert alert-info">
                No hay elementos para mostrar. ¿Por qué no <a href="/ISTSSYSTEM/public/index.php?url=admin/<?= htmlspecialchars(
                    $type,
                ) ?>/create">creas uno nuevo</a>?
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <?php foreach ($headers as $header): ?>
                                <th><?= $header ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <?php switch ($type): case "users": ?>
                                        <td><?= htmlspecialchars(
                                            $item["id"],
                                        ) ?></td>
                                        <td><?= htmlspecialchars(
                                            $item["username"],
                                        ) ?></td>
                                        <td><?= htmlspecialchars(
                                            $item["email"],
                                        ) ?></td>
                                        <td><span class="badge role-<?= htmlspecialchars(
                                            $item["role"],
                                        ) ?>"><?= htmlspecialchars(
    $item["role"],
) ?></span></td>
                                        <td><span class="badge status-<?= htmlspecialchars(
                                            $item["status"],
                                        ) ?>"><?= htmlspecialchars(
    $item["status"],
) ?></span></td>
                                        <td><?= htmlspecialchars(
                                            $item["last_login"] ?? "Nunca",
                                        ) ?></td>
                                    <?php break;case "contents": ?>
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
                                    <?php break;case "news": ?>
                                        <td><?= htmlspecialchars(
                                            $item["id"],
                                        ) ?></td>
                                        <td><?= htmlspecialchars(
                                            $item["title"],
                                        ) ?></td>
                                        <td><?= htmlspecialchars(
                                            $item["author"] ?? "N/A",
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
                                                strtotime(
                                                    $item["published_at"],
                                                ),
                                            ),
                                        ) ?></td>
                                    <?php break;endswitch; ?>

                                <td class="actions">
                                    <?php
                                    $edit_link = "";
                                    $delete_link = "";
                                    switch ($type) {
                                        case "users":
                                            $edit_link =
                                                "/ISTSSYSTEM/public/index.php?url=users/edit/";
                                            $delete_link =
                                                "/ISTSSYSTEM/public/index.php?url=users/delete/";
                                            break;
                                        case "contents":
                                            $edit_link =
                                                "/ISTSSYSTEM/public/index.php?url=contents/edit/";
                                            $delete_link =
                                                "/ISTSSYSTEM/public/index.php?url=contents/delete/";
                                            break;
                                        case "news":
                                            $edit_link =
                                                "/ISTSSYSTEM/public/index.php?url=news/edit/";
                                            $delete_link =
                                                "/ISTSSYSTEM/public/index.php?url=news/delete/";
                                            break;
                                    }
                                    ?>
                                    <a href="<?= htmlspecialchars(
                                        $edit_link . (int) $item["id"],
                                    ) ?>" class="btn btn-sm btn-secondary">Editar</a>
                                    <form action="<?= htmlspecialchars(
                                        $delete_link . (int) $item["id"],
                                    ) ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este elemento?');">
                                        <?php if (class_exists('Security') && method_exists('Security','generateCSRFToken')): ?>
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCSRFToken()) ?>">
                                        <?php endif; ?>
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

        <?php endif; ?>
    </div>
</div>
