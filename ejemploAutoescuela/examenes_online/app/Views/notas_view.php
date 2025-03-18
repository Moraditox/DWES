

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Notas</title>
</head>
<body>
    <?php include("header.php"); ?>
    <h1>Mis Notas</h1>
    <table>
        <thead>
            <tr>
                <th>Examen</th>
                <th>Nota</th>
                <th>Fecha de Realización</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['notas'] as $nota): ?>
                <tr>
                    <td><?php echo htmlspecialchars($nota['titulo_examen']); ?></td>
                    <td><?php echo htmlspecialchars($nota['nota']); ?></td>
                    <td><?php echo htmlspecialchars($nota['fecha_realizacion']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>