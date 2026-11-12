<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.theme')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de representante legal | MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite('resources/css/login.css')
</head>
<body class="auth-page auth-account-page auth-account-page--register">
    <header class="auth-account-header">
        <a href="{{ route('iniciar.rep.leg') }}" class="auth-account-header__back">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            <span>Volver a iniciar sesión</span>
        </a>
        <a class="auth-account-brand" href="{{ route('home') }}" aria-label="MusikEventos, inicio">
            <img src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
            <span>Musik<span>Eventos</span></span>
        </a>
        <span class="auth-account-header__context">REPRESENTANTES LEGALES</span>
    </header>

    <main class="auth-account-layout">
        <aside class="auth-account-visual">
            <img src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales en un escenario">
            <div class="auth-account-visual__content">
                <span><i class="fa-solid fa-sparkles" aria-hidden="true"></i> HAZ PARTE DE MUSIKEVENTOS</span>
                <h1>Tu música<br>también se organiza.</h1>
                <p>Registra tu perfil como representante legal y comienza a gestionar la presencia de tus artistas.</p>
                <div class="auth-account-visual__note">
                    <i class="fa-solid fa-music" aria-hidden="true"></i>
                    <span>Un solo lugar para conectar con nuevos escenarios.</span>
                </div>
            </div>
        </aside>

        <section class="auth-account-card" aria-labelledby="representante-title">
            <div class="auth-account-card__heading">
                <span class="auth-account-eyebrow">REGISTRO DE REPRESENTANTE</span>
                <h2 id="representante-title">Crea tu cuenta</h2>
                <p>Completa tus datos personales y de acceso.</p>
            </div>

            <form class="auth-account-form" method="POST" action="{{ route('registro.representante.store') }}">
                @csrf

                <div class="auth-account-field">
                    <label for="nombre">Nombre</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-user" aria-hidden="true"></i>
                        <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" maxlength="25" placeholder="Tu nombre" required autocomplete="given-name" @error('nombre') aria-describedby="nombre-error" @enderror>
                    </div>
                    @error('nombre')
                        <span class="auth-account-error" id="nombre-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="apellido">Apellido</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-user" aria-hidden="true"></i>
                        <input id="apellido" name="apellido" type="text" value="{{ old('apellido') }}" maxlength="25" placeholder="Tu apellido" required autocomplete="family-name" @error('apellido') aria-describedby="apellido-error" @enderror>
                    </div>
                    @error('apellido')
                        <span class="auth-account-error" id="apellido-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="tipo_doc">Tipo de documento</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-id-card" aria-hidden="true"></i>
                        <select id="tipo_doc" name="tipo_doc" required @error('tipo_doc') aria-describedby="tipo-doc-error" @enderror>
                            <option value="" disabled @selected(old('tipo_doc') === null)>Selecciona una opción</option>
                            <option value="CC" @selected(old('tipo_doc') === 'CC')>Cédula de ciudadanía</option>
                            <option value="CE" @selected(old('tipo_doc') === 'CE')>Cédula de extranjería</option>
                            <option value="TI" @selected(old('tipo_doc') === 'TI')>Tarjeta de identidad</option>
                            <option value="PAS" @selected(old('tipo_doc') === 'PAS')>Pasaporte</option>
                        </select>
                    </div>
                    @error('tipo_doc')
                        <span class="auth-account-error" id="tipo-doc-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="numero_doc">Número de documento</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-address-card" aria-hidden="true"></i>
                        <input id="numero_doc" name="numero_doc" type="text" value="{{ old('numero_doc') }}" maxlength="10" placeholder="Tu número de documento" required autocomplete="off" @error('numero_doc') aria-describedby="numero-doc-error" @enderror>
                    </div>
                    @error('numero_doc')
                        <span class="auth-account-error" id="numero-doc-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="celular">Celular</label>
                    <div class="auth-account-input">
                        <i class="fa-solid fa-mobile-screen-button" aria-hidden="true"></i>
                        <input id="celular" name="celular" type="tel" value="{{ old('celular') }}" maxlength="10" inputmode="numeric" placeholder="3001234567" required autocomplete="tel" @error('celular') aria-describedby="celular-error" @enderror>
                    </div>
                    @error('celular')
                        <span class="auth-account-error" id="celular-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <div class="auth-account-input">
                        <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento') }}" required autocomplete="bday" @error('fecha_nacimiento') aria-describedby="fecha-nacimiento-error" @enderror>
                    </div>
                    @error('fecha_nacimiento')
                        <span class="auth-account-error" id="fecha-nacimiento-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field auth-account-field--full">
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
                        <input id="password" name="password" type="password" minlength="8" placeholder="Crea una contraseña segura" required autocomplete="new-password" @error('password') aria-describedby="password-error" @enderror>
                    </div>
                    @error('password')
                        <span class="auth-account-error" id="password-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-account-field">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <div class="auth-account-input">
                        <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                        <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" placeholder="Escríbela de nuevo" required autocomplete="new-password">
                    </div>
                </div>

                <button class="auth-account-submit" type="submit">
                    <span>Crear cuenta de representante</span>
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="auth-account-switch">
                ¿Ya tienes una cuenta?
                <a href="{{ route('iniciar.rep.leg') }}">Inicia sesión</a>
            </p>
        </section>
    </main>
</body>
</html>
