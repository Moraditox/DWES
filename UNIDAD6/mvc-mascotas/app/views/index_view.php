<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mascotas</title>
    </head>
    <body>
        <h1>Estamos en la vista</h1>
        <a href="./mascotas/add">Añadir mascota</a>
        <?php
            foreach ($data['mascotas'] as $mascota) {
                echo "<p>Nombre:" . $mascota['nombre'] . "</p>";
                echo "<p>Peso:" . $mascota['peso'] . "</p>";
                echo "<p>Raza:" . $mascota['raza'] . "</p>";
                echo "<a href ='?id=".$mascota['id']."'>Editar</a><br/>";
                echo "<a href ='?id=".$mascota['id']."'>Borrar</a>";
                echo "<hr>";
            }
        ?>
    </body>
</html>