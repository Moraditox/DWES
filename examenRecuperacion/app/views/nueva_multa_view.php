<?php 
include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    
    <h1>Nueva multa</h1>
    <br/>

    <form action="" method="post">
        <label for="matricula">Matricula:</label>
        <input type="text" id="matricula" name="matricula" value="<?php echo $data['matricula'];?>">
        <div class="error"><?php echo $data['msjErrorMatricula']; ?></div>
        <br/>
        <label for="descripcion">Descripcion:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $data['descripcion'];?>">
        <div class="error"><?php echo $data['msjErrorDescripcion']; ?></div>
        <br/>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $data['fecha'];?>">
        <div class="error"><?php echo $data['msjErrorFecha']; ?></div>
        <br/>
        <label for="importe">Importe:</label>
        <input type="text" id="importe" name="importe" value="<?php echo $data['importe'];?>">
        <div class="error"><?php echo $data['msjErrorImporte']; ?></div>
        <br/>
        <label for="descuento">Descuento:</label>
        <input type="text" id="descuento" name="descuento" value="<?php echo $data['descuento'];?>">
        <div class="error"><?php echo $data['msjErrorDescuento']; ?></div>
        <br/>
        <label for="usuario">Usuario:</label>
        <select id="usuario" name="usuario">
            <?php foreach($data['usuarios'] as $usuario): ?>
                <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['usuario']; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="tipo">Selecciona el tipo de Sanción </label>
            <?php foreach($data['sancion'] as $sancion): ?>
                <div>
                    <input type="radio" id="tipo" name="tipo" value="<?php echo $sancion['id']; ?>">
                    <label for="tipo"><?php echo $sancion['tipo']; ?></label>
                </div>
            <?php endforeach; ?>
        <div class="error"><?php echo $data['msjErrorTipo']; ?></div>
            
        
        <input type="submit" name="enviar" value="Multar">
        <br/>
    </form>



</body>
</html>