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
                <span class="registro-visual__eyebrow"><i class="fa-solid fa-sparkles" aria-hidden="true"></i> CASI ESTÁ TODO LISTO</span>
                <h1>Muéstrales<br>quiénes son.</h1>
                <p>Una buena imagen ayuda a que tu grupo destaque. Sube una portada y un logo para completar tu perfil.</p>
                <div class="registro-visual__note">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    <span>Último paso: revisa tus archivos antes de registrar.</span>
                </div>
            </div>
        </aside>

        <form class="form-basico registro-form-step-two" name="formulario" action="{{ route('grupo-musical.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="nit" value="">
            <input type="hidden" name="nombre_grupo" value="">
            <input type="hidden" name="telefono" value="">
            <input type="hidden" name="email" value="">
            <input type="hidden" name="descripcion" value="">
            <input type="hidden" name="id_subgenero" value="">
            <input type="hidden" name="precio_hora" value="">

            <div class="form-heading">
                <span class="form-heading__step">PASO 2 <span>DE 2</span></span>
                <h2>Agrega imágenes a tu perfil</h2>
                <p>Sube una portada y el logo de tu grupo. El video de presentación es opcional.</p>
            </div>

            <div class="form-fields registro-media-fields">
                <div class="entrada registro-upload-entry">
                    <label for="inputImagen">Portada del grupo <span>Requerida</span></label>
                    <label class="registro-upload-card" for="inputImagen">
                        <input type="file" id="inputImagen" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="campo" required aria-describedby="portada-ayuda">
                        <span class="registro-upload-card__preview" data-preview="inputImagen">
                            <i class="fa-regular fa-image" aria-hidden="true"></i>
                        </span>
                        <span class="registro-upload-card__copy">
                            <strong data-file-name="inputImagen">Elige una imagen de portada</strong>
                            <small id="portada-ayuda">JPG, PNG o WEBP · hasta 2 MB</small>
                            <span class="registro-upload-card__action"><i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i> Seleccionar archivo</span>
                        </span>
                    </label>
                    @error('avatar') <small class="error">{{ $message }}</small> @enderror
                </div>

                <div class="entrada registro-upload-entry">
                    <label for="inputLogo">Logo del grupo <span>Requerido</span></label>
                    <label class="registro-upload-card registro-upload-card--logo" for="inputLogo">
                        <input type="file" id="inputLogo" name="logo" accept="image/jpeg,image/png,image/jpg,image/webp" class="campo" required aria-describedby="logo-ayuda">
                        <span class="registro-upload-card__preview" data-preview="inputLogo">
                            <i class="fa-solid fa-music" aria-hidden="true"></i>
                        </span>
                        <span class="registro-upload-card__copy">
                            <strong data-file-name="inputLogo">Elige el logo de tu grupo</strong>
                            <small id="logo-ayuda">JPG, PNG o WEBP · hasta 2 MB</small>
                            <span class="registro-upload-card__action"><i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i> Seleccionar archivo</span>
                        </span>
                    </label>
                    @error('logo') <small class="error">{{ $message }}</small> @enderror
                </div>

                <div class="entrada entrada--wide registro-video-entry">
                    <label for="video-url">Video de presentación <span>Opcional</span></label>
                    <div class="campo-wrap">
                        <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                        <input type="url" id="video-url" name="video_url" class="campo" value="{{ old('video_url') }}" placeholder="https://youtu.be/...">
                    </div>
                    <small class="registro-field-hint">Comparte un enlace de YouTube para que puedan conocerlos en acción.</small>
                    @error('video_url') <small class="error">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="registro-submit-row">
                <a class="registro-back-link" href="{{ route('grupo.musical') }}">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    Volver al paso anterior
                </a>
                <button type="submit" class="registro-submit-button" name="botingresar">
                    <span>Registrar grupo</span>
                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </main>

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

        document.querySelectorAll('.registro-upload-card input[type="file"]').forEach((field) => {
            field.addEventListener('change', () => {
                const file = field.files && field.files[0];
                const preview = document.querySelector(`[data-preview="${field.id}"]`);
                const fileName = document.querySelector(`[data-file-name="${field.id}"]`);
                const card = field.closest('.registro-upload-card');
                if (!preview || !fileName || !card) return;

                const previousPreview = preview.querySelector('img');
                if (previousPreview?.src.startsWith('blob:')) {
                    URL.revokeObjectURL(previousPreview.src);
                }
                preview.replaceChildren();
                if (file) {
                    const image = document.createElement('img');
                    image.alt = '';
                    image.src = URL.createObjectURL(file);
                    preview.append(image);
                    fileName.textContent = file.name;
                    card.classList.add('has-file');
                } else {
                    const icon = document.createElement('i');
                    icon.className = field.id === 'inputImagen' ? 'fa-regular fa-image' : 'fa-solid fa-music';
                    icon.setAttribute('aria-hidden', 'true');
                    preview.append(icon);
                    fileName.textContent = field.id === 'inputImagen' ? 'Elige una imagen de portada' : 'Elige el logo de tu grupo';
                    card.classList.remove('has-file');
                }
            });
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

            const videoUrl = form.elements.namedItem('video_url');
            if (videoUrl) data.video_url = videoUrl.value;
            localStorage.setItem(storageKey, JSON.stringify(data));
        }

        const videoField = form.elements.namedItem('video_url');
        if (videoField) {
            videoField.addEventListener('input', preserveStoredData);
            videoField.addEventListener('change', preserveStoredData);
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
