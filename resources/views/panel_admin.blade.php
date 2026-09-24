<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/admin.css')
    <title>Administrador</title>
</head>
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

        <h1>PANEL DE ADMINISTRACIÓN</h1>
            <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
    </header>
<body>
    <main class="admin-panel">
      <section class="admin-grid">
          {{-- Tarjeta de géneros. --}}
          <article class="admin-card">
              <h2>Género</h2>

              <form method="GET" action="{{ route('panel.admin') }}">
                  <input type="hidden" name="entidad" value="genero">
                  <input type="search" name="nombre" value="{{ $entidad === 'genero' ? $nombre : '' }}" placeholder="Buscar por iniciales">
                  <button type="submit">Buscar</button>
              </form>

              <ul class="admin-list">
                  @forelse ($generos as $genero)
                      <li>
                          <span>{{ $genero->nombre_genero }}</span>
                          <div class="admin-item-actions">
                              <a href="{{ route('generos.edit', $genero) }}">Editar</a>
                              <form method="POST" action="{{ route('generos.destroy', $genero) }}" onsubmit="return confirm('¿Deseas eliminar este género?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Eliminar</button>
                              </form>
                          </div>
                      </li>
                  @empty
                      <li>No hay géneros</li>
                  @endforelse
              </ul>

              <div class="admin-actions">
                  <a href="{{ route('generos.create') }}">Nuevo</a>
                  <a href="{{ route('panel.admin', ['entidad' => 'genero', 'nombre' => $entidad === 'genero' ? $nombre : null, 'mostrar' => $mostrar === 'genero' ? null : 'genero']) }}">{{ $mostrar === 'genero' ? 'Mostrar menos' : 'Mostrar más' }}</a>
              </div>
          </article>

          <article class="admin-card">
              <h2>Sub Género</h2>

              <form method="GET" action="{{ route('panel.admin') }}">
                  <input type="hidden" name="entidad" value="subgenero">
                  <input type="search" name="nombre" value="{{ $entidad === 'subgenero' ? $nombre : '' }}" placeholder="Buscar por iniciales">
                  <button type="submit">Buscar</button>
              </form>

              <ul class="admin-list">
                  @forelse ($subgeneros as $subgenero)
                      <li>
                          <span>{{ $subgenero->nombre_subgenero }}</span>
                          <div class="admin-item-actions">
                              <a href="{{ route('sub-generos.edit', $subgenero) }}">Editar</a>
                              <form method="POST" action="{{ route('sub-generos.destroy', $subgenero) }}" onsubmit="return confirm('¿Deseas eliminar este subgénero?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Eliminar</button>
                              </form>
                          </div>
                      </li>
                  @empty
                      <li>No hay subgéneros</li>
                  @endforelse
              </ul>

              <div class="admin-actions">
                  <a href="{{ route('sub-generos.create') }}">Nuevo</a>
                  <a href="{{ route('panel.admin', ['entidad' => 'subgenero', 'nombre' => $entidad === 'subgenero' ? $nombre : null, 'mostrar' => $mostrar === 'subgenero' ? null : 'subgenero']) }}">{{ $mostrar === 'subgenero' ? 'Mostrar menos' : 'Mostrar más' }}</a>
              </div>
          </article>

          {{-- Tarjeta de clientes. Como los clientes también viven en la tabla usuario,
               aquí se usa id_tipo_persona = 3 para filtrar solo ese tipo. --}}
          <article class="admin-card">
              <h2>Cliente</h2>

              <form method="GET" action="{{ route('panel.admin') }}">
                  <input type="hidden" name="entidad" value="cliente">
                  <input type="search" name="nombre" value="{{ $entidad === 'cliente' ? $nombre : '' }}" placeholder="Buscar por iniciales">
                  <button type="submit">Buscar</button>
              </form>

              <ul class="admin-list">
                  @forelse ($clientes as $cliente)
                      <li>
                          <span>{{ $cliente->nombre ?? 'Cliente' }} {{ $cliente->apellido ?? '' }}</span>
                          <div class="admin-item-actions">
                              <a href="{{ route('usuarios.edit', $cliente) }}">Editar</a>
                              <form method="POST" action="{{ route('usuarios.destroy', $cliente) }}" onsubmit="return confirm('¿Deseas eliminar este cliente?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Eliminar</button>
                              </form>
                          </div>
                      </li>
                  @empty
                      <li>No hay clientes</li>
                  @endforelse
              </ul>

              <div class="admin-actions">
                  <a href="{{ route('usuarios.create') }}?tipo_persona=3">Nuevo</a>
                  <a href="{{ route('panel.admin', ['entidad' => 'cliente', 'nombre' => $entidad === 'cliente' ? $nombre : null, 'mostrar' => $mostrar === 'cliente' ? null : 'cliente']) }}">{{ $mostrar === 'cliente' ? 'Mostrar menos' : 'Mostrar más' }}</a>
              </div>
          </article>

          <article class="admin-card">
              <h2>Grupo Musical</h2>

              <form method="GET" action="{{ route('panel.admin') }}">
                  <input type="hidden" name="entidad" value="grupo">
                  <input type="search" name="nombre" value="{{ $entidad === 'grupo' ? $nombre : '' }}" placeholder="Buscar por iniciales">
                  <button type="submit">Buscar</button>
              </form>

              <ul class="admin-list">
                  @forelse ($grupos as $grupo)
                      <li>
                          <span>{{ $grupo->nombre_grupo }}</span>
                          <div class="admin-item-actions">
                              <a href="{{ route('grupos.edit', $grupo) }}">Editar</a>
                              <form method="POST" action="{{ route('grupos.destroy', $grupo) }}" onsubmit="return confirm('¿Deseas eliminar este grupo?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Eliminar</button>
                              </form>
                          </div>
                      </li>
                  @empty
                      <li>No hay grupos</li>
                  @endforelse
              </ul>

              <div class="admin-actions">
                  <a href="{{ route('grupos.create') }}">Nuevo</a>
                  <a href="{{ route('panel.admin', ['entidad' => 'grupo', 'nombre' => $entidad === 'grupo' ? $nombre : null, 'mostrar' => $mostrar === 'grupo' ? null : 'grupo']) }}">{{ $mostrar === 'grupo' ? 'Mostrar menos' : 'Mostrar más' }}</a>
              </div>
          </article>

          {{-- Tarjeta de representantes legales. Aquí se usa usuario con id_tipo_persona = 1. --}}
          <article class="admin-card">
              <h2>Representante Legal</h2>

              <form method="GET" action="{{ route('panel.admin') }}">
                  <input type="hidden" name="entidad" value="representante">
                  <input type="search" name="nombre" value="{{ $entidad === 'representante' ? $nombre : '' }}" placeholder="Buscar por iniciales">
                  <button type="submit">Buscar</button>
              </form>

              <ul class="admin-list">
                  @forelse ($representantes as $representante)
                      <li>
                          <span>{{ $representante->nombre ?? 'Representante' }} {{ $representante->apellido ?? '' }}</span>
                          <div class="admin-item-actions">
                              <a href="{{ route('usuarios.edit', $representante) }}">Editar</a>
                              <form method="POST" action="{{ route('usuarios.destroy', $representante) }}" onsubmit="return confirm('¿Deseas eliminar este representante?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Eliminar</button>
                              </form>
                          </div>
                      </li>
                  @empty
                      <li>No hay representantes</li>
                  @endforelse
              </ul>

              <div class="admin-actions">
                  <a href="{{ route('usuarios.create') }}?tipo_persona=1">Nuevo</a>
                  <a href="{{ route('panel.admin', ['entidad' => 'representante', 'nombre' => $entidad === 'representante' ? $nombre : null, 'mostrar' => $mostrar === 'representante' ? null : 'representante']) }}">{{ $mostrar === 'representante' ? 'Mostrar menos' : 'Mostrar más' }}</a>
              </div>
          </article>

          {{-- Tarjeta de artistas solistas. Aquí se usa id_tipo_persona = 2. --}}
          <article class="admin-card">
              <h2>Artista Solista</h2>

              <form method="GET" action="{{ route('panel.admin') }}">
                  <input type="hidden" name="entidad" value="artista">
                  <input type="search" name="nombre" value="{{ $entidad === 'artista' ? $nombre : '' }}" placeholder="Buscar por iniciales">
                  <button type="submit">Buscar</button>
              </form>

              <ul class="admin-list">
                  @forelse ($artistas as $artista)
                      <li>
                          <span>{{ $artista->nombre ?? 'Artista' }} {{ $artista->apellido ?? '' }}</span>
                          <div class="admin-item-actions">
                              <a href="{{ route('usuarios.edit', $artista) }}">Editar</a>
                              <form method="POST" action="{{ route('usuarios.destroy', $artista) }}" onsubmit="return confirm('¿Deseas eliminar este artista?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Eliminar</button>
                              </form>
                          </div>
                      </li>
                  @empty
                      <li>No hay artistas</li>
                  @endforelse
              </ul>

              <div class="admin-actions">
                  <a href="{{ route('usuarios.create') }}?tipo_persona=2">Nuevo</a>
                  <a href="{{ route('panel.admin', ['entidad' => 'artista', 'nombre' => $entidad === 'artista' ? $nombre : null, 'mostrar' => $mostrar === 'artista' ? null : 'artista']) }}">{{ $mostrar === 'artista' ? 'Mostrar menos' : 'Mostrar más' }}</a>
              </div>
          </article>
    </main>
</body>
</html>
