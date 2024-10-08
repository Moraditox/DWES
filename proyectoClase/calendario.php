<?php
/**
 * Calendario de festivos
 * (Fecha de iniciacion)
 * @author Héctor Mora Sánchez
 */
// Festivos nacionales
$festivos_nacionales = array(
    '1-1',   // Año Nuevo
    '6-1',   // Epifanía del Señor
    '1-5',   // Día del Trabajo
    '12-10', // Fiesta Nacional de España
    '1-11',  // Todos los Santos
    '6-12',  // Día de la Constitución
    '25-12'  // Navidad
);

// Festivos autonómicos (Andalucía)
$festivos_autonomicos = array(
    '28-2',  // Día de Andalucía
    '28-3',  // Jueves Santo
    '29-3'   // Viernes Santo
);

// Festivos locales (Córdoba)
$festivos_locales = array(
    '9-9',   // Virgen de la Fuensanta
    '24-10'  // San Rafael
);

// Obtener el día actual
$hoy = date('j');
$mes = date('n');
$anio = date('Y');

// Obtener el primer día del mes
$primer_dia_mes = mktime(0, 0, 0, $mes, 1, $anio);
// Días del mes
$dias_mes = date('t', $primer_dia_mes);
// Día de la semana en que empieza el mes (0 = domingo, 6 = sábado)
$primer_dia_semana = date('w', $primer_dia_mes);

// Añadir todos los domingos del mes a los festivos nacionales
for ($dia = 1; $dia <= $dias_mes; $dia++) {
    $dia_semana = date('w', mktime(0, 0, 0, $mes, $dia, $anio));
    if ($dia_semana == 0) { // Si es domingo
        $festivos_nacionales[] = "$dia-$mes"; // Consideramos los domingos como festivos nacionales
    }
}

// Nombres de los días de la semana
$dias_semana = array ('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb');

$meses_anio = array ('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
?>
<!-- VISTA -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <!-- Incluir el calendario generado en PHP -->
    <?php
        $mes_actual = $meses_anio[$mes - 1];
        echo "<h2>Calendario de $mes_actual del $anio</h2>";
        // Mostrar el calendario
        echo "<table>";
        echo "<tr>";
        foreach ($dias_semana as $dia) {
            echo "<th>$dia</th>";
        }
        echo "</tr><tr>";

        // Rellenar con celdas vacías hasta el primer día del mes
        for ($i = 0; $i < $primer_dia_semana; $i++) {
            echo "<td></td>";
        }

        // Mostrar los días del mes
        for ($dia = 1; $dia <= $dias_mes; $dia++) {
            $fecha_actual = "$dia-$mes";

            // Verificar si es festivo nacional, autonómico o local
            $es_festivo_nacional = in_array($fecha_actual, $festivos_nacionales);
            $es_festivo_autonomico = in_array($fecha_actual, $festivos_autonomicos);
            $es_festivo_local = in_array($fecha_actual, $festivos_locales);

            // Verificar si es el día actual
            $es_hoy = ($dia == $hoy && $mes == date('n') && $anio == date('Y'));

            // Aplicar clase CSS según el tipo de festivo
            $clase = '';
            if ($es_hoy) {
                $clase = 'hoy';
            } elseif ($es_festivo_nacional) {
                $clase = 'festivo-nacional';
            } elseif ($es_festivo_autonomico) {
                $clase = 'festivo-autonomico';
            } elseif ($es_festivo_local) {
                $clase = 'festivo-local';
            }

            // Mostrar la celda con la clase correspondiente
            echo "<td class='$clase'>$dia</td>";

            // Cerrar la fila al llegar al sábado
            if (($dia + $primer_dia_semana) % 7 == 0 && $dia != $dias_mes) {
                echo "</tr><tr>";
            }
        }

        // Rellenar las últimas celdas si el mes no termina en sábado
        while (($dia + $primer_dia_semana) % 7 != 1) {
            echo "<td></td>";
            $dia++;
        }

        echo "</tr>";
        echo "</table>";
    ?>
</body>
</html>