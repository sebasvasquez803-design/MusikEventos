<?php
require './conexion.php';
$id = $_GET['id'] ?? die('No se recibió el número de documento.');

// Consultas rápidas para tener las variables listas para pintar
$usuario = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM persona WHERE numero_doc = '$id'")) ?? die('No se encontró el representante.');
$grupoData = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT nombre_grupo FROM grupo_musical WHERE numero_doc = '$id'"));
$nombre_grupo = $grupoData ? $grupoData['nombre_grupo'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_rep.css">
    <title>EDITAR REPRESENTANTE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body>
    <header><h1>BIENVENIDO A LA EDICIÓN DE REPRESENTANTE LEGAL</h1></header>
    <div class="contenido">
        <div class="banner_izq"><img src="../img/repepe.jpg" alt="banda_rep" class="banda_rep"></div>   
        
        <form class="form-basico" action="procesar_editar.php" method="POST" name="formulario">
            <div class="titulo"><h2>ACTUALIZAR DATOS DEL REPRESENTANTE</h2></div>

            <div class="entrada">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" class="campo" readonly style="background-color: #e9e9e9; cursor: not-allowed;" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>
            <div class="entrada">
                <label>Apellido:</label>
                <input type="text" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" class="campo" readonly style="background-color: #e9e9e9; cursor: not-allowed;" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>
            <div class="entrada">
                <label>EMAIL:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>
            <div class="entrada">
                <label>Número de Teléfono:</label>
                <input type="number" name="celular" value="<?php echo htmlspecialchars($usuario['celular']); ?>" class="campo" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
            </div>
            <div class="entrada">
                <label>Número de Documento:</label>
                <input type="number" name="documento" value="<?php echo htmlspecialchars($usuario['numero_doc']); ?>" class="campo" readonly style="background-color: #e9e9e9; cursor: not-allowed;" required>
                <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
                <select name="tipo_doc" style="background-color: #e9e9e9; pointer-events: none;">
                    <option value="RC" <?php if($usuario['tipo_doc'] == 'RC') echo 'selected'; ?>>RC</option>
                    <option value="CC" <?php if($usuario['tipo_doc'] == 'CC') echo 'selected'; ?>>CC</option>
                </select>
            </div>
            <div class="entrada">
                <label>Nombre del grupo que representa:</label>
                <textarea name="nombre_grupo" required><?php echo htmlspecialchars($nombre_grupo); ?></textarea>
            </div>
            <div class="entrada">
                <input type="checkbox" name="condiciones" value="aceptado" style="margin-left: 100px;">
                <a href="#">He leído y acepto las condiciones</a>
            </div>
            <div class="boton"><input type="submit" name="botactualizar" value="Actualizar" onclick="return validar()"></div>
        </form>
    </div>
<script>
    function validar() {
        if(document.formulario.email.value.trim() == "" || document.formulario.celular.value.trim() == "" || document.formulario.nombre_grupo.value.trim() == "") {
            swal({ title: '¡Oops!', text: 'Por favor, completa los campos modificables.', icon: 'error' });
            return false; 
        }
        if (document.formulario.condiciones.checked) return true;
        swal({ title: '¡Oops!', text: 'Debes aceptar las condiciones para continuar', icon: 'error' });
        return false; 
    }
</script>
<footer>
    <div class="contenedor-footer">
        <div class="info">
            <p>Somos una empresa dedicada a la organización de eventos musicales. ¡¡ VIVE LA MUSICA, VIVE TUS EVENTOS !!</p>
        </div>
        <div class="info1">
            <div class="redes_sociales">
                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="direccion"><p>calle 50 # 2-90 Soacha | copyright 2026</p></div>
</footer>
</body>
</html>