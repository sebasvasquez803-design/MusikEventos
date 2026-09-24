{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/mas_info.css')
    <title>MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/musike.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- ENCABEZADO -->
<header>


    <!-- Menu de navegacion principal -->
    <div class="menu">
        <ul>
            <li><a href="{{ route('grupo.musical') }}">UNETE COMO GRUPO MUSICAL</a></li>
            <li><a href="#">CALENDARIO</a></li>
            <li><a href="{{ route('reserva') }}">RESERVA AQUI</a></li>
            <div class="carro">
                <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="usuario">
                <a href="{{ route('registro.clientes') }}"><i class="fa-solid fa-circle-user"></i></a>
            </div>
        </ul>
    </div>

    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
    </a>

</header>

<main class="info-page">
    <div class="profile-layout">
        <article class="profile-card">
            <div class="profile-image">
                <img src="{{ asset('storage/img/arca.jpg') }}" alt="Arcángel">
            </div>

            <div class="profile-content">
                <span class="badge">Grupo musical</span>
                <h1>Arcángel</h1>
                <p class="lead">Artista con una trayectoria sólida en urbano, pop y reggaetón, ideal para eventos con público joven y energía alta.</p>

                <div class="info-list">
                    <div>
                        <span>Género</span>
                        <strong>Urbano / Reggaetón</strong>
                    </div>
                    <div>
                        <span>Precio</span>
                        <strong>$1.500.000 / hora</strong>
                    </div>
                    <div>
                        <span>Disponibilidad</span>
                        <strong>Fines de semana</strong>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('reserva') }}" class="primary-btn">Reservar ahora</a>
                    <a href="{{ route('home') }}" class="secondary-btn">Volver</a>
                </div>
            </div>
        </article>

        <aside class="side-card">
            <span class="mini-label">Repertorio</span>
            <h3>Hits principales</h3>
            <p>La Jumpa, Princesa, Me Prefieres a Mí, entre otros.</p>
        </aside>
    </div>
</main>
</body>
</html> --}}
