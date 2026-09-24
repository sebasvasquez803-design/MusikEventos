<!DOCTYPE html>
<html lang="en">
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
<body>
    <!-- Formulario para registrar grupos musicales en la base de datos. -->
        <header>
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

        <h1>REGISTRO DE GRUPOS MUSICALES</h1>
            <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
    </header>

    <div class="conte">
        <aside class="contenedor">
            <img class="img-contenedor" src="{{ asset('storage/img/inside.jpeg') }}" alt="barra lateral">
        </aside>

        <form class="form-basico" name="formulario" action="{{ route('grupo-musical.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="nit" value="">
            <input type="hidden" name="nombre_grupo" value="">
            <input type="hidden" name="telefono" value="">
            <input type="hidden" name="email" value="">
            <input type="hidden" name="descripcion" value="">
            <input type="hidden" name="id_subgenero" value="">
            <input type="hidden" name="precio_hora" value="">
            <h2> Información y Archivos Multimedia </h2>
        <div class="entrada">
                <label for="inputImagen">Portada del grupo</label>
                <input type="file" id="inputImagen" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('avatar') <small class="error">{{ $message }}</small> @enderror
        </div>

    <div class="entrada">
                <label for="inputLogo">Logo del grupo</label>
                <input type="file" id="inputLogo" name="logo" accept="image/jpeg,image/png,image/jpg,image/webp" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('logo') <small class="error">{{ $message }}</small> @enderror
        </div>


        <div class="entrada">
                <label>Video de presentación (link)</label>
                <input type="url" name="video_url" class="campo" value="{{ old('video_url') }}" placeholder="https://youtu.be/...">
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('video_url') <small class="error">{{ $message }}</small> @enderror
        </div>

          <div class="boton">
                <input type="submit" value="Registrar" name="botingresar">
            </div>
        </form>
    </div>

    <script>
        const form = document.forms.formulario;
        const storageKey = 'registro_grupo_data';
        const previousStepFields = ['nit', 'nombre_grupo', 'telefono', 'email', 'descripcion', 'id_subgenero', 'precio_hora'];

        function restoreHiddenFields() {
            const stored = localStorage.getItem(storageKey);
            if (!stored) return;

            try {
                const data = JSON.parse(stored);

                previousStepFields.forEach((key) => {
                    const field = form.elements.namedItem(key);
                    if (!field) return;
                    field.value = data[key] ?? '';
                });
            } catch (error) {
                console.warn('No se pudieron restaurar los datos del formulario:', error);
            }
        }

        function restoreFormData() {
            const stored = localStorage.getItem(storageKey);
            if (!stored) return;

            try {
                const data = JSON.parse(stored);
                Object.entries(data).forEach(([key, value]) => {
                    const field = form.elements.namedItem(key);
                    if (!field || field.type === 'file') return;
                    if (field instanceof HTMLInputElement || field instanceof HTMLTextAreaElement || field instanceof HTMLSelectElement) {
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
                    : field.value.trim() !== '';

                parent.classList.toggle('is-filled', hasValue);
            };

            field.addEventListener('input', syncState);
            field.addEventListener('change', syncState);
            syncState();
        });

        restoreHiddenFields();
        restoreFormData();
        function preserveStoredData() {
            const data = {};
            const stored = localStorage.getItem(storageKey);

            try {
                Object.assign(data, stored ? JSON.parse(stored) : {});
            } catch (error) {
                console.warn('No se pudieron conservar los datos del registro:', error);
            }

            localStorage.setItem(storageKey, JSON.stringify(data));
        }

        window.addEventListener('beforeunload', preserveStoredData);
        window.addEventListener('pagehide', preserveStoredData);
        window.addEventListener('pageshow', () => {
            restoreHiddenFields();
            restoreFormData();
        });
    </script>

    @if(session('success'))
        <script>
            swal("¡Listo!", "{{ session('success') }}", "success");
        </script>
    @endif
</body>
</html>
