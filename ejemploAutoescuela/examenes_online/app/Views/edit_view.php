<?php
    require_once "logued.php";
    if (!$isLogged){
        header("Location: ..");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/form-login.css">
</head>
<body>
    <?php if ($isLogged){
            require_once "header.php";
        } ?>
    <h3>Formulario de edición de usuario</h3>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $data["nombre"]?>" ><?php echo $data["errorNombre"]?><br>

        <label for="apellidos">Apellido:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $data["apellidos"]?>" ><?php echo $data["errorApellidos"]?><br>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $data["email"]?>" ><?php echo $data["errorEmail"]?><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" value="<?php echo $data["password"]?>" ><?php echo $data["errorPassword"]?><br>

        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" value="<?php echo $data["password_confirmation"]?>"><?php echo $data["errorPassword_confirmation"]?><br>

        <label for="profile_picture">Imagen de Perfil:</label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*"><?php echo $data["errorPicture"]?><br>
        
        <input type="submit" id="enviar" value="Actualizar">
    </form>
</body>
</html>
