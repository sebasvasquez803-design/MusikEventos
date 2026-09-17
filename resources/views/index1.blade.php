<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @php
            $artistaNombre = $grupo->nombre_grupo ?? 'Grupo musical';
            $artistaImagen = $grupo->avatar_url ?? asset('storage/img/inside.jpeg');
            $artistaLogo = $grupo->logo_url ?? $grupo->avatar_url ?? asset('storage/img/logo_arca.jpg');
            $artistaDescripcion = $grupo->descripcion ?: 'Grupo musical disponible para eventos.';
            $artistaPrecio = $grupo->precio_hora ? '$' . number_format((float) $grupo->precio_hora, 0, ',', '.') : 'Consultar precio';
            $artistaVideo = $grupo->video_url
                ? (str_starts_with($grupo->video_url, 'http') ? preg_replace('/\?.*/', '', $grupo->video_url) : Storage::disk('public')->url($grupo->video_url))
                : '';
            $reseñasArtista = $grupo->resenas->map(function ($resena) {
                return [
                    'nombre' => $resena->nombre_usuario ?: 'Usuario',
                    'avatar' => strtoupper(substr(($resena->nombre_usuario ?: 'U'), 0, 1)),
                    'texto' => $resena->comentario ?: 'Excelente experiencia.',
                    'estrellas' => $resena->numero_estrellas ?? 5,
                    'id_resena' => $resena->id_resena,
                ];
            })->toArray();

            if (empty($reseñasArtista)) {
                $reseñasArtista = [[
                    'nombre' => 'Nuevo usuario',
                    'avatar' => 'N',
                    'texto' => 'Aún no hay reseñas para este grupo. ¡Sé el primero en dejar tu opinión!',
                    'estrellas' => 5,
                    'id_resena' => null,
                ]];
            }
        @endphp
        @php
            try {
                $grupoGeneros = \DB::table('subgenero')->where('nit', $grupo->nit)->pluck('nombre_subgenero')->toArray() ?: [];
            } catch (\Throwable $e) {
                $grupoGeneros = [];
            }

            // If grupo has direct id_subgenero, add its name and its parent genero
            $mainGenero = '';
            $mainSub = '';
            try {
                if (!empty($grupo->id_subgenero)) {
                    $mainSub = \DB::table('subgenero')->where('id_subgenero', $grupo->id_subgenero)->value('nombre_subgenero');
                    if ($mainSub) $grupoGeneros[] = $mainSub;
                    $parentGeneroId = \DB::table('subgenero')->where('id_subgenero', $grupo->id_subgenero)->value('id_genero');
                    if ($parentGeneroId) {
                        $mainGenero = \DB::table('genero')->where('id_genero', $parentGeneroId)->value('nombre_genero');
                        if ($mainGenero) $grupoGeneros[] = $mainGenero;
                    }
                }
            } catch (\Throwable $e) {
                // ignore
            }

            $grupoGeneroAttr = $grupoGeneros ? implode(',', $grupoGeneros) : '';
        @endphp
        <div class="contenedor" data-artista="{{ $artistaNombre }}" data-genero="{{ $grupoGeneroAttr }}">
            <div class="img-contenedor">
                <img class="img_art" src="{{ $artistaImagen }}" alt="{{ $artistaNombre }}">
                <div class="img-texto">
                    <p>{{ $artistaNombre }}</p>
                    <p>Grupo musical</p>
                </div>
            </div>
            <p class="descripcion">{{ $artistaDescripcion }}</p>
            <div class="boton">
                <button
                    type="button"
                    class="mas-info-link info-toggle group-info-toggle"
                    data-target="info-panel"
                    data-name="{{ $artistaNombre }}"
                    data-image="{{ $artistaImagen }}"
                    data-logo="{{ $artistaLogo }}"
                    data-description="{{ $artistaDescripcion }}"
                    data-price="{{ $artistaPrecio }}"
                    data-tag="Grupo musical"
                    data-video="{{ $artistaVideo }}"
                    data-nit="{{ $grupo->nit }}"
                    data-reviews='@json($reseñasArtista)'
                    data-can-admin="{{ auth()->user() && auth()->user()->canManageMusicalGroups() ? '1' : '0' }}"
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

<section class="info-panel" id="info-panel" aria-hidden="true">
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

        <div class="info-panel__reviews" id="info-panel-reviews"></div>

        <div class="info-panel__review-form-wrap">
            <h3>Deja tu reseña</h3>
            <form class="info-panel__review-form" method="POST" action="{{ route('resenas.store') }}">
                @csrf
                <input type="hidden" name="nit" value="">
                <input type="hidden" name="editing_id" id="editing_id" value="">
                <input type="text" name="nombre_usuario" placeholder="Tu nombre" required>
                <textarea name="comentario" placeholder="Cuéntanos tu experiencia..." required></textarea>
                <div class="rating-stars" aria-label="Selecciona estrellas">
                    <button type="button" class="star" data-value="1" aria-label="1 estrella">☆</button>
                    <button type="button" class="star" data-value="2" aria-label="2 estrellas">☆</button>
                    <button type="button" class="star" data-value="3" aria-label="3 estrellas">☆</button>
                    <button type="button" class="star" data-value="4" aria-label="4 estrellas">☆</button>
                    <button type="button" class="star" data-value="5" aria-label="5 estrellas">☆</button>
                </div>
                <div class="selected-stars-label" id="selected-stars-label">5 estrellas</div>
                <select name="numero_estrellas" required style="display:none;">
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <div style="display:flex;gap:.5rem;align-items:center;margin-top:.5rem;">
                    <button type="submit" id="review-submit">Enviar reseña</button>
                    <button type="button" id="cancel-edit" style="display:none;">Cancelar edición</button>
                </div>
            </form>
        </div>
    </div>

</section>

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
