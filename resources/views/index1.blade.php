<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/style.css')
    <title>MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/imagen20.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<!-- Encabezado con navegación pública y acceso de usuario. -->

<!-- ENCABEZADO -->
<header>

    <!-- Boton hamburguesa: el JS le agrega/quita la clase "active" al sub_menu -->
    <div class="hambu">
        <a href="#"><i class="fa-solid fa-bars"></i></a>
    </div>

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
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" aria-label="Cerrar sesión" title="Cerrar sesión">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" aria-label="Iniciar sesión" title="Iniciar sesión">
                        <i class="fa-solid fa-circle-user"></i>
                    </a>
                @endauth
            </div>
        </ul>
    </div>

    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
    </a>

</header>


<!-- LAYOUT PRINCIPAL: sub_menu al lado izquierdo + contenido a la derecha -->
<div class="layout">

    <!-- Menu lateral: oculto por defecto, se muestra con la clase "active" -->
    <div class="sub_menu">
        <ul>
            <li><a href="#"><strong>DESCUBRIR</strong></a></li>
            <li><a href="#">POP</a></li>
            <li><a href="#">REGGAETON</a></li>
            <li><a href="#">ROCK</a></li>
            <li><a href="#">ELECTRONICA</a></li>
            <li><a href="#">SALSA</a></li>
            <li><a href="#">BACHATA</a></li>
            <li><a href="#">VALLENATO</a></li>
            <li><a href="#">CUMBIA</a></li>
            <li><a href="#">RANCHERA</a></li>
        </ul>
    </div>

    <!-- Contenido principal: búsqueda, tarjetas y paginación. -->
    <div class="contenido-principal">

        <!-- Barra de busqueda -->
        <form class="barra-busqueda" method="GET" action="{{ route('home') }}">
            <input type="search" name="buscar" value="{{ request('buscar') }}" placeholder="Busca tu grupo de genero">
            <button type="submit">Buscar</button>
        </form>

        <!-- Grid de tarjetas de grupos registrados. -->
        <div class="grid-cards">

        @forelse ($grupos as $grupo)
        <div class="contenedor">
            <div class="img-contenedor">
                <img class="img_art" src="{{ $grupo->avatar_url ?? asset('storage/img/inside.jpeg') }}" alt="{{ $grupo->nombre_grupo }}">
                <div class="img-texto">
                    <p>{{ $grupo->nombre_grupo }}</p>
                    <p>Grupo musical</p>
                </div>
            </div>
            <p class="descripcion">{{ $grupo->descripcion ?: 'Grupo musical disponible para eventos.' }}</p>
            <div class="boton">
                <input type="button" value="Mas Informacion" onclick=" window.location.href='{{ route('mas_info') }}'">
            </div>
            @auth
                @if (auth()->user()->canManageMusicalGroups())
                    <div class="acciones-grupo">
                        <a href="{{ route('grupo-musical.edit', $grupo) }}">Actualizar</a>
                        <form method="POST" action="{{ route('grupo-musical.destroy', $grupo) }}" onsubmit="return confirm('¿Deseas eliminar este grupo musical?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
        @empty
            <p>No hay grupos musicales registrados.</p>
        @endforelse

        </div><!-- fin grid-cards -->

                <!-- Paginación real conservando los filtros actuales. -->
                <div class="paginacion">
                    @if ($grupos->onFirstPage())
                        <span>Atras</span>
                    @else
                        <a href="{{ $grupos->previousPageUrl() }}">Atras</a>
                    @endif

                    @if ($grupos->lastPage() >= 1)
                        <a href="{{ $grupos->url(1) }}" class="{{ $grupos->currentPage() === 1 ? 'activo' : '' }}">1</a>
                    @endif
                    @if ($grupos->lastPage() >= 2)
                        <a href="{{ $grupos->url(2) }}" class="{{ $grupos->currentPage() === 2 ? 'activo' : '' }}">2</a>
                    @endif
                    @if ($grupos->lastPage() >= 3)
                        <a href="{{ $grupos->url(3) }}" class="{{ $grupos->currentPage() === 3 ? 'activo' : '' }}">3</a>
                    @endif
                    @if ($grupos->lastPage() > 5)
                        <span>...</span>
                    @endif
                    @if ($grupos->lastPage() >= 67)
                        <a href="{{ $grupos->url(67) }}" class="{{ $grupos->currentPage() === 67 ? 'activo' : '' }}">67</a>
                    @endif
                    @if ($grupos->lastPage() >= 68)
                        <a href="{{ $grupos->url(68) }}" class="{{ $grupos->currentPage() === 68 ? 'activo' : '' }}">68</a>
                    @endif

                    @if ($grupos->hasMorePages())
                        <a href="{{ $grupos->nextPageUrl() }}">Siguiente</a>
                    @else
                        <span>Siguiente</span>
                    @endif
                </div>

    </div><!-- fin contenido-principal -->

</div><!-- fin layout -->

    <footer>
         <div class="contenedor-footer">
        <div class="info">
            <h2 class="titulo_footer1">Acerca De Nosotros</h2>
            <p>Somos una empresa dedicada a la organización de eventos musicales, con más de 10 años de experiencia en el sector.</p>
            <br><p>¡¡VIVE LA MUSICA , VIVE TUS EVENTOS!!</p>
        </div>

        <div class="info1">
            <h2 class="titulo_footer2">Contactenos</h2>
            <div class="redes_sociales">
               <a href="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2F%3Flocale%3Des_LA"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/accounts/login/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="form/contactenos.html"><i class="fa-solid fa-file-lines"></i></a>
            </div>
        </div>
    </div>


    <div class="direccion">
       <p><strong>Direccion</strong> calle 50 # 2-90 Soacha   <br><i class="fa-sharp fa-regular fa-copyright"></i>copyrigth 2026</p>
    </div>
</footer>



@vite('resources/js/transicion.js')
</body>
</html>
