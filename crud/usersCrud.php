<?php
include './conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <h1 class="text-center mt-5 text-dark">CRUD USUARIOS</h1>
    <div class="mb-3 text-right">
        <a href="anadir.php" class="btn btn-success">Añadir Usuario</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>codUser</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Estado</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM user";
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                                    <td>" . $row["codUser"] . "</td>
                                    <td>" . $row["usuario"] . "</td>
                                    <td>" . $row["contrasenia"] . "</td>
                                    <td>" . ($row["estado"] ? 'Activo' : 'Inactivo') . "</td>
                                    <td>" . $row["cargo"] . "</td>
                                    <td>
                                        <a href='editar.php?id=" . $row["codUser"] . "' class='btn btn-primary btn-sm'>Editar</a>
                                        <a href='eliminar.php?id=" . $row["codUser"] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                                    </td>
                                  </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No hay usuarios</td></tr>";
            }
            $conexion->close();
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
