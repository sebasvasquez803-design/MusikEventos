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
        <a href="{{ route('home') }}">
            <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
        </a>
        <h1>REGISTRO DE GRUPOS MUSICALES</h1>
    </header>

    <div class="conte">
        <aside class="contenedor">
            <img class="img-contenedor" src="{{ asset('storage/img/inside.jpeg') }}" alt="barra lateral">
        </aside>

        <form class="form-basico" name="formulario" action="{{ route('grupo-musical.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="entrada">
                <label>NIT</label>
                <input type="text" placeholder="Ejemplo: 123456789" name="nit" class="campo" value="{{ old('nit') }}" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('nit') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Nombre Del Grupo</label>
                <input type="text" placeholder="Nombre del grupo" name="nombre_grupo" class="campo" value="{{ old('nombre_grupo') }}" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('nombre_grupo') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Telefono</label>
                <input type="text" placeholder="Número de teléfono" name="telefono" class="campo" value="{{ old('telefono') }}" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('telefono') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Email</label>
                <input type="email" placeholder="Ejemplo@email.com" name="email" class="campo" value="{{ old('email') }}" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('email') <small class="error">{{ $message }}</small> @enderror
            </div>


            <div class="entrada">
                <label>Descripcion</label>
                <textarea name="descripcion" required class="campo">{{ old('descripcion') }}</textarea>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('descripcion') <small class="error">{{ $message }}</small> @enderror
            </div>

         <div class="entrada">
                <label>Subgénero</label>
                <select name="id_subgenero" class="campo" required>
                    <option value="">Selecciona un subgénero</option>
                    @foreach(\DB::table('subgenero')->orderBy('nombre_subgenero')->get() as $s)
                        <option value="{{ $s->id_subgenero }}" {{ old('id_subgenero') == $s->id_subgenero ? 'selected' : '' }}>{{ $s->nombre_subgenero }} @if($s->id_genero) ({{ \DB::table('genero')->where('id_genero', $s->id_genero)->value('nombre_genero') }}) @endif</option>
                    @endforeach
                </select>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('id_subgenero') <small class="error">{{ $message }}</small> @enderror
            </div>
            <div class="entrada">
                <label>Subgénero</label>
                <select name="id_subgenero" class="campo" required>
                    <option value="">Selecciona un subgénero</option>
                    @foreach(\DB::table('subgenero')->orderBy('nombre_subgenero')->get() as $s)
                        <option value="{{ $s->id_subgenero }}" {{ old('id_subgenero') == $s->id_subgenero ? 'selected' : '' }}>{{ $s->nombre_subgenero }} @if($s->id_genero) ({{ \DB::table('genero')->where('id_genero', $s->id_genero)->value('nombre_genero') }}) @endif</option>
                    @endforeach
                </select>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('id_subgenero') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Precio por hora</label>
                <input type="number" placeholder="Ejemplo: 100.00" name="precio_hora" class="campo" value="{{ old('precio_hora') }}" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                @error('precio_hora') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="boton">
                <a href="{{ route('siguiente') }}"
                <button type="button">Siguiente</button>
            </div>
        </form>
    </div>

    <script>
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
    </script>

    @if(session('success'))
        <script>
            swal("¡Listo!", "{{ session('success') }}", "success");
        </script>
    @endif
</body>
</html>
