<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enlaces según perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php
    // Definir el perfil del usuario
    // Cambia esta variable a "Usuario" o "Administrador" para ver los resultados.
    $perfil = "Adminstrador"; // Ejemplo: "Administrador" o "Usuario"

    // Mostrar enlaces según el perfil
    if ($perfil === "Administrador") {
        echo "<ul>";
        echo "<li><a href='#'>Página 1</a></li>";
        echo "<li><a href='#'>Página 2</a></li>";
        echo "<li><a href='#'>Página 3</a></li>";
        echo "<li><a href='#'>Página 4</a></li>";
        echo "</ul>";
    } elseif ($perfil === "Usuario") {
        echo "<ul>";
        echo "<li><a href='#'>Página 1</a></li>";
        echo "<li><a href='#'>Página 2</a></li>";
        echo "</ul>";
    } else {
        echo "<p>No tienes un perfil válido asignado.</p>";
    }
?>
</body>