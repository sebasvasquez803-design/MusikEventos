<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.theme')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unirse a un grupo | MusikEventos</title>
    @vite('resources/css/unirse_grupo.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="join-page">
    <header class="join-header">
        <a href="{{ route('dash.rep') }}" class="join-back" aria-label="Volver al panel">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Volver</span>
        </a>

        <a href="{{ route('home') }}" class="join-brand" aria-label="Ir al inicio">
            <img src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
            <div>
                <span>MusikEventos</span>
                <strong>Únete a una banda</strong>
            </div>
        </a>

        <span class="join-account">
            <i class="fa-solid fa-user"></i>
            {{ Auth::user()->name }}
        </span>
    </header>

    <main class="join-main">
        <section class="join-hero">
            <div>
                <span class="join-eyebrow">Colabora con tu talento</span>
                <h1>Encuentra tu próximo grupo</h1>
                <p>Explora bandas registradas y envía una solicitud para formar parte de su equipo musical.</p>
            </div>
            <div class="join-stats">
                <strong id="join-results-count">{{ $grupos->count() }}</strong>
                <span>grupos disponibles</span>
            </div>
        </section>

        @if(session('success'))
            <div class="join-alert success"><i class="fa-solid fa-circle-check"></i>{{ session('success') }}</div>
        @endif
        @if(session('warning'))
            <div class="join-alert warning"><i class="fa-solid fa-circle-exclamation"></i>{{ session('warning') }}</div>
        @endif

        <form class="join-filters" id="join-filters" method="GET" action="{{ route('grupo.unirse') }}">
            <label class="join-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="join-search" type="search" name="buscar" value="{{ $buscar }}" placeholder="Buscar por nombre o iniciales">
            </label>
            <label class="join-select">
                <i class="fa-solid fa-sliders"></i>
                <select id="join-genre" name="genero" aria-label="Género musical">
                    <option value="">Todos los géneros</option>
                    @foreach($generos as $nombreGenero)
                        <option value="{{ $nombreGenero }}" @selected($genero === $nombreGenero)>
                            {{ $nombreGenero }}
                        </option>
                    @endforeach
                </select>
            </label>
            <button type="submit">Buscar</button>
        </form>

        @if($grupos->isEmpty())
            <section class="join-empty">
                <i class="fa-solid fa-music"></i>
                <h2>No encontramos grupos</h2>
                <p>Prueba otro nombre o selecciona todos los géneros.</p>
                <a href="{{ route('grupo.unirse') }}">Ver todos los grupos</a>
            </section>
        @else
            <section class="join-grid" aria-label="Grupos musicales disponibles">
                @foreach($grupos as $grupo)
                    @php
                        $solicitud = $solicitudes->get((string) $grupo->nit);
                        $estado = $solicitud->estado ?? null;
                        $imagen = $grupo->logo_url ?: ($grupo->avatar_url ?: asset('storage/img/grupos/logoMusikEventos.png'));
                    @endphp
                    <article class="join-card"
                        data-name="{{ $grupo->nombre_grupo }}"
                        data-genre="{{ $grupo->subgenero->nombre_subgenero ?? '' }}">
                        <div class="join-card-media">
                            <img src="{{ $imagen }}" alt="{{ $grupo->nombre_grupo }}">
                            <span>{{ $grupo->subgenero->nombre_subgenero ?? 'Grupo musical' }}</span>
                        </div>
                        <div class="join-card-body">
                            <h2>{{ $grupo->nombre_grupo }}</h2>
                            <p>{{ \Illuminate\Support\Str::limit($grupo->descripcion ?: 'Grupo musical disponible para nuevos integrantes.', 92) }}</p>
                            <div class="join-card-meta">
                                <span><i class="fa-solid fa-microphone-lines"></i> NIT {{ $grupo->nit }}</span>
                                @if($estado)
                                    <b class="request-status {{ $estado }}">{{ ucfirst($estado) }}</b>
                                @else
                                    <b>Disponible</b>
                                @endif
                            </div>
                            @if($estado)
                                <button type="button" class="join-request-button is-sent" disabled>
                                    <i class="fa-solid fa-check"></i> Solicitud enviada
                                </button>
                            @else
                                <button type="button"
                                    class="join-request-button"
                                    data-nit="{{ $grupo->nit }}"
                                    data-name="{{ $grupo->nombre_grupo }}"
                                    data-image="{{ $imagen }}">
                                    Solicitar unirme
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            @endif
                        </div>
                    </article>
                @endforeach
            </section>
        @endif
    </main>

    <div class="join-modal-overlay" id="join-modal" aria-hidden="true">
        <section class="join-modal" role="dialog" aria-modal="true" aria-labelledby="join-modal-title">
            <button type="button" class="join-modal-close" id="join-modal-close" aria-label="Cerrar">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="join-modal-head">
                <img id="join-modal-image" src="" alt="">
                <div>
                    <span>Solicitud para</span>
                    <h2 id="join-modal-title">Grupo musical</h2>
                </div>
            </div>
            <form method="POST" action="{{ route('grupo.unirse.store') }}" class="join-form">
                @csrf
                <input type="hidden" name="nit" id="join-nit">

                <label>
                    <span>Rol dentro del grupo</span>
                    <select name="rol" required>
                        <option value="">Selecciona un rol</option>
                        <option>Voz principal</option>
                        <option>Coros</option>
                        <option>Instrumentista</option>
                        <option>Productor</option>
                        <option>Otro</option>
                    </select>
                </label>

                <label>
                    <span>Instrumento principal</span>
                    <input type="text" name="instrumento" maxlength="50" placeholder="Ejemplo: Guitarra eléctrica" required>
                </label>

                <label>
                    <span>Mensaje para el representante <small>Opcional</small></span>
                    <textarea name="mensaje" maxlength="500" rows="4" placeholder="Presenta tu experiencia y explica por qué quieres unirte..."></textarea>
                </label>

                <button type="submit" class="join-submit">
                    Enviar solicitud
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </section>
    </div>

    <script>
        const joinFilters = document.getElementById('join-filters');
        const joinSearch = document.getElementById('join-search');
        const joinGenre = document.getElementById('join-genre');
        const joinCards = [...document.querySelectorAll('.join-card')];

        function normalizeJoinText(text) {
            return (text || '')
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, ' ')
                .trim();
        }

        function filterJoinCards() {
            const query = normalizeJoinText(joinSearch?.value);
            const genre = normalizeJoinText(joinGenre?.value);
            let visibleCount = 0;

            joinCards.forEach((card) => {
                const name = normalizeJoinText(card.dataset.name);
                const cardGenre = normalizeJoinText(card.dataset.genre);
                const words = name.split(' ').filter(Boolean);
                const initials = words.map((word) => word[0]).join('');

                const matchesName = !query || name.includes(query) || initials.includes(query);
                const matchesGenre = !genre || cardGenre === genre || cardGenre.includes(genre);
                const isVisible = matchesName && matchesGenre;
                card.hidden = !isVisible;
                if (isVisible) visibleCount += 1;
            });

            const countElement = document.getElementById('join-results-count');
            if (countElement) countElement.textContent = visibleCount;
        }

        joinSearch?.addEventListener('input', filterJoinCards);
        joinGenre?.addEventListener('change', () => {
            filterJoinCards();
            joinFilters?.submit();
        });

        const modal = document.getElementById('join-modal');
        const closeModal = document.getElementById('join-modal-close');
        const nitInput = document.getElementById('join-nit');
        const modalTitle = document.getElementById('join-modal-title');
        const modalImage = document.getElementById('join-modal-image');

        function openJoinModal(button) {
            nitInput.value = button.dataset.nit;
            modalTitle.textContent = button.dataset.name;
            modalImage.src = button.dataset.image;
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('modal-open');
            closeModal.focus();
        }

        function closeJoinModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('modal-open');
        }

        document.querySelectorAll('.join-request-button:not(:disabled)').forEach((button) => {
            button.addEventListener('click', () => openJoinModal(button));
        });
        closeModal.addEventListener('click', closeJoinModal);
        modal.addEventListener('click', (event) => {
            if (event.target === modal) closeJoinModal();
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeJoinModal();
        });
    </script>
</body>
</html>
