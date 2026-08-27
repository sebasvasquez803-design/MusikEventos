<?php
require './conexion.php';

// Si no viene del botón, lo saca a la gestión
if (!isset($_POST['botactualizar'])) {
    header('Location: gestionar.php');
    exit();
}

// Capturamos los datos que sí se pueden editar
$documento = $_POST['documento'] ?? '';
$email = $_POST['email'] ?? '';
$celular = $_POST['celular'] ?? '';
$nombre_grupo = $_POST['nombre_grupo'] ?? '';

// 1. Actualizamos Correo y Celular en la tabla 'persona'
$sql1 = "UPDATE persona SET email = '$email', celular = '$celular' WHERE numero_doc = '$documento'";

if (mysqli_query($conexion, $sql1)) {
    
    // 2. Actualizamos el Nombre del Grupo en la tabla 'grupo_musical'
    $sql2 = "UPDATE grupo_musical SET nombre_grupo = '$nombre_grupo' WHERE numero_doc = '$documento'";
    mysqli_query($conexion, $sql2);

    echo "<script>alert('Representante legal actualizado correctamente'); window.location='gestionar.php';</script>";
} else {
    echo "Error al actualizar: " . mysqli_error($conexion);
}
?>