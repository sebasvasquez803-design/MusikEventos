<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Representante Legal</title>

    <link rel="stylesheet" href="../css/sesion_rep.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
    <!-- ENCABEZADO -->
    <header>
        <div class="logo">
        <img class="logo" src="../img/logoMusikEventos.png" alt="logo">
        </div>
        <div class="texto_logo">
            <h2>REPRESENTANTE LEGAL</h2>
        </div>
    </header>

    <!-- CONTENIDO -->
    <div class="contenido">

        <!-- PANEL IZQUIERDO -->
        <div class="panel_izquierdo">
            <div class="foto_perfil">
                <i class="fa-solid fa-camera"></i>
                <p>Foto de perfil / Logo</p>
            </div>

            <div class="mensaje">
                <h2>¡Bienvenido!</h2>

                <p>Responde todos los campos solicitados para iniciar sesión como representante legal y administrar la información detu grupo musical.
                </p>
            </div>
        </div>

        <!-- LOGIN -->
        <div class="login">
            <form action="#">
                <h2>INICIAR SESIÓN</h2>
                <div class="entrada">
                    <label>Usuario (Correo Electrónico)</label>
                    <div class="campo">
                        <i class="fa-solid fa-user"></i>
                        <input
                            type="email"
                            placeholder="Ej. representante@gmail.com"
                            required>
                    </div>
                </div>

                <div class="entrada">
                    <label>Contraseña</label>
                    <div class="campo">
                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            placeholder="Ingrese su contraseña"
                            required>
                    </div>
                </div>

                <div class="recordar">
                    <input
                        type="checkbox"
                        id="recordar">
                    <label for="recordar">
                        Recordar sesión
                    </label>
                </div>

                <div class="olvido">
                    <a href="#">
                        ¿Olvidó su contraseña?
                    </a>
                </div>

                <div class="boton">
                    <input
                        type="button"
                        value="INICIAR SESIÓN"
                        onclick="validar()">
                </div>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="contenedor-footer">
            <div class="info">
                <h2>Acerca De Nosotros</h2>
                <p>
                    Somos una empresa dedicada a la organización de eventos
                    musicales con más de 10 años de experiencia en el sector.
                    Vive la música, vive tus eventos.
                </p>
            </div>
            <div class="info1">
                <h2>Contáctenos</h2>
                <div class="redes_sociales">
                    <a href="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2F%3Flocale%3Des_LA">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/accounts/login/">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://web.whatsapp.com/">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="direccion">
            <p>
                <strong>Dirección</strong> Calle 50 #2-90 Soacha
                <br>
                <i class="fa-regular fa-copyright"></i>
                Copyright 2026
            </p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/sesion_rep.js"></script>
</body>
</html>