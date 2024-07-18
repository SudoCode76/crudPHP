<?php
include '../conexion.php';

// Verificar si se ha enviado el ID del usuario a eliminar por el método GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar y ejecutar la consulta SQL para eliminar el usuario
    $sql = "DELETE FROM user WHERE codUser=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir de vuelta a la página principal después de eliminar
        header("Location: usersCrud.php");
        exit();
    } else {
        // Manejar el error si la consulta no se ejecuta correctamente
        echo "Error al intentar eliminar el usuario: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Manejar caso de que no se haya proporcionado ID
    echo "ID de usuario no especificado";
    exit();
}

$conexion->close();
?>
