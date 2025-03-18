<?php
require_once "logued.php";

if ($_SESSION['perfil_usuario'] == "usuario") {
?>
    <p>Bienvenido <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
    <a href="/">Inicio</a>
    <a href="/examenes/realizar">Realizar Examen</a>
    <a href="/notas">Mis Notas</a>
    <a href="/usuarios/logout">Cerrar sesión</a>
    <a href="/usuarios/update">Editar cuenta</a>
<?php
} else {
?>
    <p>Bienvenido Invitado</p>
    <a href="/">Inicio</a>
    <a href="/usuarios/login">Iniciar sesión</a>
    <a href="/usuarios/add">Registrarse</a>
<?php
}