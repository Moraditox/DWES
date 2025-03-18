<?php
// Festivos (puedes añadir más)
    $festivos = array(
        '1-1',   // Año Nuevo (1 de enero)
        '12-10', // Día de la Hispanidad (12 de octubre)
        '25-12', // Navidad (25 de diciembre)
    );

    // Obtener el día actual
    $hoy = date('j');
    $mes_actual = date('n');
    $año_actual = date('Y');

    // Obtener el primer día del mes
    $primer_dia_mes = mktime(0, 0, 0, $mes, 1, $año);
    // Días del mes
    $dias_mes = date('t', $primer_dia_mes);
    // Día de la semana en que empieza el mes (0 = domingo, 6 = sábado)
    $primer_dia_semana = date('w', $primer_dia_mes);

    // Nombres de los días de la semana
    $dias_semana = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];