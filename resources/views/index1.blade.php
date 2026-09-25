<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/style.css')
    @vite(['resources/js/calendario-modal.js'])
    <title>MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<script>
    window.carritoRoute = "{{ route('carrito') }}";
</script>

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
            @auth
                <li><a href="{{ route('dash.rep') }}"> UNETE O REGÍSTRA TU GRUPO </a></li>
            @endauth
            <li><a href="{{ route('calendario') }}">CALENDARIO</a></li>
            <button class="wooden-cart-button" type="button" aria-label="Carrito">
                <a href="{{ route('carrito') }}"><div class="wooden-cart-button-inner">
                    <svg viewBox="0 0 24 24">
                    <path
                        d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A.996.996 0 0 0 21.42 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"
                    ></path>
                    </svg>
                    <span class="button-text">Carrito</span>
                </div>
            </button></a>
        </ul>


            <!-- From Uiverse.io by reglobby -->
        <div class="usuario">
            @auth
                <!-- BOTÓN CUANDO EL USUARIO ESTÁ AUTENTICADO (LOG OUT) -->
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: inline;">
                    @csrf
                    <div
                        aria-label="Cerrar sesión"

                        tabindex="0"
                        role="button"
                        class="user-profile"
                        onclick="document.getElementById('logout-form').submit();"
                        onkeydown="if(event.key === 'Enter' || event.key === ' ') { event.preventDefault(); document.getElementById('logout-form').submit(); }"
                    >
                        <div class="user-profile-inner">
                            <!-- Icono SVG de cerrar sesión (puerta/salida) -->
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                                <path d="M5 22a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h7a1 1 0 0 1 0 2H6v16h6a1 1 0 0 1 0 2H5zm10.707-11H9a1 1 0 0 0 0 2h6.707l-2.354 2.354a1 1 0 1 0 1.414 1.414l4-4a1 1 0 0 0 0-1.414l-4-4a1 1 0 1 0-1.414 1.414L15.707 11z"/>
                            </svg>
                            <p>Cerrar Sesión</p>
                        </div>
                    </div>
                </form>

            @else
                <!-- BOTÓN CUANDO EL USUARIO ES UN INVITADO (LOG IN) -->
                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div
                        aria-label="User Login Button"

                        tabindex="0"
                        role="button"
                        class="user-profile"
                    >
                        <div class="user-profile-inner">
                            <!-- Icono SVG original de usuario -->
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g data-name="Layer 2" id="Layer_2">
                                    <path d="m15.626 11.769a6 6 0 1 0 -7.252 0 9.008 9.008 0 0 0 -5.374 8.231 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 9.008 9.008 0 0 0 -5.374-8.231zm-7.626-4.769a4 4 0 1 1 4 4 4 4 0 0 1 -4-4zm10 14h-12a1 1 0 0 1 -1-1 7 7 0 0 1 14 0 1 1 0 0 1 -1 1z"></path>
                                </g>
                            </svg>

                            <p>Iniciar Sesión</p>
                        </div>
                    </div>
                </a>
            @endauth
    </div>
    </div>

    @auth
        @if (auth()->user()->canManageMusicalGroups())
            <a href="{{ route('panel.admin') }}" class="setting-btn" role="button">
                <span class="bar bar1"></span>
                <span class="bar bar2"></span>
                <span class="bar bar1"></span>
            </a>
        @endif
    @endauth


    <div>
        <div class="logo">
                <img class="logito" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
        </div>
        <!-- Logo -->

    </div>



</header>


<!-- LAYOUT PRINCIPAL: sub_menu al lado izquierdo + contenido a la derecha -->
<div class="layout">

    <!-- Menu lateral: oculto por defecto, se muestra con la clase "active" -->
    <div class="sub_menu">
        <ul>
            <li><a href="#" data-genre=""> <strong>DESCUBRIR</strong></a></li>
            <li><a href="#" data-genre="POP">POP</a></li>
            <li><a href="#" data-genre="REGGAETON">REGGAETON</a></li>
            <li><a href="#" data-genre="ROCK">ROCK</a></li>
            <li><a href="#" data-genre="ELECTRONICA">ELECTRONICA</a></li>
            <li><a href="#" data-genre="SALSA">SALSA</a></li>
            <li><a href="#" data-genre="BACHATA">BACHATA</a></li>
            <li><a href="#" data-genre="VALLENATO">VALLENATO</a></li>
            <li><a href="#" data-genre="CUMBIA">CUMBIA</a></li>
            <li><a href="#" data-genre="RANCHERA">RANCHERA</a></li>
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
            <div class="contenedor" data-artista="{{ $grupo->artista_nombre }}" data-genero="{{ $grupo->genero_attr }}">
                <div class="img-contenedor">
                    <img class="img_art" src="{{ $grupo->artista_imagen }}" alt="{{ $grupo->artista_nombre }}">
                    <div class="img-texto">
                        <p>{{ $grupo->artista_nombre }}</p>
                        <p>Grupo musical</p>
                    </div>
                </div>
                <p class="descripcion">{{ $grupo->artista_descripcion }}</p>
                <div class="boton">
                    <button
                        type="button"
                        class="mas-info-link info-toggle group-info-toggle"
                        data-target="info-panel"
                        data-name="{{ $grupo->artista_nombre }}"
                        data-image="{{ $grupo->artista_imagen }}"
                        data-logo="{{ $grupo->artista_logo }}"
                        data-description="{{ $grupo->artista_descripcion }}"
                        data-price="{{ $grupo->artista_precio }}"
                        data-tag="Grupo musical"
                        data-genre="{{ $grupo->genero_attr }}"
                        data-video="{{ $grupo->artista_video }}"
                        data-nit="{{ $grupo->nit }}"
                        data-reviews='@json($grupo->reseñas)'
                        data-can-admin="{{ $grupo->can_manage }}"
                    >
                        Mas Informacion
                    </button>
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

<section class="info-panel" id="info-panel" aria-hidden="true"> <!-- Modal -->
    <div class="info-panel__content info-panel__content--arcangel">
        <button type="button" class="info-panel__close" aria-label="Cerrar">&times;</button>

        <div class="info-panel__hero">
            <div class="info-panel__portrait">
                <img id="info-panel-image" src="{{ asset('storage/img/inside.jpeg') }}" alt="Grupo musical">
            </div>

            <div class="info-panel__identity">
                <div class="info-panel__logo">
                    <img id="info-panel-logo" src="{{ asset('storage/img/logo_arca.jpg') }}" alt="Logo grupo musical">
                </div>
                <h2 id="info-panel-name">Grupo musical</h2>
                <div class="info-panel__tags">
                    <span id="info-panel-tag">Grupo musical</span>
                    <span id="info-panel-tag-secondary">Disponible</span>
                </div>
            </div>
        </div>

        <div class="info-panel__details">
            <article class="info-panel__detail-card info-panel__detail-card--artist">
                <div class="info-panel__section-head">
                    <i class="fa-solid fa-user"></i>
                    <h3>Artista</h3>
                </div>

                <div class="info-panel__artist-block">
                    <div class="info-panel__artist-thumb">
                        <img id="info-panel-thumb" src="{{ asset('storage/img/inside.jpeg') }}" alt="Grupo musical">
                    </div>
                    <div class="info-panel__artist-copy">
                        <h4 id="info-panel-title">Grupo musical</h4>
                        <p id="info-panel-description">Grupo musical disponible para eventos.</p>
                    </div>
                </div>
            </article>

            <article class="info-panel__detail-card info-panel__detail-card--price">
                <div class="info-panel__section-head">
                    <i class="fa-solid fa-dollar-sign"></i>
                    <h3>Precio</h3>
                </div>

                <div id="info-panel-price" class="info-panel__price">Consultar precio</div>
                <p>por hora de presentación</p>
            </article>
        </div>

        <div class="info-panel__media-section">
            <div class="info-panel__media-header">
                <span class="info-panel__media-icon"><i class="fa-solid fa-video"></i></span>
                <h3>Video de Presentación</h3>
            </div>

            <div class="info-panel__video-shell">
                <iframe
                    id="info-panel-iframe"
                    class="info-panel__video is-hidden"
                    src=""
                    title="Video de presentación"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                ></iframe>
                <video
                    id="info-panel-video"
                    class="info-panel__video is-hidden"
                    controls
                    playsinline
                    preload="metadata"
                ></video>
            </div>
        </div>

        {{-- ✅ CALENDARIO: dentro del content, antes de las reseñas --}}
        <div class="modal-calendario-section">
            <div class="modal-calendario-section__header">
                <i class="fa-solid fa-calendar-days"></i>
                <h3>Reservar fecha</h3>
            </div>

            <div id="calendar-modal"></div>

            <div id="form-reserva" style="display:none; margin-top: 1rem;">
                <p id="reserva-resumen"></p>

                <input type="hidden" id="reserva-fecha">
                <input type="hidden" id="reserva-hora">
                <input type="hidden" id="reserva-nit">

                <div class="form-group">
                    <label for="reserva-direccion">Dirección del evento</label>
                    <input type="text" id="reserva-direccion" class="form-control"
                           placeholder="Ej: Calle 45 #23-10, Bogotá" maxlength="60">
                </div>

                <button
                    id="btn-confirmar-reserva"
                    class="btn-reserva"
                    data-authenticated="{{ auth()->check() ? '1' : '0' }}"
                >
                    Confirmar reserva
                </button>

                <p id="reserva-mensaje"></p>
            </div>
        </div>

        {{-- Reseñas --}}
        <div class="info-panel__reviews" id="info-panel-reviews"></div>

    </div>
</section> <!-- Modal -->

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
