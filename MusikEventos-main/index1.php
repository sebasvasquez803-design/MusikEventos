<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../MusikEventos-main/css/style.css">
    <title>principal</title>
    <link rel="shortcut icon" href="img/logoMusikEventos.png" type="image/x-icon">
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
            <li><a href="dash_rep.php">UNETE COMO GRUPO MUSICAL</a></li>
            <li><a href="#">CALENDARIO</a></li>
            <li><a href="formularios/reg_eventos.php">RESERVA AQUI</a></li>
            <div class="carro">
                <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="usuario">
                <a href="formularios/REGISTRO DE CLIENTES.php"><i class="fa-solid fa-circle-user"></i></a>
            </div>
        </ul>
    </div>

    <!-- Logo -->
    <a href="./index.php">
        <img class="logo" src="../MusikEventos-main/img/logoMusikEventos.png" alt="logo">
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

            <!-- CARD 1 -->
            <div class="contenedor">
                <!-- Imagen con texto encima -->
                <div class="img-contenedor">
                    <a href="./index1.php">
                        <img class="img_art" src="img/arcangel.jpg" alt="Arcangel">
                    </a>
                    <div class="img-texto">
                        <p>Arcangel</p>
                        <p>Urbano - 1 Integrante</p>
                    </div>
                </div>
                <p class="descripcion">Una leyenda viva del genero urbano. Su Flow inconfundible y su lista de exitos iconicos aseguran un show de clase mundial y maximo prestigio para tu evento.</p>
                <div class="boton">
                    <input type="button" value="Mas Informacion" onclick="">
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="contenedor">
                <div class="img-contenedor">
                    <a href="#">
                        <img class="img_art" src="../MusikEventos-main/img/la33.jpeg" alt="Artista 2">
                    </a>
                    <div class="img-texto">
                        <p>LA 33</p>
                        <p>Salsa - 12 Integrantes</p>
                    </div>
                </div>
                <p class="descripcion">La-33 es una famosa orquesta colombiana de salsa urbana fundada en Bogotá en 2001. Su nombre proviene de una casa en la Calle 33 del barrio Teusaquillo donde ensayaban inicialmente. La banda combina ritmos caribeños, como la Salsa brava.</p>
                <div class="boton">
                    <input type="button" value="Mas Informacion" onclick="">
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="contenedor">
                <div class="img-contenedor">
                    <a href="#">
                        <img class="img_art" src="../MusikEventos-main/img/yatra.jpeg" alt="Artista 3">
                    </a>
                    <div class="img-texto">
                        <p>Sebastian Yatra</p>
                        <p>POP - 1 Integrante</p>
                    </div>
                </div>
                <p class="descripcion"> Sebastián Yatra, es un cantante, compositor y actor colombiano.​ Se caracteriza por sus letras románticas, fusionando el lirismo tradicional con las influencias del reguetón moderno.</p>
                <div class="boton">
                    <input type="button" value="Mas Informacion" onclick="">
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="contenedor">
                <div class="img-contenedor">
                    <a href="#">
                        <img class="img_art" src="../MusikEventos-main/img/mañas.jpeg" alt="Artista 4">
                    </a>
                    <div class="img-texto">
                        <p>Mañas Rufiño</p>
                        <p>Hip Hop, RAP - 1 Integrante</p>
                    </div>
                </div>
                <p class="descripcion"> Mañas Ru-Fino, es un destacado rapero y compositor colombiano originario de Envigado, Antioquia. Es ampliamente reconocido por ser el cofundador de Doble Porción, uno de los grupos de hip-hop underground más influyentes de Colombia.</p>
                <div class="boton">
                    <input type="button" value="Mas Informacion" onclick="">
                </div>
            </div>

            <!-- CARD 5 -->
            <div class="contenedor">
                <div class="img-contenedor">
                    <a href="#">
                        <img class="img_art" src="../MusikEventos-main/img/grupo_firme.jpeg" alt="Artista 5">
                    </a>
                    <div class="img-texto">
                        <p>Grupo Firme</p>
                        <p>Banda, Norteno, Corridos - 6 Integrantes</p>
                    </div>
                </div>
                <p class="descripcion"> Grupo Firme es una de las agrupaciones más influyentes y exitosas de la música regional mexicana en la actualidad. Originaria de Tijuana, Baja California, destacados por su energía en el escenario, colaboraciones masivas y un repertorio lleno de éxitos que mezclan el género de banda, norteño y corridos.</p>
                <div class="boton">
                    <input type="button" value="Mas Informacion" onclick="">
                </div>
            </div>

            <!-- CARD 6 -->
            <div class="contenedor">
                <div class="img-contenedor">
                    <a href="#">
                        <img class="img_art" src="../MusikEventos-main/img/metallica.jpeg" alt="Artista 6">
                    </a>
                    <div class="img-texto">
                        <p>Metallica</p>
                        <p>Rock, Metal - 4 Integrantes</p>
                    </div>
                </div>
                <p class="descripcion"> Metallica es una de las bandas de heavy metal más exitosas e influyentes de la historia, con más de 125 millones de álbumes vendidos a nivel mundial. Fundada en 1981 en Los Ángeles por el baterista Lars Ulrich y el vocalista/guitarrista rítmico James Hetfield, el grupo se convirtió en el pilar fundamental del thrash metal.</p>
                <div class="boton">
                    <input type="button" value="Mas Informacion" onclick="">
                </div>
            </div>

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



<script src="../MusikEventos-main/js/transicion.js"></script>
</body>
</html>