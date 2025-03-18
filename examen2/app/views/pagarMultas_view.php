<?php

for($i = 0; $i<= count($_SESSION['datos']); $i++){
    foreach($_SESSION['datos'][$i]['multas'] as $multa){
        $multas = [$multa];
    }
}

foreach($multas as $multa){
    if($_SESSION['user']['id'] != $multa['id_conductor']){
        header('Location: /');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Pagar Multas</title>
</head>
<body>
    <h2>Multas del Conductor</h2>
    <?php
        foreach($multas as $multa){ ?>
            <form action="/multaPagada" method="POST">
                <label for="idMulta">IdMulta</label>
                <input type="text" name="idMulta" id="idMulta" value="<?php echo $multa['id'] ?>"><br>
                <label for="matricula">Matricula</label>
                <input type="text" name="matricula" id="matricula" value="<?php echo $multa['matricula']  ?>"><br>
                <label for="conductor">Conductor</label>
                <input type="text" name="conductor" id="conductor" value="<?php echo $_SESSION['datos'][0]['usuario']  ?>"><br>
                <label for="tipoInfraccion">Tipo de infraccion</label>
                <input type="text" name="tipoInfraccion" id="tipoInfraccion" value="<?php echo $multa['id_tipo_sanciones']  ?>"><br>
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $multa['descripcion']  ?>"><br>
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" value="<?php echo $multa['fecha']  ?>"><br>
                <label for="importe">Importe</label>
                <input type="text" name="importe" id="importe" value="<?php echo $multa['importe']  ?>"><br>
                <label for="bonificacion">Bonificacion</label>
                <input type="text" name="bonificacion" id="bonificacion" value="<?php echo $multa['descuento']  ?>"><br>
                <input type="submit" name="pagar" value="Pagar">
        <?php }
    ?>
    <br>
    <a href="/multas">Volver</a>
</body>
</html>