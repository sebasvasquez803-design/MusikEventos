<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_instrumentos.css">
    <title>God</title>
    <link rel="shortcut icon" href="../img/musikeveentos.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="styles63.+x/libs/font-awesome/7.0.1/css/all.min.css" 
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/validacion.js"></script>
</head>
</head>
<body>
<div class="layout"> 
    <div class="contenido">
        <div class="menu">
            <a href="../index1.php" id="logo"><img class="logo" src="../img/musikeveentos.png" alt="logo"></a>
            <ul>
                <li><a href="./form/registro.php">Inicio</a></li>
                <li><a href="./validacion.php">Perfil</a></li>
            </ul>
            <div class="contenido_menu">
                <h1>Bienvenido al registros de instrumentos</h1>
                <p>En MUSIKEVENTOS, tú tienes el control total. 
                    Define un precio de alquiler justo basado en la calidad de tu equipo y establece un monto de garantía que asegure tu tranquilidad. 
                    Tu instrumento es una inversión, y nosotros te ayudamos a protegerla mientras generas ingresos extra.
            </div>
        </div>

        <form action="#" class="form-basico">
            <div class="entrada">
                <h2>Registra tu instrumento</h2>
            </div>
            <div class="entrada">
                <h2>Informacion del dueño del intrumento</h2>
            </div>
            <div>
                <div class="Entrada">
                    <label>Escriba su nombre</label>
                    <input type="text" id="nombre" placeholder="Digite el Instrumento">
                </div>
                <div class="Entrada">
                    <label>Escriba su apellido</label>
                    <input type="text" id="apellido" placeholder="Digite el Instrumento">
                </div>
                <div class="Entrada">
                    <label>Escriba su usuario</label>
                    <input type="text" id="usuario" placeholder="Digite el usuario">
                </div>
                <div class="Entrada">
                    <label>Escriba su contraseña de usuario</label>
                    <input type="text" id="contraseña" placeholder="Digite las contraseña">
                </div>
                <div class="Entrada">
                    <label>Escriba su número de telefono</label>
                    <input type="number" id="telefono" placeholder="Digite su telefono (10 digitos)">
                </div>
                <div class="Entrada">
                    <label>Escriba su correo</label>
                    <label><input type="email" id="correo" placeholder="Ejemplo@gmial.com"></label>
                </div>
                <div class="Entrada">
                    <label>Escriba su número de documento de indentidad</label>
                    <input type="number" id="indentidad" placeholder="Digite el documento">
                </div>
                <div class="Entrada">
                    <label>Tipo de documento</label>
                    <div class="opciones" id="tipo_doc">
                        <label><input type="radio" name="opc" value="C.C"> <span>C.C</span></label>
                        <label><input type="radio" name="opc" value="T.I"> <span>T.I</span></label>
                        <label><input type="radio" name="opc" value="R.I"> <span>R.I</span></label>
                    </div>
                </div>
                <div class="entrada">
                    <h2>Informacion del instrumento</h2>
                </div>
                <div class="Entrada">
                    <label>Escriba la marca del instrumento</label>
                    <label><input type="text" id="marca" placeholder="Digite la marca"></label>
                </div>
                <div class="Entrada">
                    <label>Escriba su modelo</label>
                    <label><input type="text" id="modelo" placeholder="Digite su modelo"></label>
                </div>
                <div class="Entrada">
                    <label>Escriba su número de serie</label>
                    <label><input type="text" id="serie" placeholder="Digite su serie"></label>
                </div>
                <div class="Entrada">
                    <label>Escriba el estado del instrumento</label>
                    <label><input type="text" id="estado" placeholder="Digite el estado general"></label>
                </div>
                <div class="Entrada">
                    <label>Ponga imagenes del intrumento</label>
                    <input type="file" id="iamgenes" placeholder="fotos del instrumento">
                </div>
                <div class="entrada">
                    <h2>Informacion del valor del intrumento</h2>
                </div>
                <div class="Entrada">
                    <label>Escriba el valor por dia del instrumento</label>
                    <label><input type="number" id="precio" placeholder="Digite valor del instrumento"></label>
                </div>
                <div class="Entrada">
                    <label>Escriba el monto del la garantia</label>
                    <input type="text" id="garantia" placeholder="Digite el monto de garantia">
                </div>
                <div class="Entrada">
                    <label>Escriba una descripcion del instrumento</label>
                    <input type="text" id="descripcion" placeholder="Digite la descripcion">
                </div>
                <div class="Boton">
                    <button type="button" class="Boton" onclick="validacion()">Enviar Datos</button>
                </div>
            </div>
        </form>
    </div> </div>