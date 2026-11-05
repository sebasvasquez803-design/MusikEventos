<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/estilo_reg_grupo.css')
    <title>Registro de Grupo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="registro-grupo-page">
    <!-- Formulario para registrar grupos musicales en la base de datos. -->
    <header class="registro-header">
    <a href="{{ route('dash.rep') }}" class="button" aria-label="Volver al inicio">
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

        <div class="registro-header__brand">
            <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
            <span>Musik<span>Eventos</span></span>
        </div>
        <span class="registro-header__context">REGISTRO DE ARTISTAS</span>
    </header>

    <main class="conte registro-layout">
        <aside class="contenedor registro-visual">
            <img class="img-contenedor" src="{{ asset('storage/img/inside.jpeg') }}" alt="Artistas musicales en vivo">
            <div class="registro-visual__content">
                <span class="registro-visual__eyebrow"><i class="fa-solid fa-sparkles" aria-hidden="true"></i> HAZ PARTE DE LA ESCENA</span>
                <h1>Tu música merece<br>un gran escenario.</h1>
                <p>Presenta tu grupo, conecta con nuevos eventos y comparte tu talento con quienes buscan música en vivo.</p>
                <div class="registro-visual__note">
                    <i class="fa-solid fa-music" aria-hidden="true"></i>
                    <span>Un buen comienzo para grandes presentaciones.</span>
                </div>
            </div>
        </aside>

        <form class="form-basico" name="formulario" action="{{ route('grupo-musical.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return prepararSiguiente(event)">
            @csrf

            <div class="form-heading">
                <span class="form-heading__step">PASO 1 <span>DE 2</span></span>
                <h2>Cuéntanos sobre tu grupo</h2>
                <p>Completa la información para que podamos presentarte a organizadores de eventos.</p>
            </div>

            <div class="form-fields">
            <div class="entrada">
                <label for="nit">NIT</label>
                <div class="campo-wrap"><i class="fa-regular fa-id-card" aria-hidden="true"></i><input id="nit" type="text" inputmode="numeric" pattern="[0-9]{10}" minlength="10" maxlength="10" title="El NIT debe tener exactamente 10 dígitos." placeholder="Ejemplo: 1234567890" name="nit" class="campo" value="{{ old('nit') }}" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10)" required></div>
                <span class="icon" aria-hidden="true"><i class="fa-solid fa-circle-check"></i></span>
                @error('nit') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label for="nombre_grupo">Nombre del grupo</label>
                <div class="campo-wrap"><i class="fa-solid fa-microphone-lines" aria-hidden="true"></i><input id="nombre_grupo" type="text" placeholder="Ejemplo: Los del Ritmo" name="nombre_grupo" class="campo" value="{{ old('nombre_grupo') }}" required></div>
                <span class="icon" aria-hidden="true"><i class="fa-solid fa-circle-check"></i></span>
                @error('nombre_grupo') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label for="telefono">Teléfono de contacto</label>
                <div class="campo-wrap"><i class="fa-solid fa-phone" aria-hidden="true"></i><input id="telefono" type="text" inputmode="numeric" pattern="[0-9]{10}" minlength="10" maxlength="10" title="El teléfono debe tener exactamente 10 dígitos." placeholder="10 dígitos" name="telefono" class="campo" value="{{ old('telefono') }}" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10)" required></div>
                <span class="icon" aria-hidden="true"><i class="fa-solid fa-circle-check"></i></span>
                @error('telefono') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label for="email">Correo electrónico</label>
                <div class="campo-wrap"><i class="fa-regular fa-envelope" aria-hidden="true"></i><input id="email" type="email" placeholder="tu@email.com" name="email" class="campo" value="{{ old('email') }}" required></div>
                <span class="icon" aria-hidden="true"><i class="fa-solid fa-circle-check"></i></span>
                @error('email') <small class="error">{{ $message }}</small> @enderror
            </div>


            <div class="entrada entrada--wide">
                <label for="descripcion">Cuéntanos sobre el grupo</label>
                <div class="campo-wrap campo-wrap--textarea"><i class="fa-regular fa-pen-to-square" aria-hidden="true"></i><textarea id="descripcion" name="descripcion" required class="campo" placeholder="Género, trayectoria, estilo y qué los hace únicos...">{{ old('descripcion') }}</textarea></div>
                <span class="icon" aria-hidden="true"><i class="fa-solid fa-circle-check"></i></span>
                @error('descripcion') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label for="select-subgenero">Género musical</label>
                <div class="campo-wrap"><i class="fa-solid fa-record-vinyl" aria-hidden="true"></i><select name="id_subgenero" class="campo" id="select-subgenero" required>
                    <option value="">Selecciona un subgénero</option>
                    @foreach(\DB::table('subgenero')->orderBy('nombre_subgenero')->get() as $s)
                        @php
                            $genero = \DB::table('genero')->where('id_genero', $s->id_genero)->value('nombre_genero');
                        @endphp
                        <option value="{{ $s->id_subgenero }}" data-genero="{{ $genero ?? '' }}" {{ old('id_subgenero') == $s->id_subgenero ? 'selected' : '' }}>{{ $s->nombre_subgenero }}</option>
                    @endforeach
                    </select></div>
                    <span class="icon" aria-hidden="true"><i class="fa-solid fa-circle-check"></i></span>
                    @error('id_subgenero') <small class="error">{{ $message }}</small> @enderror
                </div>

                <div class="entrada genero-box">
                    <label>Género principal</label>
                    <div id="genero-actual" class="campo genero-seleccionado"><i class="fa-solid fa-music" aria-hidden="true"></i><span>Selecciona un subgénero</span></div>
                </div>

                <div class="entrada">
                    <label for="precio-hora">Precio por hora</label>
                    <div class="campo-wrap"><i class="fa-solid fa-dollar-sign" aria-hidden="true"></i><input type="number" id="precio-hora" placeholder="Ejemplo: 150000" name="precio_hora" class="campo" value="{{ old('precio_hora') }}" min="0.01" step="0.01" required></div>
                    <span class="icon" aria-hidden="true"><i class="fa-solid fa-circle-check"></i></span>
                    @error('precio_hora') <small class="error">{{ $message }}</small> @enderror
                </div>
                </div>

            <div class="boton">
            <!-- From Uiverse.io by reshades -->
            <button type="submit" class="button1" id="siguiente" data-url="{{ route('siguiente') }}">
                <span>Continuar al siguiente paso</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                </svg>
                </button>
</div>
            </form>
    </main>

    <script>
        const form = document.forms.formulario;
        const nextButton = document.getElementById('siguiente');
        const storageKey = 'registro_grupo_data';
        const subgeneroSelect = document.getElementById('select-subgenero');
        const generoActual = document.getElementById('genero-actual');

        function actualizarGeneroSeleccionado() {
            if (!subgeneroSelect || !generoActual) return;

            const selectedOption = subgeneroSelect.options[subgeneroSelect.selectedIndex];
            const genero = selectedOption && selectedOption.dataset.genero ? selectedOption.dataset.genero : 'Selecciona un subgénero';

            generoActual.querySelector('span').textContent = genero;
        }

        if (subgeneroSelect) {
            subgeneroSelect.addEventListener('change', actualizarGeneroSeleccionado);
            actualizarGeneroSeleccionado();
        }

        function saveFormData() {
            const formData = new FormData(form);
            const data = {};

            for (const [key, value] of formData.entries()) {
                if (key === '_token') continue;
                data[key] = value;
            }

            localStorage.setItem(storageKey, JSON.stringify(data));
        }

        function restoreFormData() {
            const stored = localStorage.getItem(storageKey);
            if (!stored) return;

            try {
                const data = JSON.parse(stored);

                Object.entries(data).forEach(([key, value]) => {
                    const field = form.elements.namedItem(key);
                    if (!field || field.type === 'file') return;

                    if (field instanceof HTMLSelectElement || field instanceof HTMLInputElement || field instanceof HTMLTextAreaElement) {
                        field.value = value;
                    }
                });
            } catch (error) {
                console.warn('No se pudieron restaurar los datos del formulario:', error);
            }
        }

        document.querySelectorAll('.form-basico .entrada .campo').forEach((field) => {
            const parent = field.closest('.entrada');
            if (!parent) return;

            const syncState = () => {
                const hasValue = field.type === 'file'
                    ? !!field.files && field.files.length > 0
                    : typeof field.value === 'string' && field.value.trim() !== '';

                parent.classList.toggle('is-filled', hasValue);
            };

            field.addEventListener('input', syncState);
            field.addEventListener('change', syncState);
            field.addEventListener('input', saveFormData);
            field.addEventListener('change', saveFormData);
            syncState();
        });

        restoreFormData();
        window.addEventListener('beforeunload', saveFormData);
        window.addEventListener('pagehide', saveFormData);
        window.addEventListener('pageshow', restoreFormData);
        window.addEventListener('load', restoreFormData);
        window.addEventListener('load', () => {
            setTimeout(restoreFormData, 100);
        });
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden') {
                saveFormData();
            }
        });
        document.querySelectorAll('.form-basico .entrada .campo').forEach((field) => {
            const parent = field.closest('.entrada');
            if (!parent) return;
            const syncState = () => {
                const hasValue = field.type === 'file'
                    ? !!field.files && field.files.length > 0
                    : typeof field.value === 'string' && field.value.trim() !== '';
                parent.classList.toggle('is-filled', hasValue);
            };
            syncState();
        });

        function prepararSiguiente(event) {
            event.preventDefault();

            const precioHora = document.getElementById('precio-hora');

            // Se guardan todos los campos antes de mostrar cualquier error.
            saveFormData();

            if (!precioHora.value || Number(precioHora.value) <= 0) {
                precioHora.setCustomValidity('Ingresa un precio por hora mayor que 0.');
            } else {
                precioHora.setCustomValidity('');
            }

            if (!form.checkValidity()) {
                form.reportValidity();
                return false;
            }

            window.location.href = nextButton.dataset.url;
            return false;
        }
    </script>

    @if(session('success'))
        <script>
            swal("¡Listo!", "{{ session('success') }}", "success");
        </script>
    @endif
</body>
</html>
