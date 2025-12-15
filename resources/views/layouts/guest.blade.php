<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Acceso ISTS Sucúa</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
    <link rel="stylesheet" href="{{ asset('ISTSSYSTEM/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('ISTSSYSTEM/css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('ISTSSYSTEM/css/harvard-exact.css') }}">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #1766a3 0%, #10b981 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-ists-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(23,102,163,0.12);
            padding: 2.5rem 2.2rem 2rem 2.2rem;
            max-width: 370px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-ists-logo {
            margin-bottom: 1.2rem;
        }
        .login-ists-logo img {
            height: 64px;
        }
        .login-ists-title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #1766a3;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .login-ists-desc {
            font-size: 1rem;
            color: #10b981;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .login-ists-form label {
            font-weight: 500;
            color: #1766a3;
        }
        .login-ists-form input[type="email"],
        .login-ists-form input[type="password"] {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid #e0e7ef;
            border-radius: 8px;
            margin-bottom: 1.1rem;
            font-size: 1rem;
            background: #f8fafc;
            transition: border 0.2s;
        }
        .login-ists-form input:focus {
            border-color: #10b981;
            outline: none;
        }
        .login-ists-form .remember {
            display: flex;
            align-items: center;
            margin-bottom: 1.1rem;
        }
        .login-ists-form .remember label {
            margin-left: 0.5rem;
            font-size: 0.97rem;
            color: #1766a3;
        }
        .login-ists-form .login-btn {
            width: 100%;
            background: linear-gradient(90deg, #1766a3 0%, #10b981 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 0.8rem 0;
            font-size: 1.08rem;
            cursor: pointer;
            margin-bottom: 0.7rem;
            transition: background 0.2s;
        }
        .login-ists-form .login-btn:hover {
            background: linear-gradient(90deg, #10b981 0%, #1766a3 100%);
        }
        .login-ists-form .forgot {
            display: block;
            text-align: right;
            color: #10b981;
            font-size: 0.97rem;
            text-decoration: none;
            margin-bottom: 0.5rem;
        }
        .login-ists-form .forgot:hover {
            text-decoration: underline;
        }
        .login-ists-error {
            background: #fee;
            color: #c33;
            border-left: 4px solid #c33;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.98rem;
        }
    </style>
</head>
<body>
    <div class="login-ists-container">
        <div class="login-ists-logo">
            <a href="/">
                <img src="{{ asset('assets/images/logoists.png') }}" alt="Logo ISTS">
            </a>
        </div>
        <div class="login-ists-title">Acceso al Sistema ISTS</div>
        <div class="login-ists-desc">Instituto Superior Tecnológico Sucúa</div>
        {{ $slot }}
    </div>
</body>
</html>
