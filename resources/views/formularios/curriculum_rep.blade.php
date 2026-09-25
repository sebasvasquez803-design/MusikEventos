<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo del representante</title>
    @vite('resources/css/sesion_rep.css')
</head>
<body>
    <header>
        <a href="{{ route('home') }}" class="button" aria-label="Volver al inicio">
            <div class="button-box">
                <span class="button-elem">
                    <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg"><path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path></svg>
                </span>
            </div>
        </a>
        <h1>CURRÍCULO DEL REPRESENTANTE</h1>
        <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="MusikEventos">
    </header>

    <div class="conte">
        <aside class="contenedor">
            <img class="img-contenedor" src="{{ asset('storage/img/inside.jpeg') }}" alt="Instrumentos musicales">
        </aside>

        <form class="form-basico" action="{{ route('curriculum.rep.store') }}" method="POST">
            @csrf
            <input type="hidden" name="nombre" value="{{ auth()->user()->name ?? '' }}">
            <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">
            <div class="titulo"><h2>INFORMACIÓN DEL CURRÍCULO</h2></div>
            <div class="entrada"><label for="nombre">Nombre completo</label><input id="nombre" type="text" name="nombre_visible" maxlength="100" class="campo" value="{{ auth()->user()->name ?? '' }}" disabled></div>
            <div class="entrada"><label for="apellido">Apellido</label><input id="apellido" type="text" name="apellido" maxlength="25" class="campo"></div>

            <div class="entrada"><label for="numero_doc">Número de documento</label><input id="numero_doc" type="text" name="numero_doc" maxlength="10" inputmode="numeric" class="campo" required></div>
            <div class="entrada"><label for="anio_inicio">Año de inicio</label><input id="anio_inicio" type="number" name="anio_inicio" min="1900" max="2100" class="campo"></div>
            <div class="entrada"><label for="anio_fin">Año de finalización</label><input id="anio_fin" type="number" name="anio_fin" min="1900" max="2100" class="campo"></div>
            <div class="entrada"><label for="eventos_realizados">Eventos realizados</label><input id="eventos_realizados" type="number" name="eventos_realizados" min="0" class="campo"></div>
            <div class="entrada"><label for="titulo_obtenido">Título obtenido</label><textarea id="titulo_obtenido" name="titulo_obtenido" maxlength="300" class="campo" rows="2"></textarea></div>
            <div class="entrada"><label for="habilidades_principales">Habilidades principales</label><input id="habilidades_principales" type="text" name="habilidades_principales" maxlength="150" class="campo"></div>
            <div class="entrada"><label for="academia_formacion">Academia o formación</label><input id="academia_formacion" type="text" name="academia_formacion" maxlength="50" class="campo"></div>
            <div class="entrada"><label for="estudios">Estudios</label><input id="estudios" type="text" name="estudios" maxlength="100" class="campo"></div>
            <div class="entrada"><label for="publico_privado">Público o privado</label><select id="publico_privado" name="publico_privado" class="campo"><option value="">Selecciona una opción</option><option value="publico">Público</option><option value="privado">Privado</option><option value="ambos">Ambos</option></select></div>

            <div class="boton"><input type="submit" value="Guardar"></div>
        </form>
    </div>
</body>
</html>
