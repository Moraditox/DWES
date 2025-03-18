<?php
/**
 * Enunciado: Escriba una página que permita crear una cookie de duración limitada,
 * comprobar el estado de la cookie y destruirla.
 * @author javier ruiz
 */

$lProcesaFormulario = false;
$mError = "";
$dCookies = false;

if (isset($_POST["submit"])) {
    $lProcesaFormulario = true;
}

if ($lProcesaFormulario) {
    $name = $_POST["name"];

    if ($name == "") {
        $mError = "Error: El campo no puede estar vacío.";
    } else {
        setcookie("name", $name, time() + 3600); // Cookie con duración de 1 hora
    }
}

// Verificar la eliminación de la cookie
if (isset($_POST["eliminar"]) && isset($_COOKIE["name"])) {
    $dCookies = true;
}

if ($dCookies) {
    setcookie("name", "", time() - 3600); // Eliminar la cookie
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javier</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <form action="" method="post">
        <input type="text" name="name">
        <span style="color: red;"><?php echo $mError; ?></span><br/>

        <button name="eliminar" type="submit">Eliminar</button>

        <input type="submit" value="Enviar" name="submit">
    </form>
    <h2>Estado de la Cookie</h2>
    <?php 
    if (isset($_COOKIE["name"])) {
        echo "La cookie existe. Valor: <strong>" . htmlspecialchars($_COOKIE["name"]) . "</strong>";
    } elseif ($dCookies) {
        echo "La cookie ha sido eliminada.";
    } else {
        echo "No hay ninguna cookie activa.";
    }
    ?>
</body>
</html>
