<?php

$isLogged = false;
$perfil = "";

// Iniciamos sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    $isLogged = true;
    $perfil = "usuario";
} else {
    $perfil = "invitado";
}