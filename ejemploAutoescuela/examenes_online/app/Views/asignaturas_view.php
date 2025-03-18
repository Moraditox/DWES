<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>
</head>
<body>
    <h1>Asignaturas</h1>
    <ul>
        <?php foreach ($data['asignaturas'] as $asignatura): ?>
            <li><?php echo htmlspecialchars($asignatura['nombre']); ?>: <?php echo htmlspecialchars($asignatura['descripcion']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>