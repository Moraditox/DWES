<?php
/**
 * 
 * 
 */
$lProcesaFormulario = false;

$nombre = "";
$apellidos = "";
$email = "";

if(isset($_POST['enviar'])){
    $lProcesaFormulario = true;
}
if($lProcesaFormulario){
    // Recoger datos
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $lProcesaFormulario = false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if($lProcesaFormulario){
        // Mostrar
        echo "Nombre: $nombre <br/>";
        echo "Apellidos: $apellidos <br/>";
        echo "Email: $email";
    } else {
    ?>
    <form action="" method="post" novalidate>
        <input type="text" name="nombre" placeholder="nombre" value=""/><br/>
        <input type="text" name="apellidos" placeholder="apellidos" value=""/><br/>
        <input type="email" name="email" placeholder="email" value=""/><br/>

        <input type="submit" name="enviar" value="Send"/>

    </form>
    <?php
}
?>
    <div>
        
    </div>
</body>
</html>