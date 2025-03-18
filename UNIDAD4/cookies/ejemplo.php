<?php
/**
 * Enunciado:
 * Tabla el 1 al 10 con un form de numeros el cual lo que hace es que en la tabla salen el x inputs aleatoriamente
 * y muestre los errores y aciertos.
 * @author Javier Ruiz Molero 
 **/

$lProcesaFormulario = false;
$inputAlt = array();
$numeroAdivinar = 0;

if(isset($_POST["enviar"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $numeroAdivinar = $_POST["numero"];
}

if($numeroAdivinar > 0){
    for($x = 0; $x < $numeroAdivinar; $x++){
        $fila = rand(1, 10);
        $col = rand(1, 10);
        $inputAlt[] = [$fila, $col];
    }
}



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de Multiplicar del 1 al 10</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        td:nth-child(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h1>Tablas de Multiplicar del 1 al 10</h1>
<form action="" method="post">
    <label for="">Cuantos numeros quieres adivinar</label>
    <input type="number" name="numero" id="numero">

    <input type="submit" value="enviar" name="enviar">
</form>
<table>
    <tr>
        <th>Tabla</th>
        <?php
        // Encabezado con los números del 1 al 10
        for ($i = 1; $i <= 10; $i++) {
            echo "<th>" . $i . "</th>";
        }
        ?>
    </tr>

    <?php
    // Tablas de multiplicar del 1 al 10
    for ($i = 1; $i <= 10; $i++) {
        
        echo "<tr>";
        echo "<th>Tabla del $i</th>";

        // Cálculo
        for ($j = 1; $j <= 10; $j++) {
            $esInput = false;

            foreach ($inputAlt as $input) {
                if($input[0] === $i && $input[1] === $j){
                    $esInput = true;
                }
            }
            if($esInput){
                echo "<td><input type='number' name='respuesta{$i}{$j}'></td>";
            } else {
                echo "<td>" . ($i * $j) . "</td>";
            }
        }
        echo "</tr>";
    }
    ?>

</table>
<form action="" method="post">
    <?php
        foreach ($inputAlt as $input) {
            echo "<input type='hidden' name='inputAlt[]' value='{$input[0]}_{$input[1]}'>";
        }
    ?>
    <input type="submit" value="verificar resultados" name="verificar">
</form>
<?php
if(isset($_POST["verificar"])){
    $aciertos = 0;
    $errores = 0;

    foreach ($inputAlt as $input) {
        $fila = $input[0];
        $columna = $input[1];
        $valorCorrecto = $fila * $columna;

        $campoRespuesta = "respuesta{$fila}{$columna}";
        $respuestaUsuario = isset($_POST[$campoRespuesta]) ? $_POST[$campoRespuesta] : null;

        if ($respuestaUsuario == $valorCorrecto) {
            $aciertos++;
        } else {
            $errores++;
        }

    }
    // Mostrar resultados
    echo "<h2>Resultados:</h2>";
    echo "<p>Aciertos: $aciertos</p>";
    echo "<p>Errores: $errores</p>";
}
?>
</body>
</html>