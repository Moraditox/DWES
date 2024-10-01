<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #89D2DC; /* Color de fondo de los encabezados */
            color: white; /* Color de texto de los encabezados */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Color de filas pares */
        }
        tr:hover {
            background-color: #ddd; /* Color de fondo al pasar el mouse */
        }
    </style>
</head>
<body>

<h1>Tabla de Multiplicar del 1 al 10</h1>

<table>
    <tr>
        <th>x</th>
        <?php
        // Encabezados de columnas (1 a 10)
        for ($j = 1; $j <= 10; $j++) {
            echo "<th>$j</th>";
        }
        ?>
    </tr>
    <?php
    // Filas de la tabla (1 a 10)
    for ($i = 1; $i <= 10; $i++) {
        echo "<tr>";
        echo "<th>$i</th>"; // Encabezado de fila
        for ($j = 1; $j <= 10; $j++) {
            $resultado = $i * $j; // Multiplicación
            echo "<td>$resultado</td>"; // Resultado en la celda
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
