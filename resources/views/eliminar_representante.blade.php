<?php
require './conexion.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // Preparamos la eliminación en la tabla 'persona' usando su llave primaria 'numero_doc'
    $stmt = mysqli_prepare($conexion, "DELETE FROM persona WHERE numero_doc = ?");
    
    // Vinculamos la variable usando "s" (string) para soportar documentos largos sin problemas
    mysqli_stmt_bind_param($stmt, "s", $id);

    if(mysqli_stmt_execute($stmt)){
        // Si se elimina con éxito, regresa a la tabla de gestión
        header("Location: gestionar.php");
        exit();
    }else{
        echo "Error al eliminar el representante legal: " . mysqli_error($conexion);
    }
}else{
    echo "ID no recibido";
}
?>