<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paleta de Colores</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
        }
        td {
            width: 30px;  /* Tamaño de los cuadrados */
            height: 30px; /* Tamaño de los cuadrados */
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <h1>PALETA DE COLORES</h1>
    <table>
        <?php
        // Generar la paleta de colores desde oscuros (0,0,0) a claros (255,255,255)
        for ($g = 0; $g <= 255; $g += 51) { // Incremento en G
            echo "<tr>";
            for ($b = 0; $b <= 255; $b += 51) { // Incremento en B
                for ($r = 0; $r <= 255; $r += 51) { // Incremento en R
                    // Se genera el color con un enfoque continuo
                    $hex = sprintf("#%02x%02x%02x", $r, $g, $b);
                    echo "<td style='background-color: $hex;'></td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
