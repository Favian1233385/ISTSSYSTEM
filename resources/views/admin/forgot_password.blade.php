@extends('layouts.auth')

@section('content')
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

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="info-box">
            <strong>ℹ️ Información importante:</strong><br>
            • El enlace de recuperación será válido por 1 hora<br>
            • Revisa tu carpeta de spam si no recibes el email<br>
            • Si no tienes acceso al email, contacta al administrador
        </div>

        <form method="POST" action="{{ route('auth.forgot-password') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email de la cuenta</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       class="form-control" 
                       required 
                       autocomplete="email"
                       placeholder="tu@email.com"
                       value="{{ old('email') }}">
            </div>

            <button type="submit" class="btn-forgot" id="submit-btn">
                Enviar Enlace de Recuperación
            </button>
        </form>

        <div class="forgot-footer">
            <a href="{{ route('auth.login') }}">← Volver al Login</a>
            <br><br>
            <a href="{{ url('/') }}">← Volver al sitio público</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.focus();
        }
    });

    document.getElementById('email').addEventListener('input', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email && !emailRegex.test(email)) {
            this.style.borderColor = 'var(--admin-danger)';
        } else {
            this.style.borderColor = 'var(--admin-border)';
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const submitBtn = document.getElementById('submit-btn');

        if (!email) {
            e.preventDefault();
            alert('Por favor ingresa tu email');
            return;
        }

        submitBtn.textContent = 'Enviando...';
        submitBtn.disabled = true;

        setTimeout(() => {
            const steps = document.querySelectorAll('.step');
            steps[0].classList.add('completed');
            steps[1].classList.add('active');
        }, 1000);
    });

    if (document.querySelector('.alert-success')) {
        const steps = document.querySelectorAll('.step');
        steps[0].classList.add('completed');
        steps[1].classList.add('active');
    }
</script>
@endpush