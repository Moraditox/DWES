<?php
// Obtener el valor del color de la URL
$color = isset($_GET['color']) ? htmlspecialchars($_GET['color']) : '#FFFFFF'; // Color blanco por defecto
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color: <?php echo $color; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: <?php echo $color; ?>;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 24px;
            font-family: Arial, sans-serif;
        }
        a {
            color: white;
            text-decoration: none;
            padding: 10px;
            border: 1px solid white;
            border-radius: 5px;
        }
        a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div>
        <h1>Este es el color: <?php echo $color; ?></h1>
        <a href="palet.php">Volver a la paleta de colores</a>
    </div>
</body>
</html>
