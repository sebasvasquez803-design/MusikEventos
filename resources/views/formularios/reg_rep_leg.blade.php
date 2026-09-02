<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      @vite ('resources/css/estilos_rep.css')
    <title>FORMULARIO REGISTRO REPRESENTANTE LEGAL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Importación de SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/musik.js"></script>
</head>
<body>
  <!--Encabezado del sitio-->
    <header>
         <h1>BIENVENIDO AL REGISTRO DE REPRESENTANTE LEGAL</h1>          
    </header>
<div class="contenido">
 <!--Banner izquierda-->
        <div class="banner_izq">
            <img src="../img/repepe.jpg" alt="banda_rep" class="banda_rep">
        </div>   
 <!--formulario conectado a tu PHP-->       
<form class="form-basico" action="registrar_representante.php" method="POST" name="formulario">
        <div class="titulo">
            <h2>REGISTRO DEL REPRESENTANTE</h2>
        </div>
<!--campos del formulario con sus atributos name listos-->
        <div class="entrada">
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Ej. Sebastian" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        </div>
        <div class="entrada">
            <label>Apellido:</label>
            <input type="text" name="apellido" placeholder="Ej. Vasquez" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        </div>
        <div class="entrada">
            <label>EMAIL:</label>
            <input type="email" name="email" placeholder="Ejemplo@email.com" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        </div>
        <div class="entrada">
            <label>Número de Teléfono:</label>
            <input type="number" name="celular" placeholder="Ej. 3001234567" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        </div>

        <div class="entrada">
            <label>Número de Documento:</label>
            <input type="number" name="documento" placeholder="Ej. 123456789" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>

            <select name="tipo_doc">
                <option value="RC">RC</option>
                <option value="CC" selected>CC</option>
            </select>
        </div>

        <div class="entrada">
            <label>Fecha De Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        </div>

        <div class="entrada">
            <label>Nombre del grupo que representa:</label>
            <textarea name="nombre_grupo" placeholder="Nombre del grupo" required></textarea>
        </div>

        <div class="entrada">
            <label>Carta de nombramiento:</label>
            <input type="file" name="file">
        </div>
        
        <div class="entrada">
            <input type="checkbox" name="condiciones" value="aceptado" style="margin-left: 100px;">
            <a href="#">He leído y acepto las condiciones</a>
        </div>
        <!--botón tipo submit para disparar el PHP tras validar-->
        <div class="boton">
            <input type="submit" name="botregistrar" value="Registrar" onclick="return validar()">
        </div>
    </form><!--cierre del formulario-->
</div><!--cierre div contenido-->

<script>
    function validar() {
        var opcion = document.formulario.condiciones; 
        
        // Obtenemos los valores de los inputs obligatorios
        var nombre = document.formulario.nombre.value;
        var apellido = document.formulario.apellido.value;
        var documento = document.formulario.documento.value;
        var grupo = document.formulario.nombre_grupo.value;

        // Validamos campos vacíos en el Frontend
        if(nombre.trim() == "" || apellido.trim() == "" || documento.trim() == "" || grupo.trim() == "") {
            swal({
                title: '¡Oops!',
                text: 'Por favor, completa todos los campos del representante y del grupo.',
                icon: 'error'
            });
            return false; 
        }

        // Validamos que acepte los términos y condiciones
        if (opcion.checked == true) { 
            return true; 
        } else {
            swal({
                title: '¡Oops!',
                text: 'Debes aceptar las condiciones para continuar',
                icon: 'error'
            });
            return false; 
        }
    }
</script>

<!--pie de pagina-->
<footer>
    <div class="contenedor-footer">
        <div class="info">
            <h2 class="titulo_footer1">Acerca De Nosotros</h2>
            <p>Somos una empresa dedicada a la organización de eventos musicales, con más de 10 años de experiencia en el sector.</p>
            <br>
            <p>¡¡ VIVE LA MUSICA, VIVE TUS EVENTOS !!</p>
        </div>

        <div class="info1">
            <h2 class="titulo_footer2">Contáctenos</h2>
            <div class="redes_sociales">
                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="form/contactenos.php"><i class="fa-solid fa-file-lines"></i></a>
            </div>
        </div>
    </div>
    
    <div class="direccion">
       <p><strong>Dirección:</strong> calle 50 # 2-90 Soacha <br><i class="fa-sharp fa-regular fa-copyright"></i> copyright 2026</p>
    </div>
</footer>
</body>
</html>