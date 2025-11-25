<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Contenido - ISTS Admin</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-body">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <img src="/assets/images/logo-ists.png" alt="ISTS" class="sidebar-logo">
            <h2>ISTS Admin</h2>
        </div>

        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="/admin/dashboard">
                        <span class="icon">📊</span>
                        Dashboard
                    </a>
                </li>
                <li class="active">
                    <a href="/admin/contents">
                        <span class="icon">📄</span>
                        Contenidos
                    </a>
                </li>
                <li>
                    <a href="/admin/news">
                        <span class="icon">📰</span>
                        Noticias
                    </a>
                </li>
                <li>
                    <a href="/admin/users">
                        <span class="icon">👥</span>
                        Usuarios
                    </a>
                </li>
                <li>
                    <a href="/admin/settings">
                        <span class="icon">⚙️</span>
                        Configuración
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <?= strtoupper(substr($_SESSION['user_email'] ?? 'U', 0, 1)) ?>
                </div>
                <div class="user-details">
                    <p class="user-name"><?= htmlspecialchars($_SESSION['user_email'] ?? 'Usuario') ?></p>
                    <p class="user-role"><?= htmlspecialchars($_SESSION['user_role'] ?? 'viewer') ?></p>
                </div>
            </div>
            <a href="/auth/logout" class="btn-logout">
                <span class="icon">🚪</span> Cerrar Sesión
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Top Bar -->
        <header class="admin-header">
            <div class="header-left">
                <button id="sidebar-toggle" class="btn-icon">☰</button>
                <h1>Eliminar Contenido</h1>
            </div>

            <div class="header-right">
                <a href="/admin/contents" class="btn btn-secondary">
                    ← Volver a Contenidos
                </a>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Confirmar Eliminación</h2>
                    <p>Esta acción no se puede deshacer</p>
                </div>

                <div style="padding: 2rem;">
                    <div class="delete-warning">
                        <div class="warning-icon">⚠️</div>
                        <h3>¿Estás seguro de eliminar este contenido?</h3>
                        <p>Esta acción eliminará permanentemente el contenido y no se puede deshacer.</p>
                    </div>

                    <div class="content-preview">
                        <h4>Contenido a eliminar:</h4>
                        <div class="preview-card">
                            <h5><?= htmlspecialchars($content['title'] ?? 'Sin título') ?></h5>
                            <p><strong>Categoría:</strong> <?= ucfirst(str_replace('-', ' ', $content['category'] ?? 'Sin categoría')) ?></p>
                            <p><strong>Estado:</strong> 
                                <span class="badge badge-<?= $content['status'] ?? 'draft' ?>">
                                    <?= ucfirst($content['status'] ?? 'draft') ?>
                                </span>
                            </p>
                            <p><strong>Autor:</strong> <?= htmlspecialchars($content['author_name'] ?? 'Admin') ?></p>
                            <p><strong>Vistas:</strong> <?= number_format($content['views'] ?? 0) ?></p>
                            <p><strong>Creado:</strong> <?= date('d/m/Y H:i', strtotime($content['created_at'] ?? '')) ?></p>
                        </div>
                    </div>

                    <form method="POST" action="/admin/contents/delete/<?= $content['id'] ?? '' ?>" id="delete-form">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="confirm_delete" value="1">
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger" id="confirm-btn">
                                🗑️ Eliminar Definitivamente
                            </button>
                            <a href="/admin/contents" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Confirmation before delete
        document.getElementById('delete-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const confirmText = prompt('Para confirmar la eliminación, escribe "ELIMINAR" (en mayúsculas):');
            
            if (confirmText === 'ELIMINAR') {
                // Show loading
                const confirmBtn = document.getElementById('confirm-btn');
                confirmBtn.textContent = 'Eliminando...';
                confirmBtn.disabled = true;
                
                // Submit form
                this.submit();
            } else {
                alert('Eliminación cancelada. Debes escribir "ELIMINAR" para confirmar.');
            }
        });
        
        // Sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });
    </script>

    <style>
        .delete-warning {
            background-color: rgba(220, 53, 69, 0.1);
            border: 2px solid var(--admin-danger);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .warning-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .delete-warning h3 {
            color: var(--admin-danger);
            margin-bottom: 1rem;
        }
        
        .delete-warning p {
            color: var(--admin-gray);
            font-size: 1.1rem;
        }
        
        .content-preview {
            background-color: var(--admin-light);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .content-preview h4 {
            color: var(--admin-dark);
            margin-bottom: 1rem;
        }
        
        .preview-card {
            background-color: var(--admin-white);
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            padding: 1.5rem;
        }
        
        .preview-card h5 {
            color: var(--admin-primary);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
        
        .preview-card p {
            margin-bottom: 0.5rem;
            color: var(--admin-dark);
        }
        
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--admin-border);
        }
        
        .btn-danger {
            background-color: var(--admin-danger);
            color: white;
            border: none;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .btn-danger:disabled {
            background-color: var(--admin-gray);
            cursor: not-allowed;
        }
        
        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
            }
            
            .delete-warning {
                padding: 1.5rem;
            }
        }
    </style>
</body>
</html>
