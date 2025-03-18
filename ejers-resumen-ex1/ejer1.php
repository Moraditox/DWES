<?php
/**
* Enunciado: Ejercicio: Formulario para calcular el promedio de calificaciones de estudiantes
* Crea un formulario en PHP que permita ingresar el nombre de un estudiante y sus calificaciones en varias asignaturas. 
* El formulario debe tener:

* Un campo de texto para ingresar el nombre del estudiante.
* Un campo numérico para definir el número de asignaturas.
* Un botón para enviar el formulario.
* Al enviar el formulario:

* Si el usuario ingresó un nombre vacío o un número de asignaturas menor que 1, muestra un mensaje de error.
* Si el formulario es correcto, muestra un segundo formulario que permita ingresar las calificaciones de cada asignatura.
* Después de ingresar las calificaciones, calcula el promedio y muestra si el estudiante ha aprobado o no 
* (se aprueba con un promedio de 60 o superior).
*/
$lProcesaFormulario = false;
$lProcesaNotas = false;
$nError = "";
$aError = "";
$notaError = "";
$promedio = 0;
$aprobado = "";

if(isset($_POST["submit"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $nombre = $_POST["nombre"];
    $asignaturas = $_POST["asignaturas"];

    if(empty($nombre)){
        $nError = "El nombre es obligatorio";
        $lProcesaFormulario = false;
    }

    if(empty($asignaturas)){
        $aError = "Las asignaturas es obligatorio";
        $lProcesaFormulario = false;
    }

    if($asignaturas < 1){
        $aError = "Debe tener al menos 1 asignatura";
        $lProcesaFormulario = false;
    }
}

if(isset($_POST["submitNotas"])){
    $lProcesaFormulario = false;
    $lProcesaNotas = true;

}

if($lProcesaNotas){
    $notas = $_POST["nota"];
    $numAsignaturas = count($notas);
    

    $total = 0;
    foreach ($notas as $nota) {
        $total += $nota;
    }
    $promedio = $total / $numAsignaturas ;
    if($promedio >= 5){
        $aprobado = "Has aprobado";
    } else {
        $aprobado = "Has suspendido";
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
    if(!$lProcesaFormulario && $lProcesaNotas){
        echo "<h2>Notas</h2>";
        foreach ($notas as $nota) {
            echo "$nota <br>";
        }
        echo "<h2>Notas finales:</h2>";
        echo "Media: $promedio <br>";
        echo "Final: $aprobado";


    } else if($lProcesaFormulario){ ?>
        <form action="" method="post">
            <?php
                for ($i=1; $i <= $asignaturas; $i++) {
                    echo "<label for='nota'>Nota de asignatura: $i</label>";
                    echo "<input type='number' name='nota[]' id='nota'><?php echo $notaError ?><br>";
                }
            ?>
            <input type="submit" value="Enviar notas" name="submitNotas">
        </form>
    <?php } else { ?>
        <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"><?php echo $nError ?><br>

        <label for="asignaturas">Asignaturas</label>
        <input type="number" name="asignaturas" id="asignaturas"><?php echo $aError ?><br>

        <input type="submit" value="Enviar" name="submit">
    </form>
    <?php } ?>
    
</body>
</html>