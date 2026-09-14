<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/estilo_reg_grupo.css')
    <title>Actualizar Grupo Musical</title>
</head>
<body>
    <!-- Formulario administrativo para actualizar un grupo existente. -->
    <header>
        <a href="{{ route('home') }}">
            <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
        </a>
        <h1>ACTUALIZAR GRUPO MUSICAL</h1>
    </header>

    <div class="conte">
        <aside class="contenedor">
            <img class="img-contenedor" src="{{ asset('storage/img/inside.jpeg') }}" alt="{{ $grupoMusical->nombre_grupo }}">
        </aside>

        <form class="form-basico" action="{{ route('grupo-musical.update', $grupoMusical) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="entrada">
                <label>NIT</label>
                <input type="text" class="campo" value="{{ $grupoMusical->nit }}" readonly>
            </div>

            <div class="entrada">
                <label>Nombre Del Grupo</label>
                <input type="text" name="nombre_grupo" class="campo" value="{{ old('nombre_grupo', $grupoMusical->nombre_grupo) }}" required>
                @error('nombre_grupo') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Telefono</label>
                <input type="text" name="telefono" class="campo" value="{{ old('telefono', $grupoMusical->telefono) }}" required>
                @error('telefono') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Email</label>
                <input type="email" name="email" class="campo" value="{{ old('email', $grupoMusical->email) }}" required>
                @error('email') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label for="inputImagen">Nueva imagen (opcional)</label>
                <input type="file" id="inputImagen" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="campo">
                @error('avatar') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Descripcion</label>
                <textarea name="descripcion" class="campo">{{ old('descripcion', $grupoMusical->descripcion) }}</textarea>
                @error('descripcion') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="entrada">
                <label>Precio por hora</label>
                <input type="number" name="precio_hora" class="campo" value="{{ old('precio_hora', $grupoMusical->precio_hora) }}">
                @error('precio_hora') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="boton">
                <input type="submit" value="Actualizar">
            </div>
        </form>
    </div>
</body>
</html>
