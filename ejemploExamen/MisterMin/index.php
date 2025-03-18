<?php
/**
 * Juego de MisterMin en PHP
 * 
 * @author Héctor Mora Sánchez
 * @date 2025-02-11
 */
include 'conf/config.php';

session_start();
if(!isset($_SESSION['combinacion'])){
    for($i = 0; $i < MAX_COLUMS; $i++){
        $_SESSION['combinacion'][$i] = COLORES[rand(0, count(COLORES) - 1)];
    }
    $_SESSION['intentos'] = 0;
    $_SESSION['resultado'] = [];
}

if(isset($_POST['reiniciar'])){
    session_unset();
    session_destroy();
    for($i = 0; $i < MAX_COLUMS; $i++){
        $_SESSION['combinacion'][$i] = COLORES[rand(0, count(COLORES) - 1)];
    }
    $_SESSION['intentos'] = 0;
    $_SESSION['resultado'] = [];
}

if(isset($_POST['comprobar'])){
    $_SESSION['intentos']++;
    
    $color1 = $_POST['combinacion'][0];
    $color2 = $_POST['combinacion'][1];
    $color3 = $_POST['combinacion'][2];
    $color4 = $_POST['combinacion'][3];
    $colores = [$color1, $color2, $color3, $color4];

    $resultado = [];
    foreach($colores as $index => $color){
        if($color == $_SESSION['combinacion'][$index]){
            $resultado[] = 'green';
        }else{
            $resultado[] = in_array($color, $_SESSION['combinacion']) ? 'orange' : 'red';
        }
    }
    $_SESSION['resultado'][] = $resultado;

    if(count(array_filter($resultado, fn($color) => $color == 'green')) == MAX_COLUMS){
        echo "<h1>Has ganado</h1>";
        exit();
    }else if($_SESSION['intentos'] == MAX_INTENTOS){
        echo "<h1>Has perdido</h1>";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de MisterMin</title>
</head>
<body>
    <h1>MisterMin</h1>
    <form action="" method="POST">
        <?php
        for($fila = 1; $fila <= $_SESSION['intentos'] + 1; $fila++){
            if($fila <= MAX_INTENTOS){
                for($i = 0; $i < MAX_COLUMS; $i++){
                    echo "<select name='combinacion[$i]'>";
                    foreach(COLORES as $color){
                        echo "<option value='$color'>$color</option>";
                    }
                    echo "</select>";
                }
                if($fila <= $_SESSION['intentos']){
                    foreach($_SESSION['resultado'][$fila - 1] as $color){
                        echo "<div style='background-color: $color; width: 20px; height: 20px; display: inline-block; margin: 10px;'></div>";
                    }
                }
                echo " ";
                echo "<input type='submit' name='comprobar' value='Comprobar'>";
                echo "<br>";
            }
        }
        var_dump($_SESSION['combinacion']);
        echo "<p>Intentos: {$_SESSION['intentos']}</p>";
        ?>
        <input type="submit" name="reiniciar" value="Reiniciar">
    </form>
</body>
</html>
