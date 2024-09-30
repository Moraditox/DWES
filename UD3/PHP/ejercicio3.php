<?php
// Cargar fecha de nacimiento
$dia_nac = 16;
$mes_nac = 06;
$año_nac = 2005;

// Obtener la fecha actual
$dia_actual = (int)date("d");
$mes_actual = (int)date("m");
$año_actual = (int)date("Y");

// Calcular la edad inicial
$edad = $año_actual - $año_nac;

// Ajustar la edad si aún no ha cumplido este año
if ($mes_actual < $mes_nac || ($mes_actual == $mes_nac && $dia_actual < $dia_nac)) {
    $edad--;
}

// Mostrar la edad
echo "Tu edad es: $edad años.\n";
?>
