<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mascotas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<h1>Nueva Mascota:</h1>
<?php
    echo '<form method="post" action="">';
    echo '<label>Nombre:</label>';
    echo '<input type="text" id="nombre" name="nombre" value="'.$data['nombre'].'" />'.$data['msjErrorNombre'].'<br/>';
    echo '<label">Raza:</label>';
    echo '<input type="text" id="raza" name="raza" value="'.$data['raza'].'" />'.$data['msjErrorRaza'];
    echo '<br/>';
    echo '<label">Peso:</label>';
    echo '<input id="peso" name="peso" value="'.$data['peso'].'" />'.$data['msjErrorPeso'];
    echo "<br/>";
    echo '<div class="col text-center">';
    echo '<input type="submit" id="save" name="save" value ="Enviar">';			
    echo '</div>';                    
    echo '</form>';
?>
</div>
</body>
</html>