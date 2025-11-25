<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Cambiar Contraseña - ISTS Admin' ?></title>
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
                <li>
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
                <h1>Cambiar Contraseña</h1>
            </div>

            <div class="header-right">
                <a href="/admin/dashboard" class="btn btn-secondary">
                    ← Volver al Dashboard
                </a>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Cambiar Contraseña</h2>
                    <p>Actualiza tu contraseña para mantener la seguridad de tu cuenta</p>
                </div>

                <div style="padding: 2rem;">
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-error" style="margin-bottom: 1.5rem;">
                            <ul style="margin: 0; padding-left: 1rem;">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/auth/change-password" style="max-width: 500px;">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        
                        <div class="form-group">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <div class="password-toggle">
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password" 
                                       class="form-control" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Ingresa tu contraseña actual">
                                <button type="button" class="password-toggle-btn" onclick="togglePassword('current_password')">
                                    👁️
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <div class="password-toggle">
                                <input type="password" 
                                       id="new_password" 
                                       name="new_password" 
                                       class="form-control" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Ingresa tu nueva contraseña"
                                       minlength="8">
                                <button type="button" class="password-toggle-btn" onclick="togglePassword('new_password')">
                                    👁️
                                </button>
                            </div>
                            <small style="color: var(--admin-gray); font-size: 0.875rem;">
                                Mínimo 8 caracteres, incluye letras, números y símbolos
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                            <div class="password-toggle">
                                <input type="password" 
                                       id="confirm_password" 
                                       name="confirm_password" 
                                       class="form-control" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Confirma tu nueva contraseña">
                                <button type="button" class="password-toggle-btn" onclick="togglePassword('confirm_password')">
                                    👁️
                                </button>
                            </div>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="password-strength" style="margin-bottom: 1.5rem;">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strength-fill"></div>
                            </div>
                            <div class="strength-text" id="strength-text">Ingresa una contraseña</div>
                        </div>

                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" class="btn btn-primary">
                                Cambiar Contraseña
                            </button>
                            <a href="/admin/dashboard" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleBtn = passwordInput.parentNode.querySelector('.password-toggle-btn');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁️';
            }
        }

        // Password strength checker
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');
            
            let strength = 0;
            let strengthLabel = '';
            let strengthColor = '';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            switch (strength) {
                case 0:
                case 1:
                    strengthLabel = 'Muy débil';
                    strengthColor = '#dc3545';
                    break;
                case 2:
                    strengthLabel = 'Débil';
                    strengthColor = '#fd7e14';
                    break;
                case 3:
                    strengthLabel = 'Regular';
                    strengthColor = '#ffc107';
                    break;
                case 4:
                    strengthLabel = 'Fuerte';
                    strengthColor = '#20c997';
                    break;
                case 5:
                    strengthLabel = 'Muy fuerte';
                    strengthColor = '#28a745';
                    break;
            }
            
            strengthFill.style.width = (strength * 20) + '%';
            strengthFill.style.backgroundColor = strengthColor;
            strengthText.textContent = strengthLabel;
            strengthText.style.color = strengthColor;
        });

        // Confirm password validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && newPassword !== confirmPassword) {
                this.style.borderColor = 'var(--admin-danger)';
                this.setCustomValidity('Las contraseñas no coinciden');
            } else {
                this.style.borderColor = 'var(--admin-border)';
                this.setCustomValidity('');
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
                return;
            }
            
            if (newPassword.length < 8) {
                e.preventDefault();
                alert('La nueva contraseña debe tener al menos 8 caracteres');
                return;
            }
        });

        // Sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });
    </script>

    <style>
        .password-toggle {
            position: relative;
        }
        
        .password-toggle input {
            padding-right: 3rem;
        }
        
        .password-toggle-btn {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--admin-gray);
            font-size: 1.2rem;
        }
        
        .password-strength {
            margin-top: 0.5rem;
        }
        
        .strength-bar {
            height: 4px;
            background-color: var(--admin-border);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }
        
        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .strength-text {
            font-size: 0.875rem;
            font-weight: 600;
        }
    </style>
</body>
</html>
