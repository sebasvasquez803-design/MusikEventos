<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.theme')
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de eventos | MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <header class="calendario-site-header">
        <nav class="menu" aria-label="Navegación principal">
            <ul>
                @auth
                    <li><a href="{{ route('dash.rep') }}">ÚNETE O REGISTRA TU GRUPO</a></li>
                @endauth
                <li><a href="{{ route('calendario') }}" aria-current="page">CALENDARIO</a></li>
                <li>
                    <a class="wooden-cart-button" href="{{ route('carrito') }}" aria-label="Ir al carrito">
                        <span class="wooden-cart-button-inner">
                            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                            <span class="button-text">Carrito</span>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="usuario">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="user-profile" aria-label="Cerrar sesión">
                    <span class="user-profile-inner">
                        <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i>
                        <span class="button-text">Cerrar sesión</span>
                    </span>
                </button>
            </form>
        </div>

        @if (auth()->user()->canManageMusicalGroups())
            <a href="{{ route('panel.admin') }}" class="setting-btn" aria-label="Panel de administración">
                <span class="bar bar1"></span>
                <span class="bar bar2"></span>
                <span class="bar bar1"></span>
            </a>
        @endif

        <a class="calendario-site__brand" href="{{ route('home') }}" aria-label="MusikEventos, inicio">
            <img class="logito" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="MusikEventos">
        </a>
    </header>

    <main class="calendario-page">
        <div class="calendario-page__header">
            <p class="calendario-page__eyebrow">MusikEventos · agenda</p>
            <h1>
                @if (auth()->user()->id_tipo_persona == 3)
                    Mis reservas
                @else
                    Eventos de mi grupo
                @endif
            </h1>
            <p class="calendario-page__description">
                Consulta las fechas y organiza tus próximos eventos.
            </p>
        </div>

        <section class="calendario-page__card" aria-label="Calendario de eventos">
            <div id="calendar-completo"></div>
        </section>
    </main>

    <footer>
        <div class="contenedor-footer">
            <div class="info">
                <h2 class="titulo_footer1">Acerca de nosotros</h2>
                <p>Somos una empresa dedicada a la organización de eventos musicales, con más de 10 años de experiencia en el sector.</p>
                <p>¡Vive la música, vive tus eventos!</p>
            </div>
            <div class="info1">
                <h2 class="titulo_footer2">Contáctenos</h2>
                <div class="redes_sociales" aria-label="Redes sociales">
                    <a href="https://www.facebook.com/" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.whatsapp.com/" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div class="direccion">
            <p><strong>Dirección</strong> calle 50 # 2-90 Soacha<br>© MusikEventos 2026</p>
        </div>
    </footer>
</body>
</html>
