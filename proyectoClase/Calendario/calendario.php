<?php
/**
 * Calendario de festivos
 * (Fecha de iniciacion)
 * @author Héctor Mora Sánchez
 */
//VARIABLE QUE DETERMINA EL ESTADO DEL FORMULARIO
$lProcesaFormulario = false;

// Obtener el día actual
$hoy = date('j');
$mes = date('n');
$anio = date('Y');

if(isset($_POST['enviar'])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $mes = $_POST['mes'] + 1;  // Sumamos 1 porque $_POST['mes'] devuelve un índice (0-11)
    $anio = $_POST['anio'];
}

// Festivos nacionales
$festivos_nacionales = array(
    '01-01',   // Año Nuevo
    '06-01',   // Epifanía del Señor
    '01-05',   // Día del Trabajo
    '12-10',   // Fiesta Nacional de España
    '01-11',   // Todos los Santos
    '06-12',   // Día de la Constitución
    '25-12'    // Navidad
);

// Festivos autonómicos (Andalucía)
$festivos_autonomicos = array(
    '28-02',  // Día de Andalucía
    '28-03',  // Jueves Santo
    '29-03'   // Viernes Santo
);

// Festivos locales (Córdoba)
$festivos_locales = array(
    '09-09',  // Virgen de la Fuensanta
    '24-10'   // San Rafael
);

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
        $festivos_nacionales[] = sprintf("%02d-%02d", $dia, $mes);  // Agregamos con formato correcto
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
    <h1>¿En qué fecha estás?</h1>

    <form action="" method="POST">
        <select name="mes">
            <?php
                for($i = 0; $i < count($meses_anio); $i++){
                    $mesActual = $meses_anio[$i];
                    $selected = ($i + 1 == $mes) ? 'selected' : '';  // Si coincide con el mes seleccionado, lo marcamos
                    echo "<option value='$i' $selected> $mesActual </option>";
                }
            ?>
        </select>
        <input type="number" name="anio" placeholder="Año" value="<?php echo $anio ?>"/>
        <input type="submit" name="enviar" value="Enviar">
    </form>

    <!-- Incluir el calendario generado en PHP -->
    <?php
        $mes_actual = $meses_anio[$mes - 1]; // Corregir para obtener el nombre del mes
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
            $fecha_actual = sprintf("%02d-%02d", $dia, $mes);  // Formato de fecha

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

        echo "</tr>";
        echo "</table>";
    ?>
</body>
</html>