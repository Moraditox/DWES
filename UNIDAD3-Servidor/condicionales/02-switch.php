<?php
/* Carga en variables mes y año e indica el número de días del mes. Utiliza la
estructura de control switch */

// Fecha del sistema
$mes = date("m");
$ano = date("Y");

// Switch con rangos
switch (true){
    // Casos 31 dias
    case $mes =="01" || $mes == "03" || $mes =="05" || $mes == "07" || $mes =="08" || $mes == "10" || $mes == "12":
        echo "El mes tiene 31 dias";
        break;
    // Casos 30 dias
    case $mes =="04" || $mes == "06" || $mes =="09" || $mes == "11":
        echo "El mes tiene 30 dias";
        break;
    // Bisiesto
    case $mes == "02" && $anio % 4 ==0:
        echo "El mes tiene 29 dias, es bisiesto";
        break;
    // Febrero
    case "02":
        echo "El mes tiene 28 dias";
        break;
        
}