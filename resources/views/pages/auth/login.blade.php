<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | MusikEventos</title>
    @vite('resources/css/style.css')
    <style>
        .auth-page { min-height: 100vh; background: #f1eded; color: #000; font-family: "Roboto", sans-serif; }
        .auth-header { min-height: 86px; display: flex; align-items: center; justify-content: center; gap: 18px; padding: 14px 24px; background: #000; }
        .auth-brand { width: 86px; height: auto; }
        .auth-header h1 { margin: 0; color: #c9a24a; font-size: clamp(23px, 3vw, 38px); text-align: center; }
        .auth-layout { min-height: calc(100vh - 86px); display: grid; grid-template-columns: minmax(260px, 30%) 1fr; }
        .auth-image { min-height: 650px; background: #222; }
        .auth-image img { width: 100%; height: 100%; display: block; object-fit: cover; filter: grayscale(100%); }
        .auth-content { display: flex; align-items: center; justify-content: center; padding: 48px 30px; }
        .auth-panel { width: min(100%, 540px); padding: 12px 38px 30px; }
        .auth-title { display: table; margin: 0 auto 35px; padding: 0 12px 14px; border-bottom: 2px solid #c9a24a; color: #000; font-size: 27px; text-align: center; }
        .auth-subtitle { max-width: 480px; margin: -18px auto 28px; color: #5f5b58; font-size: 14px; text-align: center; }
        .auth-field { display: grid; grid-template-columns: 150px 1fr; align-items: center; gap: 18px; padding: 13px 18px; border-bottom: 2px solid #c9a24a; }
        .auth-field label { color: #000; font-size: 16px; font-weight: 700; }
        .auth-field input { width: 100%; min-width: 0; padding: 11px 12px; border: 0; border-radius: 5px; background: #fff; color: #000; font: inherit; }
        .auth-field input:focus { outline: 2px solid #c9a24a; outline-offset: 1px; }
        .auth-error { grid-column: 2; margin-top: -8px; color: #a52d24; font-size: 12px; }
        .auth-options { display: flex; justify-content: space-between; gap: 12px; margin: 22px 18px 0; color: #555; font-size: 13px; }
        .auth-options a, .auth-register a { color: #85651e; font-weight: 700; text-decoration: none; }
        .auth-options a:hover, .auth-register a:hover { text-decoration: underline; }
        .auth-submit { display: block; margin: 28px auto 0; padding: 12px 28px; border: 0; border-radius: 7px; background: #c9a24a; color: #000; font-size: 16px; font-weight: 700; cursor: pointer; }
        .auth-submit:hover { background: #a98436; }
        .auth-register { margin: 25px 0 0; color: #555; text-align: center; font-size: 14px; }
        .auth-status { margin-bottom: 16px; color: #47703e; text-align: center; font-size: 13px; }
        @media (max-width: 720px) {
            .auth-header { min-height: 72px; gap: 10px; padding: 12px 14px; }
            .auth-brand { width: 62px; }
            .auth-layout { display: block; min-height: calc(100vh - 72px); }
            .auth-image { display: none; }
            .auth-content { min-height: calc(100vh - 72px); padding: 35px 14px; }
            .auth-panel { padding: 8px 0 25px; }
            .auth-field { grid-template-columns: 1fr; gap: 8px; padding: 13px 4px; }
            .auth-error { grid-column: 1; }
            .auth-options { margin-left: 4px; margin-right: 4px; flex-wrap: wrap; }
        }
    </style>
</head>
<body class="auth-page">
    <!-- Encabezado de autenticación con la identidad de MusikEventos. -->
    <header class="auth-header">
        <a href="{{ route('home') }}"><img class="auth-brand" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="MusikEventos"></a>
        <h1>INICIAR SESIÓN</h1>
    </header>

    <div class="auth-layout">
        <aside class="auth-image">
            <img src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales">
        </aside>
        <!-- Imagen decorativa y formulario de credenciales. -->
        <main class="auth-content">
            <section class="auth-panel">
                <h2 class="auth-title">Accede a tu cuenta</h2>
                <p class="auth-subtitle">Inicia sesión para reservar eventos y consultar tus grupos musicales.</p>

        @if (session('status')) <p class="auth-status">{{ session('status') }}</p> @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="auth-field">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus autocomplete="email">
                @error('email') <span class="auth-error">{{ $message }}</span> @enderror
            </div>
            <div class="auth-field">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" placeholder="Tu contraseña" required autocomplete="current-password">
                @error('password') <span class="auth-error">{{ $message }}</span> @enderror
            </div>
            <div class="auth-options">
                <label><input type="checkbox" name="remember"> Mantener sesión activa</label>
                @if (Route::has('password.request')) <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a> @endif
            </div>
            <button class="auth-submit" type="submit" data-test="login-button">Iniciar sesión</button>
        </form>

                <p class="auth-register">¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
            </section>
        </main>
    </div>
</body>
</html>
