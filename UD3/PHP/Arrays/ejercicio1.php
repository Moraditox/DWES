<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays en PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Meses del Año</h2>
    <ul>
        <?php
        $meses_del_año = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        foreach ($meses_del_año as $mes) {
            echo "<li>$mes</li>";
        }
        ?>
    </ul>

    <h2>Tablero para el Juego de los Barcos</h2>
    <table>
        <?php
        $tablero_barcos = array_fill(0, 10, array_fill(0, 10, "~"));
        foreach ($tablero_barcos as $fila) {
            echo "<tr>";
            foreach ($fila as $celda) {
                echo "<td>$celda</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Notas de los Alumnos en el Módulo DWES</h2>
    <ul>
        <?php
        $notas_alumnos_DWES = ["Hector" => 8.5, "Javier" => 9.2, "Lucia" => 7.3, "Jesus" => 6.8, "Adrian" => 5.0, "Pablo" => 4.5];
        foreach ($notas_alumnos_DWES as $alumno => $nota) {
            echo "<li>$alumno: $nota</li>";
        }
        ?>
    </ul>

    <h2>Verbos Irregulares en Inglés</h2>
    <table>
        <thead>
        <tr>
            <th>Forma Base</th>
            <th>Pasado Simple</th>
            <th>Participio Pasado</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $verbos_irregulares_ingles = [
            ["be", "was/were", "been"],
            ["begin", "began", "begun"],
            ["break", "broke", "broken"],
            ["bring", "brought", "brought"]
        ];
        foreach ($verbos_irregulares_ingles as $verbo) {
            echo "<tr>";
            echo "<td>{$verbo[0]}</td>";
            echo "<td>{$verbo[1]}</td>";
            echo "<td>{$verbo[2]}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <h2>Información sobre Continentes, Países, Capitales y Banderas</h2>
    <?php
    $informacion_geografica = [
        "América" => [
            ["país" => "Argentina", "capital" => "Buenos Aires", "bandera" => "🇦🇷"],
            ["país" => "Brasil", "capital" => "Brasilia", "bandera" => "🇧🇷"]
        ],
        "Europa" => [
            ["país" => "España", "capital" => "Madrid", "bandera" => "🇪🇸"],
            ["país" => "Francia", "capital" => "París", "bandera" => "🇫🇷"]
        ],
        "Asia" => [
            ["país" => "China", "capital" => "Pekín", "bandera" => "🇨🇳"],
            ["país" => "Japón", "capital" => "Tokio", "bandera" => "🇯🇵"]
        ]
    ];

    foreach ($informacion_geografica as $continente => $paises) {
        echo "<h3>$continente</h3>";
        echo "<table><thead><tr><th>País</th><th>Capital</th><th>Bandera</th></tr></thead><tbody>";
        foreach ($paises as $pais) {
            echo "<tr>";
            echo "<td>{$pais['país']}</td>";
            echo "<td>{$pais['capital']}</td>";
            echo "<td>{$pais['bandera']}</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    ?>
</div>

</body>
</html>