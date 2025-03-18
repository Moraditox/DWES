<?php
function obtenerImagenEstacion() {
    // Obtener el mes actual
    $mes = date("n"); // El mes en número (1 a 12)

    // Asignar imagen en función del mes (estación del año)
    if ($mes >= 3 && $mes <= 5) {
        // Primavera
        return "../img/primavera.jpeg";
    } elseif ($mes >= 6 && $mes <= 8) {
        // Verano
        return "../img/verano.jpeg";
    } elseif ($mes >= 9 && $mes <= 11) {
        // Otoño
        return "../img/otono.jpeg";
    } else {
        // Invierno
        return "../img/invierno.jpeg";
    }
}
// Definir color de fondo según la hora del día
function obtenerColorFondo() {
    // Obtener la hora actual
    $hora = date("H"); // Hora en formato 24 horas (0-23)
    // Asignar color en función de la hora
    if ($hora >= 6 && $hora < 12) {
        // Mañana: 6:00 - 11:59
        return "#FFEB99"; // Amarillo claro
    } elseif ($hora >= 12 && $hora < 18) {
        // Tarde: 12:00 - 17:59
        return "#FFCC66"; // Naranja claro
    } elseif ($hora >= 18 && $hora < 21) {
        // Atardecer: 18:00 - 20:59
        return "#FF9966"; // Naranja oscuro
    } else {
        // Noche: 21:00 - 5:59
        return "#333366"; // Azul oscuro
    }
}

$imagenCabecera = obtenerImagenEstacion();
$colorFondo = obtenerColorFondo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javier Ruiz</title>
    <style>
        body{
            background-color: <?= $colorFondo ?>; /* color de fondo con = */
        }
        img{
            width: 90vw;
        }
        h1{
            color: white;
        }
    </style>
</head>
<body>
    <h1>Imagen cabecera</h1>
    <img src="<?= $imagenCabecera ?>" alt=""> <!-- imagen de cabecera -->
</body>
</html>