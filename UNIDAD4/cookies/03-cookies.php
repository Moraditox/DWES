<?php
/**
 * Crea un formulario de login que permita al usuario recordar los datos
 * introducidos. Incluye una opción para borrar la información almacenada.
 * @author javier ruiz
*/

$lProcesaFormulario = false;
$lCookies = false;
$dCookies = false;
$mError = "";

if(isset($_POST["enviar"])) {
    $lProcesaFormulario = true;
}

// Procesar formulario
if($lProcesaFormulario){
    $usuario = $_POST["user"];
    $contrasena = $_POST["pass"];

    if($usuario == "" || $contrasena == ""){
        $lProcesaFormulario = false;
        $mError = "El nombre de usuario y la contraseña son campos obligatorios";
    } else {
        $recordar = isset($_POST["recordar"]) ? $lCookies = true : "";
        $olvidada = isset($_POST["olvidada"]) ? $dCookies = true : "";
    }
}

// Crear cookies
if($lCookies){
    setcookie("usuario", $usuario, time()+3600);
    setcookie("pass", $contrasena, time()+3600);
}

//eliminar cookies
if(isset($_POST["olvidada"])){
    setcookie("pass",'', time()-3600);
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
    <h1>Registro</h1>
    <?php
    // Mostrar datos
    if($lProcesaFormulario){
        if(!empty($usuario)){
            echo "<h2>Usuario: $usuario</h2>";
        }
        if(!empty($contrasena)){
            echo "<h2>Contraseña: $contrasena</h2>";
        }
    } else { // Mostrar form ?>
        <form action="" method="post">
            <label for="user"></label><br/>
            <input type="text" name="user" id="user" value="<?php echo isset($_COOKIE["usuario"]) ? $_COOKIE["usuario"] : ""?>"><? echo $mError ?><br/>

            <label for="pass"></label><br/>
            <input type="password" name="pass" id="pass" value="<?php echo isset($_COOKIE["pass"]) ? $_COOKIE["pass"] : "" ?>"><? echo $mError ?><br/>

            <label for="recordar">recordar contraseña</label>
            <input type="checkbox" name="recordar" id="recordar" value="si"><br/>


            <input type="submit" value="Eliminar contraseña guardada" name="olvidada">
            
            <input type="submit" value="enviar" name="enviar">
        </form>
    <?php } ?>
</body>
</html>

