@extends('admin.layout')

@section('content')
<div class="admin-content">
    <div class="dashboard-section">
        <div class="section-header">
            <h2>Cambiar Contraseña</h2>
            <p>Actualiza tu contraseña para mantener la seguridad de tu cuenta</p>
        </div>

        <div style="padding: 2rem;">
            @if ($errors->any())
                <div class="alert alert-error" style="margin-bottom: 1.5rem;">
                    <ul style="margin: 0; padding-left: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.change-password') }}" style="max-width: 500px;">
                @csrf

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
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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
</script>
@endpush