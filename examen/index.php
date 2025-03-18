<?php
/**
 * @author javier <javierrumo2@gamil.com>
*/

// Incluir array de examenes
require "./conf/config.php";

// Definir valores iniciales
$lProcesaFormulario = false;
$Pregunta1 = [];

if(isset($_POST["submit"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    foreach ($examenes as $key => $value) {
        foreach ($value as $examen => $contenidos) {
            $examen = $_POST["$examen"];
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
    <h1>Examen</h1>
    <?php
    if($lProcesaFormulario){

        foreach ($Pregunta1 as $r) {
            echo $r;
        }
        
    } ?>
    <form action="" method="post">
        <?php
        // Recorre array creando un formulario
            foreach ($examenes as $key => $value) {
                foreach ($value as $examen => $contenidos) {
                    echo "<h3>$examen</h3>";
                    echo "<h4>$contenidos[pregunta]</h4>";
                    foreach ($contenidos["respuestas"] as $respuesta) {
                        echo "<label>$respuesta</label>";
                        echo "<input type='$contenidos[tipo]' name='$examen'>";
                    }
                }
            }
        ?>
        <br/>
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>