<?php
/**
 * Enunciado: Crear un script para sumar una serie de números. El número de números a sumar
 * será introducido en un formulario.
 * @Author javier ruiz molero
 */

$lProcesaFormulario = false;
$lSerieNumeros = false;
$suma = 0;

// Envia el primer formulario
if (isset($_POST["enviar"])) {
    $lProcesaFormulario = true;
    $serieNumeros = $_POST["serieNumeros"];
}

// Envia los numero a sumar
if (isset($_POST["calcularSuma"])) {
    $lSerieNumeros = true;
    $todosNumeros = $_POST["numeros"]; // Capturamos los números como array

    // Sumamos todos los números
    foreach ($todosNumeros as $unNumero) {
        $suma += $unNumero;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Números</title>
    <style>
        body{
            margin: 0 10vw;
        }
        h1 {
            font-size: 4vw;
            text-align: center;
            font-family: monospace;
        }
        h3 {
            font-size: 2vw;
            font-family: monospace;
            margin-bottom: 4vw;
        }
        form{
            margin-top: 2vw;
        }
        label {
            font-size: 2vw;
            font-family: monospace;
        }
        input{
            margin-bottom: 2vw;
            font-size: 2vw;
        }
        .boton {
            padding: 1.5vw;
            display: block;
            background: black;
            color: white;
            border: 0;
            font-size: 3vw;
            margin-bottom: 3vw;
        }
        a {
            color: white;
            background-color: red;
            text-decoration: none;
            padding: 2vw;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <h1>SUMA DE NÚMEROS</h1>

    <?php
    // Muestra el primer formulario
    if (!$lProcesaFormulario && !$lSerieNumeros) { ?>
        <form action="" method="post">
            <h3>Introduce cuántos números quieres sumar:</h3>
            <input type="number" name="serieNumeros" id="serieNumeros" min="1" required>
            <input type="submit" value="Enviar" name="enviar" class="boton">
        </form>
    <?php
    } elseif ($lProcesaFormulario) { // Muestra el segundo formulario?>
        <h3>Introduce los números a sumar:</h3>
        <form action="" method="post">
            <?php
            for ($numero = 1; $numero <= $serieNumeros; $numero++) {
                echo "<label for='numeros$numero'>Número $numero:</label>";
                echo "<input type='number' name='numeros[]' id='numeros$numero' required><br>";
            }
            ?>
            <input type="submit" value="Calcular Suma" name="calcularSuma" class="boton">
            <a href="">Volver a comenzar</a>
        </form>
    <?php
    } elseif ($lSerieNumeros) { //Muestra el resultado de la suma ?>
        <h3>La suma de los números es: <?php echo $suma; ?></h3>
        <a href="">Volver a comenzar</a>
    <?php
    } ?>
</body>
</html>
