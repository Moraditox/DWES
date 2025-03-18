<?php
//Incluimos el archivo de configuracion con los array
include "./config/config.php";
//Incluimos archivo que contiene las funciones del proyecto
include "./config/functions.php";

//Inicializacion y declaracion de las variables
$nombre = $email = $genero = $comentarios = $url = "";
$nombreE = $emailE = $generoE = $comentaiosE = $vehiculosE = $cochesE = $urlE = "";
$selecionCoches = "";

//Inicalizamos las variables que vamos a utilizar
$vehiculosSeleccionados = [];
$cochesSeleccionados = [];
$coloresSeleccionados = [];
$lProcesaFormulario = false;
$eValidacion = false;

//Validamos que el usuario le ha dado al boton de submit
if(isset($_POST['enviar'])){
    $lProcesaFormulario = true;

    //Validacion del nombre
    $nombre = clearData($_POST['nombre']);
    if(empty($nombre)){
        $eValidacion = true;
        $nombreE = "El nombre es obligatorio";
    }

    //Validacion del E-mail
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $eValidacion = true;
        $emailE = "El email no es valido";
    }

    //Validacion del genero
    
    if(empty($genero)){
        $eValidacion = true;
        $generoE = "El genero es obligatorio";
    } else {
        $genero = $_POST['genero'];
    }

    //Validacion de los coches
    if(empty($cochesSeleccionados)){
        $eValidacion = true;
        $cochesE = "Los coches son obligatorio";
    } else {
        $cochesSeleccionados = $_POST['coches[]'];
    }

    //Validacion de los vehiculos
    if(empty($vehiculosSeleccionados)){
        $eValidacion = true;
        $vehiculosE = "Los vehiculos son obligatorio";
    } else {
        $vehiculosSeleccionados = $_POST['vehiculos[]'];
    }

    //Limpiar los comentarios
    $comentarios = clearData($_POST['comentarios']);

    //Validar la URl
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    if(!filter_var($url, FILTER_VALIDATE_EMAIL)){
        $eValidacion = true;
        $urlE = "La URL no es valida";
    }

}

if($eValidacion){
    $lProcesaFormulario = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validacion Formulario</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Validacion Formulario</h1>
    <p class="error">* campos requeridos</p>
    <form action="" method="POST">
        <label for="nombre"> Nombre: </label>
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo "$nombre"; ?>">
        <span class="error">* <?php echo "$nombreE"; ?></span>
        <br/>
        <label for="email"> E-mail: </label>
        <input type="email" name="email" placeholder="E-mail" value="<?php echo "$email"; ?>">
        <span class="error">* <?php echo "$emailE"; ?></span>
        <br/>
        <label for="url"> URL: </label>
        <input type="text" name="url" placeholder="URL" value="<?php echo "$url"; ?>">
        <span class="error">* <?php echo "$urlE"; ?></span>
        <br/>
        <label for="comentarios"> Comentarios </label><br/>
        <textarea name="comentarios" id="Comentarios">Comentarios</textarea>
        <br/>
        <label for="genero"> Genero: </label>
        <?php
            $check = "";
            foreach ($aGenero as $clave => $valor) {
                    $checkGenero = $valor == $genero ? "checked" : "";
                    echo "<input type='radio' name='generos' value='$valor' $checkGenero>$valor";
                
            }
                
        ?>
        <span class="error">* <?php echo "$generoE"; ?></span>
        <br/>
        <label for="coches"> Coches: </label>
        <?php
            $check = "";
            foreach ($aCoches as $coche) {
                if(in_array($coche,$cochesSeleccionados)){
                    $check='checked';
                }
                echo "<input type='checkbox' name='coches[]' value='$coche' $check>$coche";
            }
        ?><br/>
        <label for="coches"> Vehiculos: </label>
        <?php
        $check = "";
            foreach ($aVehiculos as $vehiculo) {
                $selecionCoches= in_array($vehiculo, $vehiculosSeleccionados) ? 'checked' : '';
                echo "<input type='checkbox' name='vehiculos[]' value='$vehiculo' $selecionCoches>$vehiculo";
            }
        ?>
        <br/><input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>