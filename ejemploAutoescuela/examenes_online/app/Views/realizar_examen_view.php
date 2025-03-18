<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Examen</title>
</head>
<body>
    <?php include("header.php"); ?>
    <h1>Realizar Examen</h1>
    <form action="/examenes/submit" method="post">
        <input type="hidden" name="examen_id" value="<?php echo htmlspecialchars($data['examen_id']); ?>">
        <?php foreach ($data['preguntas'] as $pregunta): ?>
            <div>
                <p><?php echo htmlspecialchars($pregunta['enunciado']); ?></p>
                <input type="radio" name="respuesta[<?php echo $pregunta['id']; ?>]" value="A"> <?php echo htmlspecialchars($pregunta['opcion_a']); ?><br>
                <input type="radio" name="respuesta[<?php echo $pregunta['id']; ?>]" value="B"> <?php echo htmlspecialchars($pregunta['opcion_b']); ?><br>
                <input type="radio" name="respuesta[<?php echo $pregunta['id']; ?>]" value="C"> <?php echo htmlspecialchars($pregunta['opcion_c']); ?><br>
                <input type="radio" name="respuesta[<?php echo $pregunta['id']; ?>]" value="D"> <?php echo htmlspecialchars($pregunta['opcion_d']); ?><br>
            </div>
        <?php endforeach; ?>
        <button type="submit">Enviar Examen</button>
    </form>
</body>
</html>