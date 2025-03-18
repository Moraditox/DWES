<?php
/**
* Paso 1:  Array con las preguntas
* Paso 2: Array con las respuestas
*/
require "./conf.php/config.php";
$lProcesaFormulario = false;
$respuestasUsuario = [];
$error = "";
$resultados = [];
$numRespuestasCorrect = 0;
$numRespuestasInc = 0;


if(isset($_POST["submit"])){
    $lProcesaFormulario = true;

    // Validar que todas las preguntas hayan sido respondidas
    foreach ($preguntas as $pregunta => $value) {
        if (empty($_POST[$pregunta])) {
            $error = "Debes responder todas las preguntas.";
            $lProcesaFormulario = false;
            break;
        }
    }
}

if($lProcesaFormulario){

    foreach ($preguntas as $pregunta => $value) {
        if (isset($_POST[$pregunta])) {
            $respuesta = $_POST["$pregunta"];
            $respuestasUsuario[] = $respuesta;
            // Verificar si la respuesta es correcta
            if ($respuesta === $value["respuestaCorrecta"]) {
                $resultados[$pregunta] = "Correcta";
                $numRespuestasCorrect += 1;
            } else {
                $resultados[$pregunta] = "Incorrecta";
                $numRespuestasInc += 1;
            }
        }
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
    <h1>Test Examen Coche</h1>
    <form action="" method="post">
        <?php
            foreach ($preguntas as $pregunta => $contenidos) {
                echo "<h2>$pregunta</h2>";
                echo "<label for='$pregunta'>$contenidos[pregunta]</label> </br>";
                foreach ($contenidos["respuestas"] as $respuesta) {
                    echo "<input type='radio' value='$respuesta' name='$pregunta'>$respuesta </br>";
                }
            }
        ?>

        <input type="submit" value="enviar" name="submit"><?php echo $error ?>
    </form>
    <?php
    if($lProcesaFormulario){
        foreach ($respuestasUsuario as $respuesta) {
            echo "$respuesta </br>";
        }
        echo "Respuestas Correctas: $numRespuestasCorrect </br>";
        echo "Respuestas Incorrectas: $numRespuestasInc";
    }
    ?>
</body>
</html>