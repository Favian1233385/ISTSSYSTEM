<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ISTS System</title>
    <link rel="stylesheet" href="/ISTSSYSTEM/public/css/admin.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-container {
            width: 100%;
            max-width: 420px;
        }
        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-section h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 8px;
        }
        .logo-section p {
            color: #666;
            font-size: 14px;
        }
        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
            line-height: 1.5;
        }
        .alert-error {
            background: #fee;
            color: #c33;
            border-left: 4px solid #c33;
        }
        .alert-success {
            background: #efe;
            color: #3c3;
            border-left: 4px solid #3c3;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }
        .input-wrapper {
            position: relative;
        }
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: #fff;
        }
        .form-group input::placeholder {
            color: #999;
        }
        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .btn:active {
            transform: translateY(0);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .security-notice {
            margin-top: 20px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 6px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        @media (max-width: 480px) {
            .login-box {
                padding: 30px 20px;
            }
            .logo-section h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-section">
                <h2>🔐 Panel Admin</h2>
                <p>Sistema de Gestión ISTS</p>
            </div>

            <?php if (!empty($_GET["error"])): ?>
                <div class="alert alert-error">
                    ⚠️ <?= htmlspecialchars($_GET["error"]) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_GET["success"])): ?>
                <div class="alert alert-success">
                    ✓ <?= htmlspecialchars($_GET["success"]) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    ⚠️ <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/ISTSSYSTEM/public/index.php?url=auth/auth">
                <input type="hidden" name="csrf_token" value="<?= Security::generateCSRFToken() ?>">
                <div class="form-group">
                    <label for="email">📧 Correo Electrónico</label>
                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="admin@ejemplo.com"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">🔒 Contraseña</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                    </div>
                </div>

                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>

            <a href="/ISTSSYSTEM/" class="back-link">
                ← Volver al sitio principal
            </a>

            <div class="security-notice">
                🛡️ Acceso restringido solo para administradores
            </div>
        </div>
    </div>
</body>
</html>
