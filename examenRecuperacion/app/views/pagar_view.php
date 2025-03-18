<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>PAGAR</h1>

    <label for="idMulta">Id Multa</label>
    <b><?php echo $data['multa'][0]['id']; ?></b>
    <br>
    <label for="matricula">Matrícula</label>
    <b><?php echo $data['multa'][0]['matricula']; ?></b>
    <br>
    <label for="tipo">Tipo:</label>
    <b><?php echo $data['sancion'][0]['tipo']; ?></b>
    <br>
    <label for="descripcion">Descripción: </label>
    <b><?php echo $data['multa'][0]['descripcion']; ?></b>
    <br>
    <label for="fecha">Fecha:</label>
    <b><?php echo $data['multa'][0]['fecha']; ?></b>
    <br>
    <label for="importe">Importe:</label>
    <b><?php echo $data['multa'][0]['importe']; ?></b>
    <br>
    <label for="descuento">Descuento:</label>
    <b><?php echo $data['multa'][0]['descuento']; ?></b>
    <br>

    <form action="" method="post">
        <input type="submit" name="enviar" value="Pagar">
    </form>

    <a href="/">Volver</a>
</body>
</html>