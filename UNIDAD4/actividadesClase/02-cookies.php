<?php
/**
 * Enunciado: formulario user y passwd
 *  recuperara contraseña y usuario
 *  enviar muestra datos 
 * @author javier ruiz molero
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
    $recordar = $_POST["recordar"];
    $olvidada = $_POST["olvidada"];
    $contrasena = $_POST["pass"];

    if($usuario == "" || $contrasena == ""){
        $mError = "El nombre de usuario y la contraseña son campos obligatorios";
    }else {
        
    }
}

// Crear cookies
if($lCookies){
    setcookie("usuario", $usuario, time()+3600);
    setcookie("pass", $contrasena, time()+3600);
}

//eliminar cookies
if($dCookies){
    setcookie("javier",'', time()-3600);
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
        } else{
            echo "<h2>Nombre Requerido</h2>";
        }
        if(!empty($contrasena)){
            echo "<h2>Contraseña: $contrasena</h2>";
        } else{
            echo "<h2>Contraseña Requerida</h2>";
        }
    } else { // Mostrar form ?>
        <form action="" method="post">
            <label for="user"></label><br/>
            <input type="text" name="user" id="user" value="<?php echo $_COOKIE["usuario"] ?>"><br/>

            <label for="pass"></label><br/>
            <input type="password" name="pass" id="pass" value="<?php echo $_COOKIE["pass"] ?>"><br/>

            <label for="recordar">recordar contraseña</label>
            <input type="checkbox" name="recordar" id="recordar" value="si"><br/>


            <input type="button" value="Eliminar contraseña guardada" name="olvidada">
            
            <input type="submit" value="enviar" name="enviar">
        </form>
    <?php } ?>
</body>
</html>