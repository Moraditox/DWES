<?php

for($i = 0; $i<= count($_SESSION['datos']); $i++){
    foreach($_SESSION['datos'][$i]['multas'] as $multa){
        $multas = [$multa];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Multas Conductor</title>
</head>
<body>
    <h2>Multas del Conductor</h2>
    <?php
        echo "<tr>";
            echo "<th>Matricula</th>";
            echo "<th>Descripcion</th>";
            echo "<th>Fecha</th>";
            echo "<th>Estado</th>";
        echo "</tr> <br>";
        foreach($multas as $multa){
                echo "<td>" . $multa['matricula'] . "</td>";
                echo "<td>" . $multa['descripcion'] . "</td>";
                echo "<td>" . $multa['fecha'] . "</td>";
                echo "<td>" . $multa['estado'] . "</td>";
                echo "<td><a href='/pagarMulta'>Pagar</a></td>";
            echo "</tr>";
        }
    ?>
    <br>
    <a href="/">Volver</a>
</body>
</html>