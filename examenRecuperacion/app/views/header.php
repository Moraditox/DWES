<?php
require_once "logued.php";

if ($_SESSION['perfil_usuario'] == "conductor" || $_SESSION['perfil_usuario'] == "agente" || $_SESSION['perfil_usuario'] == "admin") {
?>
    <p>Bienvenido <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
    <a href="/">Inicio</a>
    <?php
        if ($_SESSION['perfil_usuario'] == "agente") {
            echo "<a href='/multas/nuevaMulta/'>Nueva multa</a>";
        }
    ?>
    <a href="/usuarios/logout">Cerrar sesión</a>

<?php
} else {
?>
    <p>Bienvenido Invitado</p>
    <a href="/">Inicio</a>
    <a href="/usuarios/login">Iniciar sesión</a>
<?php
}