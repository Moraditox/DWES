<?php
/**
 * Enunciado: Formulario para crear un currículum que incluya: Campos de texto, grupo de
 * botones de opción, casilla de verificación, lista de selección única, lista de
 * selección múltiple, botón de validación, botón de imagen, botón de reset, etc.
 * @author javier 
*/

$lProcesaFormulario = false;

if(isset($_POST["enviar"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $genero = $_POST["genero"];
    $viajar = $_POST["viajar"];
    $estudios = $_POST["estudios"];
    $experiencia = $_POST["experiencia"];
}

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 4vw;
            text-align: center;
        }
        form{
            width: 60%;
            margin: 3vw 20vw;
        }
        h3{
            font-family: sans-serif;
            color: #24009e;
            font-size: 2vw;
        }
        input, textarea{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.5vw;
            padding: 1vw;
        }
        #curriculum{
            padding: 3vw 10vw;
        }
        h2{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 2vw;
        }
        #info,#info2{
            display: flex;
        }
        #info h2{
            width: 33.33%;
        }
        #info2 h2{
            width: 50%;
        }
    </style>
</head>
<body>
    <h1>CURRICULUM</h1>
    <?php
    if($lProcesaFormulario){
        echo   "<div id='curriculum'>
                    <div id='info'>
                        <h2>Nombre: $nombre</h2>
                        <h2>Apellidos: $apellidos</h2>
                        <h2>Tengo: $edad años</h2>
                    </div>
                    <div id='info2'>
                        <h2>Género: $genero</h2>
                        <h2>Disponibilidad para viajar: $viajar</h2>
                    </div>
                    <h2>Maximo estudios: $estudios</h2>
                    <h2>Experiencia</h2>
                    <p>$experiencia</p>
                </div>";
    } else { ?>
        <form action="" method="post">
            <h3>Nombre</h3>
            <input type="text" name="nombre">

            <h3>Apellidos</h3>
            <input type="text" name="apellidos">

            <h3>Edad</h3>
            <input type="number" name="edad">

            <h3>Género</h3>
            <input type="radio" id="masculino" name="genero" value="Masculino">
            <label for="masculino">Masculino</label>
            <input type="radio" id="femenino" name="genero" value="Femenino">
            <label for="femenino">Femenino</label>
            <input type="radio" id="otro" name="genero" value="Otro">
            <label for="otro">Otro</label>

            <h3>Disponibilidad para viajar:</h3>
            <label for="si">Si</label>
            <input type="checkbox" name="viajar" id="si" value="si">
            <label for="no">No</label>
            <input type="checkbox" name="viajar" id="no" value="no">

            <h3>Nivel de estudios:</h3>
            <select id="estudios" name="estudios">
                <option value="secundaria">Secundaria</option>
                <option value="bachillerato">Bachillerato</option>
                <option value="universidad">Universidad</option>
                <option value="grado superior">Grado Superior</option>
            </select>

            <h3>Experiencia</h3>
            <textarea name="experiencia" cols="30" rows="10"></textarea>

            <div id="botones">
                <input type="reset" value="reset">
                <input type="submit" value="enviar" name="enviar">
            </div>
        </form>



    <?php } ?>
</body>
</html>