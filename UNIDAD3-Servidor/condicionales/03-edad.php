<?php
// 3. Carga fecha de nacimiento en variables y calcula la edad.

// fechaNacimiento
$diaNacimiento = "10";
$mesNacimiento = "08";
$anioNacimiento = "2005";

// fecha actual
$diaActual = date("d");
$mesActual = date("m");
$anioActual = date("Y");

// calcular edad por anio
$edad = $anioActual - $anioNacimiento;

// bajar la edad segun el mes y dias
if ($mesActual < $mesNacimiento || $mesActual == $mesNacimiento && $diaActual < $diaNacimiento){
    $edad--;
}
// mostrar edad
echo "Tu edad es: $edad";