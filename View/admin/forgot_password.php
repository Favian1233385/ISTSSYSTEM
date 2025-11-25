<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Recuperar Contraseña - ISTS Admin' ?></title>
    <link rel="stylesheet" href="/css/admin.css">
    <style>
        .forgot-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #a51c30 0%, #8c1515 100%);
            padding: 2rem;
        }
        
        .forgot-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
        }
        
        .forgot-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .forgot-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .forgot-title {
            font-size: 1.5rem;
            color: var(--admin-dark);
            margin-bottom: 0.5rem;
        }
        
        .forgot-subtitle {
            color: var(--admin-gray);
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--admin-dark);
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--admin-border);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(165, 28, 48, 0.1);
        }
        
        .btn-forgot {
            width: 100%;
            background-color: var(--admin-primary);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-forgot:hover {
            background-color: var(--admin-secondary);
            transform: translateY(-2px);
        }
        
        .forgot-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--admin-border);
        }
        
        .forgot-footer a {
            color: var(--admin-primary);
            text-decoration: none;
        }
        
        .forgot-footer a:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .alert-error {
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid var(--admin-danger);
            color: var(--admin-danger);
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid var(--admin-success);
            color: var(--admin-success);
        }
        
        .info-box {
            background-color: rgba(23, 162, 184, 0.1);
            border: 1px solid var(--admin-info);
            color: var(--admin-info);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .steps {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0;
            position: relative;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--admin-border);
            color: var(--admin-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .step.active .step-number {
            background-color: var(--admin-primary);
            color: white;
        }
        
        .step.completed .step-number {
            background-color: var(--admin-success);
            color: white;
        }
        
        .step-text {
            font-size: 0.8rem;
            text-align: center;
            color: var(--admin-gray);
        }
        
        .step.active .step-text {
            color: var(--admin-primary);
            font-weight: 600;
        }
        
        .step.completed .step-text {
            color: var(--admin-success);
        }
        
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 50%;
            width: 100%;
            height: 2px;
            background-color: var(--admin-border);
            z-index: -1;
        }
        
        .step.completed:not(:last-child)::after {
            background-color: var(--admin-success);
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
                <div class="forgot-icon">🔐</div>
                <h1 class="forgot-title">Recuperar Contraseña</h1>
                <p class="forgot-subtitle">
                    Ingresa tu email y te enviaremos un enlace para restablecer tu contraseña
                </p>
            </div>

            <div class="steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-text">Ingresa Email</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-text">Revisa Email</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-text">Nueva Contraseña</div>
                </div>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <div class="info-box">
                <strong>ℹ️ Información importante:</strong><br>
                • El enlace de recuperación será válido por 1 hora<br>
                • Revisa tu carpeta de spam si no recibes el email<br>
                • Si no tienes acceso al email, contacta al administrador
            </div>

            <form method="POST" action="/auth/forgot-password">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                
                <div class="form-group">
                    <label for="email" class="form-label">Email de la cuenta</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control" 
                           required 
                           autocomplete="email"
                           placeholder="tu@email.com"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <button type="submit" class="btn-forgot" id="submit-btn">
                    Enviar Enlace de Recuperación
                </button>
            </form>

            <div class="forgot-footer">
                <a href="/auth/login">← Volver al Login</a>
                <br><br>
                <a href="/">← Volver al sitio público</a>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus en el campo email
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.focus();
            }
        });

        // Validación en tiempo real
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                this.style.borderColor = 'var(--admin-danger)';
            } else {
                this.style.borderColor = 'var(--admin-border)';
            }
        });

        // Form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const submitBtn = document.getElementById('submit-btn');
            
            if (!email) {
                e.preventDefault();
                alert('Por favor ingresa tu email');
                return;
            }
            
            // Mostrar loading
            submitBtn.textContent = 'Enviando...';
            submitBtn.disabled = true;
            
            // Simular progreso
            setTimeout(() => {
                const steps = document.querySelectorAll('.step');
                steps[0].classList.add('completed');
                steps[1].classList.add('active');
            }, 1000);
        });

        // Validación de email
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Mostrar mensaje de éxito
        if (document.querySelector('.alert-success')) {
            const steps = document.querySelectorAll('.step');
            steps[0].classList.add('completed');
            steps[1].classList.add('active');
        }
    </script>
</body>
</html>
