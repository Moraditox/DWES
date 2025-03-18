<?php
/**
 * Enunciado:
 * 2. Indexar los ejercicios mediante un array.
 * @author Javier Ruiz Molero 
 **/
$ejercicios = [
    "arrays" => [
        "01-arrays.php",
        "02-arrays.php"
    ],
    "bucles" => [
        "01-bucles.php",
        "02-bucles.php",
        "03-bucles.php",
        "04-bucles" => [
            "color.php",
            "palet.php"
        ]
    ],
    "condicionales" => [
        "01-Practicas.php",
        "02-switch.php",
        "03-edad.php",
        "04-estaciones.php",
        "05-enlaces.php"
    ]
];

// Función para mostrar los enlaces a los ejercicios
function mostrarEjercicios($carpeta, $archivos) {
    foreach ($archivos as $subcarpeta => $archivo) {
        if (is_array($archivo)) {
            // Si es una subcarpeta (array), agregamos la carpeta actual a la ruta
            echo "<h3>$subcarpeta</h3>";
            mostrarEjercicios("$carpeta/$subcarpeta", $archivo); // Añadimos subcarpeta a la ruta
        } else {
            // Mostrar el archivo como un enlace
            echo "<li><a href='../$carpeta/$archivo'>$archivo</a></li>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice de Ejercicios</title>
    <style>
        h1{
            font-size: 2rem;
            font-family: monospace;
        }
    </style>
</head>
<body>

<h1>Índice de Ejercicios</h1>

<ul>
    <?php
    // Mostrar enlaces a los archivos dentro de arrays
    foreach ($ejercicios as $carpeta => $archivos) {
        echo "<h2>$carpeta</h2><ul>";
        mostrarEjercicios($carpeta, $archivos);
        echo "</ul>";
    }
    ?>
</ul>

</body>
</html>
