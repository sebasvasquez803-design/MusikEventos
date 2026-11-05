<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Artista solista</title>

    @vite('resources/css/login.css')
</head>

<body class="auth-page auth-artist-page">

<header class="auth-header">
  <a href="{{ route('iniciar.rep.leg') }}" class="button auth-back-button" aria-label="Volver al inicio de sesión">
      <div class="button-box">
        <span class="button-elem">
          <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
            <path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
          </svg>
        </span>
      </div>
    </a>

    <a class="auth-brand-link" href="{{ route('iniciar.rep.leg') }}" aria-label="MusikEventos, inicio de sesión">
        <img class="auth-brand" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
        <span>Musik<span>Eventos</span></span>
    </a>
    <span class="auth-header-context">ÚNETE A LA ESCENA</span>
</header>

<div class="auth-layout">
    <aside class="auth-image auth-artist-image">
        <img src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales en un escenario">
        <div class="auth-artist-image__content">
            <span><i class="fa-solid fa-sparkles" aria-hidden="true"></i> TU TALENTO, TU ESPACIO</span>
            <h1>El escenario<br>también es tuyo.</h1>
            <p>Crea tu perfil de artista solista y conecta con nuevas oportunidades para compartir tu música.</p>
        </div>
    </aside>

    <main class="auth-content">
        <section class="auth-panel">
            <div class="auth-artist-heading">
                <span class="auth-artist-heading__eyebrow">REGISTRO DE ARTISTA</span>
                <h2 class="auth-title">Crea tu cuenta</h2>
                <p class="auth-subtitle">Unos datos y estarás más cerca de tu próximo escenario.</p>
            </div>

            <form class="auth-artist-form" method="POST" action="{{ route('register.artista') }}">
                @csrf
                <input type="hidden" name="tipo_persona" value="2">

                <div class="auth-field">
                    <label for="name">Nombre completo</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Ejemplo: Valentina Pérez" required autocomplete="name">
                    @error('name') <span class="auth-error">{{ $message }}</span> @enderror
                </div>

                <div class="auth-field">
                    <label for="email">Correo electrónico</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="tu@correo.com" required autocomplete="email">
                    @error('email') <span class="auth-error">{{ $message }}</span> @enderror
                </div>

                <div class="auth-field">
                    <label for="password">Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="Crea una contraseña segura" required autocomplete="new-password">
                    @error('password') <span class="auth-error">{{ $message }}</span> @enderror
                </div>

                <div class="auth-field">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Escríbela de nuevo" required autocomplete="new-password">
                </div>

                <button class="auth-submit" type="submit">
                    <span>Crear cuenta de artista</span>
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-register">¿Ya tienes cuenta? <a href="{{ route('iniciar.rep.leg') }}">Inicia sesión</a></p>
        </section>
    </main>
</div>

</body>
</html>
