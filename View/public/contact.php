<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contacta con el Instituto Superior Tecnológico Sudamericano - Información de contacto y formulario">
    <title><?= $title ?? 'Contacto - ISTS' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .contact-hero {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: var(--color-white);
            padding: 4rem 0;
            text-align: center;
        }
        
        .contact-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-family: var(--font-primary);
        }
        
        .contact-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
        }
        
        .contact-section {
            padding: 4rem 0;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            margin-bottom: 4rem;
        }
        
        .contact-info {
            background-color: var(--color-white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .contact-info h3 {
            color: var(--color-primary);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: var(--color-light);
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .contact-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .contact-icon {
            font-size: 1.5rem;
            color: var(--color-primary);
            width: 40px;
            text-align: center;
        }
        
        .contact-details h4 {
            color: var(--color-dark);
            margin-bottom: 0.25rem;
        }
        
        .contact-details p {
            color: var(--color-gray);
            margin: 0;
        }
        
        .contact-form {
            background-color: var(--color-white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--color-dark);
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--color-border);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(165, 28, 48, 0.1);
        }
        
        .form-control.error {
            border-color: var(--color-danger);
        }
        
        .form-control.success {
            border-color: var(--color-success);
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }
        
        .btn-submit {
            background-color: var(--color-primary);
            color: var(--color-white);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
        }
        
        .btn-submit:hover {
            background-color: var(--color-secondary);
            transform: translateY(-2px);
        }
        
        .btn-submit:disabled {
            background-color: var(--color-gray);
            cursor: not-allowed;
            transform: none;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .alert-error {
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid #dc3545;
            color: #dc3545;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            color: #28a745;
        }
        
        .field-error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .map-section {
            background-color: var(--color-light);
            padding: 4rem 0;
        }
        
        .map-container {
            background-color: var(--color-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .map-placeholder {
            height: 400px;
            background: linear-gradient(45deg, #f0f0f0 25%, transparent 25%), 
                        linear-gradient(-45deg, #f0f0f0 25%, transparent 25%), 
                        linear-gradient(45deg, transparent 75%, #f0f0f0 75%), 
                        linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-gray);
            font-size: 1.25rem;
        }
        
        .hours-section {
            background-color: var(--color-white);
            padding: 2rem;
            border-radius: 12px;
            margin-top: 2rem;
        }
        
        .hours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .hours-item {
            text-align: center;
            padding: 1rem;
            background-color: var(--color-light);
            border-radius: 8px;
        }
        
        .hours-item h4 {
            color: var(--color-primary);
            margin-bottom: 0.5rem;
        }
        
        .hours-item p {
            color: var(--color-gray);
            margin: 0;
        }
        
        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .contact-hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include 'app/views/public/header.php'; ?>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1>Contáctanos</h1>
            <p>Estamos aquí para ayudarte. Envíanos un mensaje y te responderemos pronto.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info">
                    <h3>Información de Contacto</h3>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h4>Dirección</h4>
                            <p>Av. Principal 123, Quito - Ecuador</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-details">
                            <h4>Teléfono</h4>
                            <p>(02) 2345-678</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p>info@ists.edu.ec</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🕐</div>
                        <div class="contact-details">
                            <h4>Horarios</h4>
                            <p>Lun-Vie: 8:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form">
                    <h3>Envíanos un Mensaje</h3>
                    
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

                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-error">
                            <ul style="margin: 0; padding-left: 1rem;">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/contacto" id="contact-form">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Nombre Completo *</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-control" 
                                       required
                                       value="<?= htmlspecialchars($form_data['name'] ?? '') ?>"
                                       placeholder="Tu nombre completo">
                                <div class="field-error" id="name-error"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-control" 
                                       required
                                       value="<?= htmlspecialchars($form_data['email'] ?? '') ?>"
                                       placeholder="tu@email.com">
                                <div class="field-error" id="email-error"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-control"
                                       value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>"
                                       placeholder="(02) 2345-678">
                                <div class="field-error" id="phone-error"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject" class="form-label">Asunto *</label>
                                <select id="subject" name="subject" class="form-control" required>
                                    <option value="">Selecciona un asunto</option>
                                    <option value="Información General" <?= ($form_data['subject'] ?? '') === 'Información General' ? 'selected' : '' ?>>Información General</option>
                                    <option value="Admisión" <?= ($form_data['subject'] ?? '') === 'Admisión' ? 'selected' : '' ?>>Admisión</option>
                                    <option value="Carreras" <?= ($form_data['subject'] ?? '') === 'Carreras' ? 'selected' : '' ?>>Carreras</option>
                                    <option value="Becas" <?= ($form_data['subject'] ?? '') === 'Becas' ? 'selected' : '' ?>>Becas</option>
                                    <option value="Otro" <?= ($form_data['subject'] ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                                </select>
                                <div class="field-error" id="subject-error"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">Mensaje *</label>
                            <textarea id="message" 
                                      name="message" 
                                      class="form-control" 
                                      required
                                      placeholder="Escribe tu mensaje aquí..."><?= htmlspecialchars($form_data['message'] ?? '') ?></textarea>
                            <div class="field-error" id="message-error"></div>
                        </div>
                        
                        <button type="submit" class="btn-submit" id="submit-btn">
                            Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem; color: var(--color-dark);">Nuestra Ubicación</h2>
            <div class="map-container">
                <div class="map-placeholder">
                    🗺️ Mapa interactivo de Google Maps
                    <br><small>Av. Principal 123, Quito - Ecuador</small>
                </div>
            </div>
            
            <div class="hours-section">
                <h3 style="text-align: center; margin-bottom: 2rem; color: var(--color-primary);">Horarios de Atención</h3>
                <div class="hours-grid">
                    <div class="hours-item">
                        <h4>Lunes - Viernes</h4>
                        <p>8:00 AM - 6:00 PM</p>
                    </div>
                    <div class="hours-item">
                        <h4>Sábados</h4>
                        <p>9:00 AM - 1:00 PM</p>
                    </div>
                    <div class="hours-item">
                        <h4>Domingos</h4>
                        <p>Cerrado</p>
                    </div>
                    <div class="hours-item">
                        <h4>Emergencias</h4>
                        <p>24/7 por email</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'app/views/public/footer.php'; ?>

    <script>
        // Form validation
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            clearErrors();
            
            // Get form data
            const formData = new FormData(this);
            const submitBtn = document.getElementById('submit-btn');
            
            // Show loading
            submitBtn.textContent = 'Enviando...';
            submitBtn.disabled = true;
            
            // Validate form
            if (!validateForm()) {
                submitBtn.textContent = 'Enviar Mensaje';
                submitBtn.disabled = false;
                return;
            }
            
            // Submit form
            fetch('/contacto', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                // Reload page to show result
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Error al enviar el mensaje. Intenta nuevamente.');
                submitBtn.textContent = 'Enviar Mensaje';
                submitBtn.disabled = false;
            });
        });
        
        function validateForm() {
            let isValid = true;
            
            // Validate name
            const name = document.getElementById('name').value.trim();
            if (name.length < 3) {
                showFieldError('name', 'El nombre debe tener al menos 3 caracteres');
                isValid = false;
            }
            
            // Validate email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showFieldError('email', 'Email inválido');
                isValid = false;
            }
            
            // Validate subject
            const subject = document.getElementById('subject').value;
            if (!subject) {
                showFieldError('subject', 'Selecciona un asunto');
                isValid = false;
            }
            
            // Validate message
            const message = document.getElementById('message').value.trim();
            if (message.length < 10) {
                showFieldError('message', 'El mensaje debe tener al menos 10 caracteres');
                isValid = false;
            }
            
            return isValid;
        }
        
        function showFieldError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(fieldId + '-error');
            
            field.classList.add('error');
            errorDiv.textContent = message;
        }
        
        function clearErrors() {
            const errorDivs = document.querySelectorAll('.field-error');
            const errorFields = document.querySelectorAll('.form-control.error');
            
            errorDivs.forEach(div => div.textContent = '');
            errorFields.forEach(field => field.classList.remove('error'));
        }
        
        function showError(message) {
            // Create error alert
            const alert = document.createElement('div');
            alert.className = 'alert alert-error';
            alert.textContent = message;
            
            const form = document.getElementById('contact-form');
            form.insertBefore(alert, form.firstChild);
            
            // Remove after 5 seconds
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }
        
        // Real-time validation
        document.getElementById('name').addEventListener('blur', function() {
            if (this.value.trim().length < 3) {
                showFieldError('name', 'El nombre debe tener al menos 3 caracteres');
            } else {
                clearFieldError('name');
            }
        });
        
        document.getElementById('email').addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.value.trim())) {
                showFieldError('email', 'Email inválido');
            } else {
                clearFieldError('email');
            }
        });
        
        document.getElementById('message').addEventListener('blur', function() {
            if (this.value.trim().length < 10) {
                showFieldError('message', 'El mensaje debe tener al menos 10 caracteres');
            } else {
                clearFieldError('message');
            }
        });
        
        function clearFieldError(fieldId) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(fieldId + '-error');
            
            field.classList.remove('error');
            errorDiv.textContent = '';
        }
    </script>
</body>
</html>
