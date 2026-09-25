<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iniciar sesión | Representante legal</title>
	@vite('resources/css/login.css')
</head>
<body class="auth-page">
	<header class="auth-header">
		<a href="{{ route('dash.rep') }}" class="button" aria-label="Volver al dashboard">
			<div class="button-box">
				<span class="button-elem">
					<svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg"><path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path></svg>
				</span>
			</div>
		</a>
		<h1>INICIAR SESIÓN</h1>
		<img class="auth-brand" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="MusikEventos">
	</header>

	<div class="auth-layout">
		<aside class="auth-image"><img src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales"></aside>
		<main class="auth-content">
			<section class="auth-panel">
				<h2 class="auth-title">Accede como representante</h2>
				<p class="auth-subtitle">Inicia sesión para continuar con tu registro.</p>

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
					<button class="auth-submit" type="submit">Iniciar sesión</button>
				</form>

				<p class="auth-register">¿No tienes una cuenta? <a href="{{ route('sesion.artista') }}">Regístrate aquí</a></p>
			</section>
		</main>
	</div>
</body>
</html>

