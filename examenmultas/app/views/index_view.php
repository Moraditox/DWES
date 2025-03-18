<?php
require_once "logued.php";
include("header.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Index</title>
</head>

<body>

    <?php
    // Suponiendo que en tu controlador (indexAction) pasas un array $data 
    // y que ya has hecho session_start() antes de renderizar la vista.

    if ($_SESSION['perfil_usuario'] === 'invitado') {
        echo '<h1>Vista perfil invitado</h1>';
    } elseif ($_SESSION['perfil_usuario'] === 'admin') {
        echo '<h1>Vista perfil admin</h1>';
        ?>
        <h1>Buscar Conductores</h1>
        <form method="POST" action="/conductores/buscar">
            <input type="text" name="query" placeholder="Buscar conductores...">
            <input type="submit" value="Buscar">
        </form>
        <div id="resultados">
            <?php if (!empty($data['conductores'])): ?>
                <table border="1">
                    <tr>
                        <th>Nombre</th>
                        <th>Puntos</th>
                        <th>Número de Sanciones</th>
                    </tr>
                    <?php foreach ($data['conductores'] as $conductor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($conductor['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($conductor['puntos']); ?></td>
                            <td><?php echo htmlspecialchars($conductor['num_sanciones']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No se encontraron conductores.</p>
            <?php endif; ?>
        </div>
       
    <?php
    } elseif ($_SESSION['perfil_usuario'] === 'agente') {
        echo '<h1>Vista perfil agente</h1>';
        if (!empty($data['multasAgente'])) {
            echo '<table border="1">';
            echo '<tr><th>Matrícula</th><th>Descripción</th><th>Fecha</th><th>Estado</th></tr>';
            foreach ($data['multasAgente'] as $multa) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($multa['matricula']) . '</td>';
                echo '<td>' . htmlspecialchars($multa['descripcion']) . '</td>';
                echo '<td>' . htmlspecialchars($multa['fecha']) . '</td>';
                echo '<td>' . htmlspecialchars($multa['estado']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<br>';
            echo '<a href="/multas/nuevaMulta/">Nueva Multa</a>';
        } else {
            echo '<p>No hay multas registradas por el agente.</p>';
        }
    } elseif ($_SESSION['perfil_usuario'] === 'conductor') {
        echo '<h1>Vista perfil conductor</h1>';
        if (!empty($data['multasConductor'])) {
            // Ordenar las multas por fecha en orden decreciente
            usort($data['multasConductor'], function ($a, $b) {
                return strtotime($b['fecha']) - strtotime($a['fecha']);
            });

            echo '<table border="1">';
            echo '<tr><th>Matrícula</th><th>Descripción</th><th>Fecha</th><th>Estado</th><th>Acción</th></tr>';
            foreach ($data['multasConductor'] as $multa) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($multa['matricula']) . '</td>';
                echo '<td>' . htmlspecialchars($multa['descripcion']) . '</td>';
                echo '<td>' . htmlspecialchars($multa['fecha']) . '</td>';
                echo '<td>' . htmlspecialchars($multa['estado']) . '</td>';
                echo '<td>';
                if ($multa['estado'] === 'Pendiente') {
                    echo '<a href="/multas/pagar/' . urlencode($multa['id']) . '">Pagar</a>';
                }
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No hay multas para este usuario.</p>';
        }
    }
    ?>

</body>

</html>