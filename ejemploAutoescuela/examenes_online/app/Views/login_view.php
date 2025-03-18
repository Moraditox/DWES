<?php
    require_once "logued.php";
    if ($isLogged){
        header("Location: ..");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoescuela</title>
  
</head>
<body>
    <?php if (!$isLogged){
            require_once "header.php";
        }
    ?>
    <h3>Formulario de inicio de sesión</h3>
    <form action="" method="post">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $data["email"]?>"><?php echo $data["errorEmail"]?><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" value="<?php echo $data["password"]?>"><?php echo $data["errorPassword"]?><br><br>
        
     
        <input type="submit" id="enviar" value="Enviar">
    </form>
</body>
</html>