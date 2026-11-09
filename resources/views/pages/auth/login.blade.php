<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.theme')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite('resources/css/login.css')
</head>
<body class="auth-page auth-account-page">
    <header class="auth-account-header">
       
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            <a href="{{ route('home') }}" class="button" aria-label="Volver al inicio">
      <div class="button-box">
        <span class="button-elem">
          <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
            ></path>
          </svg>
        </span>
        <span class="button-elem">
          <svg viewBox="0 0 46 40">
            <path
              d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
            ></path>
          </svg>
        </span>
      </div>
    </a>
        </a>
        <a class="auth-account-brand" aria-label="MusikEventos, inicio">
            <img src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
            <span>Musik<span>Eventos</span></span>
        </a>
        
    </header>

    <main class="auth-account-layout">
        <aside class="auth-account-visual">
            <img src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales en un escenario">
            <div class="auth-account-visual__content">
                <span><i class="fa-solid fa-music" aria-hidden="true"></i> VIVE LA MÚSICA</span>
                <h1>Tu próximo<br>evento empieza aquí.</h1>
                <p>Encuentra el sonido perfecto para tus momentos especiales y vuelve a disfrutar de tus artistas favoritos.</p>
                <div class="auth-account-visual__note">
                    <i class="fa-solid fa-music" aria-hidden="true"></i>
                    <span>Un buen comienzo para grandes celebraciones.</span>
                </div>
            </div>
        </aside>

        <section class="auth-account-card" aria-labelledby="auth-account-title">
            <div class="auth-account-card__heading">
                <span class="auth-account-eyebrow">QUÉ BUENO TENERTE DE VUELTA</span>
                <h2 id="auth-account-title">Inicia sesión</h2>
                <p>Ingresa a tu cuenta para continuar con tus eventos.</p>
            </div>

            @if (session('status'))
                <p class="auth-account-status" role="status">{{ session('status') }}</p>
            @endif

            <form class="auth-account-form" method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="auth-account-field">
                    <label for="email">Correo electrónico</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus autocomplete="email" @error('email') aria-describedby="email-error" @enderror>
                    </div>
                    @error('email')
                        <span class="auth-account-error" id="email-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="password">Contraseña</label>
                    <div class="auth-account-input">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i>
                        <input id="password" name="password" type="password" placeholder="Tu contraseña" required autocomplete="current-password" @error('password') aria-describedby="password-error" @enderror>
                    </div>
                    @error('password')
                        <span class="auth-account-error" id="password-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-options">
                    <label class="auth-account-remember">
                        <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
                        <span>Mantener sesión activa</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button class="auth-account-submit" type="submit" data-test="login-button">
                    <span>Entrar a mi cuenta</span>
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-account-switch">
                ¿Todavía no tienes cuenta?
                <a href="{{ route('register') }}">Regístrate aquí</a>
            </p>
        </section>
    </main>
</body>
</html>
