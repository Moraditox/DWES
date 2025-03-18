<?php
/**
 * form: nombre, url, email, informacion, genero, vehiculos, color
*/
include "./conf/config.php";

$lProcesaFormulario = false;
$nombre = $email = $url = $informacion = $genero = "";
$vehiculosIntroducidos = $coloresIntroducidos = [];

$mErrorNombre = $mErrorEmail = $mErrorUrl = $mErrorInformacion = $mErrorGenero = $mErrorVehiculos = $mErrorColores = "";
if(isset($_POST["submit"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $url = $_POST["url"];
    $informacion = $_POST["informacion"];

    if(empty($nombre)){
        $mErrorNombre = "El nombre debe ser rellenado";
        $lProcesaFormulario = false;
    }

    if(empty($email)){
        $mErrorEmail = "El email debe ser rellenado";
        $lProcesaFormulario = false;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $mErrorEmail = "El email debe ser correcto";
        $lProcesaFormulario = false;
    }

    if(empty($url)){
        $mErrorUrl = "La url debe ser rellenado";
        $lProcesaFormulario = false;
    }

    if(empty($informacion)){
        $mErrorInformacion = "La informacion debe ser rellenado";
        $lProcesaFormulario = false;
    }

    if(isset($_POST["genero"])){
        $genero = $_POST["genero"];
    } else {
        $mErrorGenero = "Debes introducir el genero";
        $lProcesaFormulario = false;
    }

    if(isset($_POST["vehiculos"])){
        $vehiculosIntroducidos = $_POST["vehiculos"];
    } else {
        $mErrorVehiculos = "Debes introducir los vehiculos";
        $lProcesaFormulario = false;
    }

    if(isset($_POST["colores"])){
        $coloresIntroducidos = $_POST["colores"];
    } else {
        $mErrorColores = "Debes introducir los colores";
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
    <h1>Validacion para examen</h1>
    <?php
    if($lProcesaFormulario){
        echo "Nombre: $nombre <br/>";
        echo "Email: $email <br/>";
        echo "URL: $url <br/>";
        echo "informacion: $informacion <br/>";
        echo "Genero: $genero <br/>";
        echo "vehiculos <br/>";
        foreach ($vehiculosIntroducidos as $vehiculo) {
            echo "$vehiculo <br/>";
        }
        echo "colores <br/>";
        foreach ($coloresIntroducidos as $color) {
            echo "$color <br/>";
        }
    } else{ ?>
        <form action="" method="post">
            <label for="nombre">Nombre</label><br/>
            <input type="text" name="nombre" id=""><?php echo $mErrorNombre ?><br/>

            <label for="url">Url</label><br/>
            <input type="text" name="url" id=""><?php echo $mErrorUrl ?><br/>

            <label for="email">email</label><br/>
            <input type="text" name="email" id=""><?php echo $mErrorEmail ?><br/>

            <label for="informacion">Informacion</label><br/>
            <textarea name="informacion" id="" cols="30" rows="10"></textarea><?php echo $mErrorInformacion ?><br/>

            <label for="genero">genero</label><br/>
            <?php
                foreach ($aGenero as $genero){
                    echo "<input type='radio' name='genero' value='$genero' />$genero";
                }
            ?><?php echo $mErrorGenero ?></br>

            <label>vehiculos</label><br/>
            <?php
                foreach ($aVehiculos as $vehiculo) {
                    echo "<input type='checkbox' name='vehiculos[]' value='$vehiculo'>$vehiculo";
                }
            ?>
            <?php echo $mErrorVehiculos?>
            <br/>
            <label>Color</label><br/>
            <select name="colores[]" id="" multiple><br/>
                <?php
                    foreach ($aColores as $clave => $valor) {
                        foreach ($valor as $color => $valor2) {
                            if ($color != "codigo") {
                                echo "<option name='colores[]' value='$valor2'>$valor2</option>";
                            }
                        }
                    }
                ?>
            </select>
            <?php echo $mErrorColores ?>
            <br/>
            <input type="submit" value="submit" name="submit">


        </form>



    <?php
    }
    ?>
</body>
</html>

