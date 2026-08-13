<?php
require './conexion.php';

// Si no viene del botón, lo saca al index
if (!isset($_POST["botregistrar"])) {
    header('Location: ../index.php');
    exit();
}

// Recibimos los datos del formulario
$nombre = $_POST["nombre"] ?? '';          
$apellido = $_POST["apellido"] ?? '';      
$email = $_POST["email"] ?? '';            
$celular = $_POST["celular"] ?? '';        
$documento = $_POST["documento"] ?? '';    
$tipo_doc = $_POST["tipo_doc"] ?? '';      
$fecha_nacimiento = $_POST["fecha_nacimiento"] ?? '';
$nombre_grupo = $_POST["nombre_grupo"] ?? ''; 

// Datos fijos del sistema
$id_tipo_persona = 3; // 3 = Representante Legal
$estado = "Activo";
$fecha_registro = date("Y-m-d");

// Generamos un NIT único automático para el grupo usando el documento
$nit_grupo = $documento + 900000000; 

// 1. Insertamos en la tabla 'persona'
$sqlPersona = "INSERT INTO persona (numero_doc, tipo_doc, id_tipo_persona, nombre, apellido, celular, fecha_nacimiento, email, estado, fecha_registro)
               VALUES ('$documento', '$tipo_doc', $id_tipo_persona, '$nombre', '$apellido', '$celular', '$fecha_nacimiento', '$email', '$estado', '$fecha_registro')";

if (mysqli_query($conexion, $sqlPersona)) {
    
    // 2. Insertamos en la tabla 'grupo_musical'
    $sqlGrupo = "INSERT INTO grupo_musical (nit, nombre_grupo, telefono, email, numero_doc)
                 VALUES ('$nit_grupo', '$nombre_grupo', '$celular', '$email', '$documento')";

    if (mysqli_query($conexion, $sqlGrupo)) {
        echo "<script>alert('Representante y grupo registrados con éxito'); window.location='gestionar.php';</script>";
    } else {
        echo "Error en grupo: " . mysqli_error($conexion);
    }
    
} else {
    echo "Error en persona: " . mysqli_error($conexion);
}
?>