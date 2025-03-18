<?php
/**
 * Enunciado:
 * Mostrar paleta de colores. Utilizar una tabla que muestre el color y el valor
 * hexadecimal que le corresponde. Cada celda será un enlace a una página que
 * mostrará un fondo de pantalla con el color seleccionado. ¿Puedes hacerlo con los
 * conocimientos que tienes?
 * @author Javier Ruiz Molero 
 **/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paleta de colores con degradado vertical</title>
    <style>
        h1 {
            font-family: system-ui;
            text-align: center;
        }
        td {
            color: #ffffff;
            padding: 1rem;
            font-family: monospace;
            text-align: center;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <h1>Paleta de colores con degradado vertical</h1>
    <table>
    <?php
    // Incremento en cada componente RGB para hacer un degradado progresivo
    $incrementR = 30;  // Incremento en el valor del Rojo
    $incrementG = 10;  // Incremento en el valor del Verde
    $incrementB = 10;  // Incremento en el valor del Azul
    
    for ($r = 0; $r <= 255; $r += $incrementR) {  // Rojo cambia lentamente
        echo "<tr>";
        for ($g = 0; $g <= 255; $g += $incrementG) {  // Verde cambia más rápido
            $b = $g / 2;  // Azul es la mitad del valor de Verde
            // Convertir valores RGB a hexadecimal
            $hex = sprintf("#%02x%02x%02x", $r, $g, $b);
            // Escapar el valor del color para la URL
            $hex_encoded = urlencode($hex);
            // Mostrar el color en una celda con un enlace a la página 'color.php'
            echo "<td style='background-color: $hex;'>
                    <a href='./color.php?color=$hex_encoded'>$hex</a>
                  </td>";
        }
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>
