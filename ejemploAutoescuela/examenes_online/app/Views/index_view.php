<?php 
require_once "logued.php";
include("header.php");

?>

<?php
if (isset($_SESSION['perfil_usuario']) && $_SESSION['perfil_usuario'] == "usuario") {
    echo "<h1>Bienvenido, " . htmlspecialchars($_SESSION['user_name']) . "!</h1>";
    echo "<p>Realizar exámenes.</p>";
    echo "<h2>DATOS DEL USUARIO</h2>";
    echo "<p>Nombre: " . htmlspecialchars($_SESSION['user_name']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($_SESSION['email']) . "</p>";
    echo "<p>Foto: <img src='/img/" . htmlspecialchars($_SESSION['foto']) . "' alt='Foto de perfil' style='width: 90px'></p>";
    
} else {
    echo "<h1>Bienvenido a nuestra plataforma de exámenes en línea</h1>";
    echo "<h2>Usuarios del sistema</h2>";
  
    if (isset($data['usuarios']) && is_array($data['usuarios'])) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Foto</th></tr>";
        foreach ($data['usuarios'] as $usuario) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($usuario['id']) . "</td>";
            echo "<td>" . htmlspecialchars($usuario['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($usuario['apellidos']) . "</td>";
            echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
            echo "<td><img src='/img/" . htmlspecialchars($usuario['foto'] ?? 'default.png') . "' alt='Foto de perfil' style='width: 90px'></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay usuarios para mostrar.</p>";
    }
}
?>