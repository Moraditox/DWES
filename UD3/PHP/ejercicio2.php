<?php
// Cargar mes y año
$mes = 9;
$año = 2024;

// Función para verificar si un año es bisiesto
function esBisiesto($año) {
    return ($año % 4 == 0 && $año % 100 != 0) || ($año % 400 == 0);
}

// Usar switch para determinar el número de días según el mes
switch ($mes) {
    case 1: case 3: case 5: case 7: case 8: case 10: case 12:
        echo "El mes tiene 31 días.\n";
        break;
    case 4: case 6: case 9: case 11:
        echo "El mes tiene 30 días.\n";
        break;
    case 2:
        if (esBisiesto($año)) {
            echo "El mes tiene 29 días (Año bisiesto).\n";
        } else {
            echo "El mes tiene 28 días.\n";
        }
        break;
    default:
        echo "Mes inválido. Debe ser un número entre 1 y 12.\n";
        break;
}
?>
