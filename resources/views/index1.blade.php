<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/style.css')
    <title>principal</title>
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

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
                <a href="{{ route('registro.clientes') }}"><i class="fa-solid fa-circle-user"></i></a>
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
            <li><a href="#"><strong>DESCUBRIR</strong></a></li>
            <li><a href="#">POP</a></li>
            <li><a href="#">REGGAETON</a></li>
            <li><a href="#">ROCK</a></li>
            <li><a href="#">ELECTRONICA</a></li>
            <li><a href="#">SALSA</a></li>
            <li><a href="#">BACHATA</a></li>
            <li><a href="#">VALLENATO</a></li>
            <li><a href="#">CUMBIA</a></li>
            <li><a href="#">RANCHERA</a></li>
        </ul>
    </div>

    <!-- Contenido principal: buscador + cards -->
    <div class="contenido-principal">

        <!-- Barra de busqueda -->
        <div class="barra-busqueda">
            <input type="text" placeholder="Busca tu grupo de genero">
            <button>Buscar</button>
        </div>

        <!-- Grid de cards de artistas -->
        <div class="grid-cards">

        @forelse ($grupos as $grupo)
        <div class="contenedor">
            <div class="img-contenedor">
                <img class="img_art" src="{{ $grupo->avatar_url ?? asset('storage/img/inside.jpeg') }}" alt="{{ $grupo->nombre_grupo }}">
                <div class="img-texto">
                    <p>{{ $grupo->nombre_grupo }}</p>
                    <p>Grupo musical</p>
                </div>
            </div>
            <p class="descripcion">{{ $grupo->descripcion ?: 'Grupo musical disponible para eventos.' }}</p>
            <div class="boton">
                <input type="button" value="Mas Informacion" onclick="">
            </div>
        </div>
        @empty
            <p>No hay grupos musicales registrados.</p>
        @endforelse

        </div><!-- fin grid-cards -->

        <!-- Paginacion -->
        <div class="paginacion">
            <a href="#">Atras</a>
            <a href="#" class="activo">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <span>...</span>
            <a href="#">67</a>
            <a href="#">68</a>
            <a href="#">Siguiente</a>
        </div>

    </div><!-- fin contenido-principal -->

</div><!-- fin layout -->

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
