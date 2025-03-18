<?php
/**
 * Enunciado:
 * Tablas de multiplicar del 1 al 10. Aplicar estilos en filas/columnas
 * @author Javier Ruiz Molero 
 **/
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
            echo "<td>" . ($i * $j) . "</td>";
        }
        echo "</tr>";
    }
    ?>

</table>

</body>
</html>