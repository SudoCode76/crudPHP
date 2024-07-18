<?php
include '../conexion.php';

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codUser = $_POST['codUser'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $estado = isset($_POST['estado']) ? 1 : 0; // Estado es un checkbox, convertimos a 1 si está marcado, 0 si no
    $cargo = $_POST['cargo'];

    // Preparar la consulta SQL para actualizar el usuario
    $sql = "UPDATE user SET usuario=?, contrasenia=?, estado=?, cargo=? WHERE codUser=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $usuario, $contrasenia, $estado, $cargo, $codUser);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir de vuelta a la página principal después de editar
        header("Location: usersCrud.php");
        exit();
    } else {
        // Manejar el error si la consulta no se ejecuta correctamente
        echo "Error al actualizar usuario: " . $stmt->error;
    }

    $stmt->close();
}

// Obtener el ID del usuario a editar desde el parámetro GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para obtener los datos del usuario por su ID
    $sql = "SELECT * FROM user WHERE codUser=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $usuario = $row['usuario'];
        $contrasenia = $row['contrasenia'];
        $estado = $row['estado'];
        $cargo = $row['cargo'];
    } else {
        // Manejar caso de usuario no encontrado
        echo "Usuario no encontrado";
        exit();
    }

    $stmt->close();
} else {
    // Manejar caso de que no se haya proporcionado ID
    echo "ID de usuario no especificado";
    exit();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <h1 class="text-center mt-5 text-dark">Editar Usuario</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="codUser" value="<?php echo $id; ?>">

        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario; ?>"
                   required>
        </div>

        <div class="mb-3">
            <label for="contrasenia" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="contrasenia" name="contrasenia"
                   value="<?php echo $contrasenia; ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label><br>
            <input type="checkbox" id="estado" name="estado" value="1" <?php echo ($estado == 1) ? 'checked' : ''; ?>>
            <label for="estado">Activo</label>
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo:</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo $cargo; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="usersCrud.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
