<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ request('tipo') === 'representante' ? 'Registro de representante legal' : 'Crear cuenta' }}</title>
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
        .auth-submit { display: block; margin: 28px auto 0; padding: 12px 28px; border: 0; border-radius: 7px; background: #c9a24a; color: #000; font-size: 16px; font-weight: 700; cursor: pointer; }
        .auth-submit:hover { background: #a98436; }
        .auth-register { margin: 25px 0 0; color: #555; text-align: center; font-size: 14px; }
        .auth-register a { color: #85651e; font-weight: 700; text-decoration: none; }
        .auth-register a:hover { text-decoration: underline; }
        @media (max-width: 720px) {
            .auth-header { min-height: 72px; gap: 10px; padding: 12px 14px; }
            .auth-brand { width: 62px; }
            .auth-layout { display: block; min-height: calc(100vh - 72px); }
            .auth-image { display: none; }
            .auth-content { min-height: calc(100vh - 72px); padding: 35px 14px; }
            .auth-panel { padding: 8px 0 25px; }
            .auth-field { grid-template-columns: 1fr; gap: 8px; padding: 13px 4px; }
            .auth-error { grid-column: 1; }
        }

                /* Botón de regreso estilo Uiverse.io */
.button {
  display: block;
  position: relative;
  width: 56px;
  height: 56px;
  margin: 0;
  overflow: hidden;
  outline: none;
  background-color: transparent;
  cursor: pointer;
  border: 0;

}

.button:before,
.button:after {
  content: "";
  position: absolute;
  border-radius: 50%;
  inset: 7px;
}

.button:before {
  border: 4px solid #C9A24A;
  transition: opacity 0.4s cubic-bezier(0.77, 0, 0.175, 1) 80ms,
    transform 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) 80ms;
}

.button:after {
  border: 4px solid #C9A24A;
  transform: scale(1.3);
  transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
    transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  opacity: 0;
}

.button:hover:before,
.button:focus:before {
  opacity: 0;
  transform: scale(0.7);
  transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
    transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.button:hover:after,
.button:focus:after {
  opacity: 1;
  transform: scale(1);
  transition: opacity 0.4s cubic-bezier(0.77, 0, 0.175, 1) 80ms,
    transform 0.5s cubic-bezier(0.455, 0.03, 0.515, 0.955) 80ms;
}

.button-box {
  display: flex;
  position: absolute;
  top: 0;
  left: 0;
}

.button-elem {
  display: block;
  width: 20px;
  height: 20px;
  margin: 17px 18px 0 18px;
  transform: rotate(180deg);
  fill: #f0eeef;
}

.button:hover .button-box,
.button:focus .button-box {
  transition: 0.4s;
  transform: translateX(-56px);
}

    </style>
</head>
<body class="auth-page">
    <!-- Encabezado de autenticación con la identidad de MusikEventos. -->
    <header class="auth-header">
        <a href="{{ route('login') }}" class="button" aria-label="Volver al inicio">
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

        <h1>{{ request('tipo') === 'representante' ? 'REPRESENTANTE LEGAL' : 'REGISTRO' }}
        </h1>
     <img class="auth-brand" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="MusikEventos"></a>
    </header>

    </header>

    <div class="auth-layout">
        <aside class="auth-image">
            <img src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales">
        </aside>
        <!-- Imagen lateral y formulario de creación de cuenta. -->
        <main class="auth-content">
            <section class="auth-panel">
                <h2 class="auth-title">{{ request('tipo') === 'representante' ? 'Registrar representante legal' : 'Crear una cuenta' }}</h2>
                <p class="auth-subtitle">{{ request('tipo') === 'representante' ? 'Crea tu cuenta para acceder al formulario de currículo.' : 'Regístrate para reservar tus grupos musicales favoritos.' }}</p>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="auth-field">
                <label for="name">Nombre completo</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Tu nombre" required autofocus autocomplete="name">
                @error('name') <span class="auth-error">{{ $message }}</span> @enderror
            </div>
            <div class="auth-field">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autocomplete="email">
                @error('email') <span class="auth-error">{{ $message }}</span> @enderror
            </div>
            <div class="auth-field">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" placeholder="Tu contraseña" required autocomplete="new-password">
                @error('password') <span class="auth-error">{{ $message }}</span> @enderror
            </div>
            <div class="auth-field">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repite tu contraseña" required autocomplete="new-password">
            </div>
            <button class="auth-submit" type="submit" data-test="register-user-button">Crear cuenta</button>
        </form>

                <p class="auth-register">¿Ya tienes una cuenta? <a href="{{ request('tipo') === 'representante' ? route('sesion.rep.leg') : route('login') }}">Inicia sesión</a></p>
            </section>
        </main>
    </div>
</body>
</html>
