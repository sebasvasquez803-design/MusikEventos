<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   @vite('resources/css/RESERVA.css')
    <title>FORMULARIO RESERVA DE EVENTO</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
         integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity=
        "sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../js/musik.js"></script>
<!--funcion de js para mensaje por pantalla-->

</head>
<body>
  <!--Encabezado del sitio-->
    <header>
          <h1>BIENVENIDO A LA RESERVA DE EVENTOS</h1>
    </header>
<div class="panel_fondo">
    <div class="contenido">
    <!--Banner izquierda-->
    <!--formulario-->
        <form class="form-basico" action="#">
            <div class="titulo">
                <h2>RESERVA DE EVENTO</h2>
            </div>


            <!--numero_doc -->
            <div class="entrada">
                <label>Numero de Documento (quien reserva):</label>
                <input type="number" placeholder="Ej. 123456789" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>

            <!-- nit -->
            <div class="entrada">
                <label>NIT del grupo musical:</label>
                <input type="number" placeholder="Ej. 900123456" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>

            <!--fecha-->
            <div class="entrada">
                <label>Fecha del evento:</label>
                <input type="date" placeholder="Fecha del evento" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>

            <!--hora-->
            <div class="entrada">
                <label>Hora del evento:</label>
                <input type="time" placeholder="Hora del evento" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>

            <!--direccion-->
            <div class="entrada">
                <label>Direccion del evento:</label>
                <input type="text" placeholder="Ej. Calle 50 # 2-90 Soacha" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>

            <!--valor-->
            <div class="entrada">
                <label>Valor acordado:</label>
                <input type="text" placeholder="Ej. $500.000" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>

            <!--condiciones-->
            <div class="entrada">
                <input type="checkbox" name="condiciones" value="aceptado"
                style="margin-left: 100px;"><a href=""> He leido y acepto las condiciones</a>
            </div>
            <!--boton del formulario-->
            <div class="boton">
                <input type="button" value="Reservar" onclick="validar()">
            </div>
        </form><!--cierre del formulario-->
    </div><!--cierre del formulario-->
</div>

<!--pie de pagina-->
<footer>
         <div class="contenedor-footer">
        <div class="info">
            <h2 class="titulo_footer1">Acerca De Nosotros</h2>
            <p>Somos una empresa dedicada a la organización de eventos musicales, con más de 10 años de experiencia en el sector. VIVE LA MUSICA, VIVE TUS EVENTOS</p>
        </div>

        <div class="info1">
            <h2 class="titulo_footer2">Contactenos</h2>
            <div class="redes_sociales">
               <a href="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2F%3Flocale%3Des_LA"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/accounts/login/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="form/contactenos.php"><i class="fa-solid fa-file-lines"></i></a>
            </div>
        </div>
    </div>


    <div class="direccion">
       <p><strong>Direccion</strong> calle 50 # 2-90 Soacha   <br><i class="fa-sharp fa-regular fa-copyright"></i>copyrigth 2026</p>
    </div>
</footer>
</body>
</html>
