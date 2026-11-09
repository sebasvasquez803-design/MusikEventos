<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.theme')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ request('tipo') === 'representante' ? 'Registro de representante legal' : 'Crear cuenta' }} | MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite('resources/css/login.css')
</head>
<body class="auth-page auth-account-page auth-account-page--register">
    <header class="auth-account-header">
        <a href="{{ route('home') }}" class="auth-account-header__back">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            <span>Volver al inicio</span>
        </a>
        <a class="auth-account-brand" href="{{ route('home') }}" aria-label="MusikEventos, inicio">
            <img src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
            <span>Musik<span>Eventos</span></span>
        </a>
        <span class="auth-account-header__context">ÚNETE A LA ESCENA</span>
    </header>

    <main class="auth-account-layout">
        <aside class="auth-account-visual">
            <img src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales en un escenario">
            <div class="auth-account-visual__content">
                <span><i class="fa-solid fa-sparkles" aria-hidden="true"></i> HAZ PARTE DE MUSIKEVENTOS</span>
                <h1>La música<br>nos conecta.</h1>
                <p>Crea tu cuenta para descubrir artistas, organizar tus eventos y vivir cada celebración a tu manera.</p>
                <div class="auth-account-visual__note">
                    <i class="fa-solid fa-music" aria-hidden="true"></i>
                    <span>Tu próxima historia también puede empezar con música.</span>
                </div>
            </div>
        </aside>

        <section class="auth-account-card" aria-labelledby="auth-account-title">
            <div class="auth-account-card__heading">
                <span class="auth-account-eyebrow">UN PRIMER PASO PARA CELEBRAR</span>
                <h2 id="auth-account-title">Crea tu cuenta</h2>
                <p>Regístrate y encuentra la música para tu próximo evento.</p>
            </div>

            <form class="auth-account-form" method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="auth-account-field">
                    <label for="name">Nombre completo</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-user" aria-hidden="true"></i>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Tu nombre" required autofocus autocomplete="name" @error('name') aria-describedby="name-error" @enderror>
                    </div>
                    @error('name')
                        <span class="auth-account-error" id="name-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="email">Correo electrónico</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autocomplete="email" @error('email') aria-describedby="email-error" @enderror>
                    </div>
                    @error('email')
                        <span class="auth-account-error" id="email-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="password">Contraseña</label>
                    <div class="auth-account-input">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i>
                        <input id="password" name="password" type="password" placeholder="Crea una contraseña segura" required autocomplete="new-password" @error('password') aria-describedby="password-error" @enderror>
                    </div>
                    @error('password')
                        <span class="auth-account-error" id="password-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <div class="auth-account-input">
                        <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Escríbela de nuevo" required autocomplete="new-password">
                    </div>
                </div>

                <button class="auth-account-submit" type="submit" data-test="register-user-button">
                    <span>Crear mi cuenta</span>
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-account-switch">
                ¿Ya tienes una cuenta?
                <a href="{{ request('tipo') === 'representante' ? route('sesion.rep.leg') : route('login') }}">Inicia sesión</a>
            </p>
        </section>
    </main>
</body>
</html>
