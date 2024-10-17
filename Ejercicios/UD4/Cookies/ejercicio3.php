<?php
    /**
     * 
     * Enunciado
     * 
     * Fecha --> 17/10/2024
     * @author Héctor Mora Sánchez
    */

    //VARIABLE PARA LA VALIDACION DEL FORMULARIO
    $lProcesaFormulario = false;

    //VALIDAMOS SI EL FORMULARIO HA SIDO ENVIADO CON EL BOTON ENVIAR
    if(isset($_POST["enviar"])){
        $lProcesaFormulario = true;
    }

    //METEMOS LOS CAMPOS QUE HA INTRODUCIDO EL USUARIO EN EL FORMULARIO EN SUS VARIABLES CORRESPONDIENTES
    if($lProcesaFormulario){
        if(isset($_POST["usuario"])){
            $usuario = $_POST['usuario'];
        }else{
            $lProcesaFormulario = false;
        }

        if(isset($_POST["password"])){
            $password = $_POST['password'];
        }else{
            $noIntroducida = "No has introducido la contraseña";
            $lProcesaFormulario = false;
        }

        if(isset($_POST["recordar"])){
            if(!isset($_COOKIE['usuario'])){
                setcookie("usuario", $usuario, time() + 3600);
            }
        
            if(!isset($_COOKIE['password'])){
                setcookie("password", $password, time() + 3600);
            }
        }else{
            if(isset($_COOKIE['usuario'])){
                setcookie("usuario", $usuario, time() - 3600);
            }
            if(isset($_COOKIE['password'])){
                setcookie("password", $password, time() - 3600);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Cookies</title>
</head>
<body>
    <?php
        if($lProcesaFormulario){
            echo "Usuario: $usuario <br/>";
            echo "Password: $password";
        }else{
    ?>
    <form action="" method="POST">
        <label for="Ususario">Usuario: </label>
        <input type="text" name="usuario" placeholder="Usuario" value="<?php echo $_COOKIE['usuario'] ?>"><br/>
        <label for="Password">Password: </label>
        <input type="password" name="password" placeholder="Password" value="<?php echo $_COOKIE['password'] ?>" <?php echo $noIntroducida; ?>><br/>
        <label for="recordar">Recordar contraseña</label>
        <input type="checkbox" name="recordar" value="recordar"><br/>
        <input type="submit" name="enviar" value="Enviar">
        <input type="reset" name="reset" value="Reiniciar">
    </form>
    <?php
        }
    ?>
</body>
</html>