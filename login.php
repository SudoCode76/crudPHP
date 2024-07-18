<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="login-container">
    <div class="login-form">
        <h2 class="text-light">Iniciar Sesión</h2>
        <form action="login_action.php" method="post">
            <?php if(isset($_GET['error'])): ?>
                <?php if($_GET['error'] == 'inactive'): ?>
                    <p class="error">USUARIO INACTIVO</p>
                <?php else: ?>
                    <p class="error">ACCESO DENEGADO</p>
                <?php endif; ?>
            <?php endif; ?>
            <div class="input-group">
                <input type="text" name="username" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="input-group">
                <button type="submit">Iniciar sesión</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
