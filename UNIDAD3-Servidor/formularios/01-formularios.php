<?php
/**
 * Modifica el ejercicio del calendario para que el mes y el año se lean en un
 * formulario. Añade las siguientes especificaciones:
 * a. Por defecto se carga el mes y año actual.
 * b. Definición de días festivos en un array.
 * c. Utilizar colores para diferenciar festivos nacionales, de comunidad y locales.
 * d. Cada día será un enlace a una página que mostrará la fecha seleccionda.
 * @author Javier Ruiz Molero 
**/
$lProcesaFormulario = false;

// Mes y anio (numero)
$diaActual = date("d");
$mesActual = date("m");
$anioActual = date("Y");

if(isset($_POST["enviar"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $mesActual = $_POST["mesInput"];
    $anioActual = $_POST["anioInput"];
}




// Dias festivos Locales
$festivosLocales = array(
    "$anioActual-09-09",
    "$anioActual-10-24"
);

// Dias festivos Comunidad
$festivosComunidad = array(
    "$anioActual-02-28",
);

// Dias festivos Nacionales
$festivosNacional = array(
    "$anioActual-01-01",
    "$anioActual-01-06",
    "$anioActual-05-01",
    "$anioActual-08-15",
    "$anioActual-10-12",
    "$anioActual-11-01",
    "$anioActual-12-06",
    "$anioActual-12-09",
    "$anioActual-12-25",
);


// Obtener el nombre del mes
$nombreMes = date("F");

// Obtener el primer día del mes
$primerDia = mktime(0, 0, 0, $mesActual, 1, $anioActual);
$diaInicio = date("w", $primerDia); // Día de la semana del primer día del mes
$diaInicio = ($diaInicio + 6) % 7;

$diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual); // Total de días en el mes
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        h1 {
            font-size: 3rem;
            text-align: center;
            font-family: system-ui;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Para evitar bordes dobles */
        }
        th {
            font-size: 1.5rem;
            font-family: system-ui;
        }
        td {
            text-align: center;
            font-family: system-ui;
            font-size: 1rem;
            padding: 1rem;
        }
        .fin-de-semana {
            background-color: hotpink; /* Color para sábados y domingos */
        }
        .nombresSemana{
            border-bottom: 1px solid black;
        }
        .local{
            background-color: pink;
        }
        .comunidad{
            background-color: green;
        }
        .nacional{
            background-color: red;
        }
        .actual{
            background-color: greenyellow;
        }
    </style>
</head>
<body>
    <h1>Calendario de <?= $nombreMes ?> de <?= $anioActual ?></h1>
    <form action="" method="post">
        <select name="mesInput" id="">
        <option value="01" <?= $mesActual == '01' ? 'selected' : '' ?>>Enero</option>
            <option value="02" <?= $mesActual == '02' ? 'selected' : '' ?>>Febrero</option>
            <option value="03" <?= $mesActual == '03' ? 'selected' : '' ?>>Marzo</option>
            <option value="04" <?= $mesActual == '04' ? 'selected' : '' ?>>Abril</option>
            <option value="05" <?= $mesActual == '05' ? 'selected' : '' ?>>Mayo</option>
            <option value="06" <?= $mesActual == '06' ? 'selected' : '' ?>>Junio</option>
            <option value="07" <?= $mesActual == '07' ? 'selected' : '' ?>>Julio</option>
            <option value="08" <?= $mesActual == '08' ? 'selected' : '' ?>>Agosto</option>
            <option value="09" <?= $mesActual == '09' ? 'selected' : '' ?>>Septiembre</option>
            <option value="10" <?= $mesActual == '10' ? 'selected' : '' ?>>Octubre</option>
            <option value="11" <?= $mesActual == '11' ? 'selected' : '' ?>>Noviembre</option>
            <option value="12" <?= $mesActual == '12' ? 'selected' : '' ?>>Diciembre</option>
        </select>
        <input type="number" name="anioInput" value="<?php echo $anioActual ?>" min="1900" max="2100">
        <input type="submit" value="enviar" name="enviar">
    </form>
    <table>
        <tr class="nombresSemana">
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
            <th>Domingo</th>
        </tr>
        <?php
        // Espacio en blanco para los días del mes anterior
        for ($i = 0; $i < $diaInicio; $i++) {
            echo "<td></td>";
        }
        // Días del mes actual
        for ($dia = 1; $dia <= $diasEnMes; $dia++) {
            // Formato de la fecha
            $fechaActual = "$anioActual-$mesActual-" . str_pad($dia, 2, '0', STR_PAD_LEFT);

            // Comprobar el día de la semana
            $diaDeLaSemana = date("w", mktime(0, 0, 0, $mesActual, $dia, $anioActual));
            
            // Aplicar estilos según el día
            if (in_array($fechaActual, $festivosLocales)) {
                echo "<td class='local'>" . $dia . "</td>";
            } elseif(in_array($fechaActual, $festivosNacional)) {
                echo "<td class='nacional'>" . $dia . "</td>";
            } elseif(in_array($fechaActual, $festivosComunidad)){
                echo "<td class='comunidad'>" . $dia . "</td>";
            } elseif ($dia == $diaActual) {
                echo "<td class='actual'>" . $dia . "</td>";
            } elseif ($diaDeLaSemana == 0) { // Domingo (6) o Sábado (5)
                echo "<td class='fin-de-semana'>" . $dia . "</td>";
            } else {
                echo "<td>" . $dia . "</td>";
            }

            // Si es domingo, iniciar una nueva fila
            if ($diaInicio % 7 == 6) {
                echo "</tr><tr>";
            }

            $diaInicio++;
        }
        echo "</tr>";
        echo "</table>";
        ?>
    </table>
</body>
</html>
