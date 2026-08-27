<?php
require './conexion.php';

// Capturamos lo que el usuario digite en el buscador
$valor = '';
if (!empty($_POST['dato'])) {
    $valor = trim($_POST['dato']);
}

// Si busca algo, filtramos en la tabla 'persona' por nombre, apellido o email
if ($valor !== '') {
    $resultado_usuarios = mysqli_query($conexion, "SELECT * FROM persona WHERE nombre LIKE '%$valor%' OR apellido LIKE '%$valor%' OR email LIKE '%$valor%'");
} else {
    // Si no busca nada, trae a todas las personas de la lista
    $resultado_usuarios = mysqli_query($conexion, "SELECT * FROM persona");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>

    <!-- Ruta arreglada: Sube un nivel con ../ y busca 'estilos.css' -->
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>

<div class="contenido">

    <div class="boxers">

        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de documento</th>
                    <th>Numero de documento</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th> <!-- Columna para los dos botones -->
                </tr>
            </thead>

            <tbody>
            <?php
            if ($resultado_usuarios) {
                while($row_user = mysqli_fetch_array($resultado_usuarios, MYSQLI_ASSOC)){
            ?>
                <tr>
                    <td><?php echo $row_user['nombre']; ?></td>
                    <td><?php echo $row_user['apellido']; ?></td>
                    <td><?php echo $row_user['tipo_doc']; ?></td>
                    <td><?php echo $row_user['numero_doc']; ?></td>
                    <td><?php echo $row_user['email']; ?></td>
                    <td><?php echo $row_user['id_tipo_persona']; ?></td>
                    <td>
                        <!-- Botón Editar -->
                        <a href="editar_representante.php?id=<?php echo $row_user['numero_doc']; ?>" style="color: #2196F3; margin-right: 12px;" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <!-- Botón Eliminar con confirmación nativa -->
                        <a href="eliminar_representante.php?id=<?php echo $row_user['numero_doc']; ?>" title="Eliminar" onclick="return confirm('¿De verdad deseas eliminar este representante?');">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
            </tbody>
        </table>

        <div class="contenedor-btn-agregar">
            <a href="reg_rep_leg.php" class="agregar_usuario">
                <i class="fa-solid fa-person-circle-plus"></i>
            </a>
        </div>

    </div>

</div>

</body>
</html>