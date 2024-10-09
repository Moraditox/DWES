<?php
/**
 * Formulario.
 * Fecha -> 08/10/2024
 * @author Héctor Mora Sánchez
 */

 //Array Indexado que contiene los grupos
 $arrayGrupos = array("1º DAW", "2º DAW", "1º ASIR", "2º ASIR");
?>
<!-- VISTA -->
 <!DOCTYPE html>
 <html lang="es">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
 </head>
 <body>
    <form action="procesa.php" method="post">
        <input type="text" name="nombre" placeholder="Nombre" value="">
        <input type="text" name="apellidos" placeholder="Apellidos" value="">
        <input type="text" name="email" placeholder="Email" value="">
        <select name="grupos">
            <?php
                foreach ($arrayGrupos as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                }
            ?>
        </select>
        <input type="submit" name="enviar">
    </form>
 </body>
 </html>