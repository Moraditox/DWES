<?php
/**
 * Test 1 para comprobar el manejo de fichero de texto
 * @author Name <email@email.com>
 */
include "./conf/config.php";
// declaracion de variables
$av_array=array();
$mActual=date("m");
$aActual=date("Y");

for ($i=A_INICIO; $i<=A_FINAL ; $i++) {
    $anno = $i."/".$i+1;
    if ($i == $aActual-1 && $mActual < 8 ||$i == $aActual && $mActual > 8) {
            $check = "selected";
    }else {
        $check = "";
    }
    $av_array[]= [$anno, $check];

}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Formulario </h2>
    <form action="procesaFormulario.php" method="post" enctype="multipart/form-data">
        <label>Selecciona el grupo: 
            <select name="grupo" id="grupo">
                <?php
                    foreach ($grupos as $grupo) {
                        echo "<option value=".$grupo.">".$grupo."</option>";
                    }
                ?>
            </select>
        </label><br><br>
        <label>Selecciona el formato: 
            <select name="formato" id="formato">
                <?php
                    foreach ($formato as $f) {
                        echo "<option value=".$f.">".$f."</option>";
                    }
                ?>
            </select>
        </label><br><br>
        <label>Selecciona el curso: 
            <select name="curso" id="curso">
                <?php
                    foreach ($av_array as $anio) {
                        echo "<option value=".$anio[0]." ".$anio[1].">".$anio[0]."</option>";
                    }
                ?>
            </select>
        </label><br/><br/>
        <label>Selecciona el fichero: 
            <input type="file" name="file" id="file">
        </label><br/><br/>
        <label>
            <input type="submit" name="send" value="Enviar">
        </label>
    </form>
</body>
</html>