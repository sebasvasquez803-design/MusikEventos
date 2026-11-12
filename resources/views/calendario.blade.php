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
    @vite(['resources/css/calendario.css', 'resources/js/app.js'])
</head>
<body>
    <header>
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
        <h1>RESERVA AQUÍ !!!</h1>
        <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
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
</body>
</html>
