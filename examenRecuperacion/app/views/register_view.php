<?php
require_once "logued.php";
if ($isLogged) {
    header("Location: ..");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de conductores</title>
</head>
<body>
<?php if (!$isLogged) {
        require_once "header.php";
    }
    ?>
    <h1>Registro de conductores</h1>
    <form action="" method="post">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($data['usuario']); ?>">
            <span><?php echo htmlspecialchars($data['errorUsuario']); ?></span>
        </div>
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($data['nombre']); ?>">
            <span><?php echo htmlspecialchars($data['errorNombre']); ?></span>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($data['password']); ?>">
            <span><?php echo htmlspecialchars($data['errorPassword']); ?></span>
        </div>
        <div>
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" value="<?php echo htmlspecialchars($data['password_confirmation']); ?>">
            <span><?php echo htmlspecialchars($data['errorPassword_confirmation']); ?></span>
        </div>
    
        <div>
            <button type="submit">Registrar</button>
        </div>
    </form>
</body>
</html></div>