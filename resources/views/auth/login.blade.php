
<form method="POST" action="{{ route('login') }}" class="login-ists-form" autocomplete="off">
    @csrf

    @if ($errors->any())
        <div class="login-ists-error">
            <ul style="margin:0; padding-left: 1.1em;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <label for="email">Correo electrónico</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="usuario@istsucua.edu.ec" autocomplete="username">

    <label for="password">Contraseña</label>
    <input id="password" type="password" name="password" required placeholder="Ingresa tu contraseña" autocomplete="current-password">

    <div class="remember">
        <input id="remember_me" type="checkbox" name="remember">
        <label for="remember_me">Recordarme</label>
    </div>

    <button type="submit" class="login-btn">Ingresar</button>

    @if (Route::has('password.request'))
        <a class="forgot" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
    @endif
</form>
