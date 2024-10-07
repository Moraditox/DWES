<?php
/**
 * Vista del formulario y crear el formulario a partir de un array
 * Fecha --> 07/10/2024
 * @author Héctor Mora Sánchez
 */

 $datosPersonales = array("Nombre" => "nombre", 
                          "Apellidos" => "apellidos", 
                          "Email" => "email");
?>
<!-- VISTA -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Personal</title>
</head>
<body>
    <form action="procesarDatos.php" method="post">
        <?php
        foreach($datosPersonales as $datos => $valor){
            echo "<input type='text' name=$valor placeholder=$datos value=''>;";
        }
        ?>
        <input type="submit" name="enviar" id="Send">
    </form>
</body>
</html>