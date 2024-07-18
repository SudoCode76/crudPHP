<?php
include './conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $estado = isset($_POST['estado']) ? 1 : 0; // Estado es un checkbox, convertimos a 1 si está marcado, 0 si no
    $cargo = $_POST['cargo'];
    $sql = "INSERT INTO user (usuario, contrasenia, estado, cargo) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssis", $usuario, $contrasenia, $estado, $cargo);
    if ($stmt->execute()) {
        echo "Nuevo usuario añadido correctamente";
        header("Location: usersCrud.php");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<h1>Añadir nuevo usuario</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
    </div>

    <div class="form-group">
        <label for="contrasenia">Contraseña:</label>
        <input type="password" class="form-control" id="contrasenia" name="contrasenia" required>
    </div>

    <div class="form-group">
        <label for="estado">Estado:</label><br>
        <input type="checkbox" id="estado" name="estado" value="1">
        <label for="estado">Activo</label>
    </div>

    <div class="form-group">
        <label for="cargo">Cargo:</label>
        <input type="text" class="form-control" id="cargo" name="cargo" required>
    </div>

    <button type="submit" class="btn btn-primary">Añadir</button>
</form>
</body>
</html>
