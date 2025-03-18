<?php

$isLogged = false;
$perfil = "";

// Iniciamos sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['perfil'])) {
    $perfil = $_SESSION['perfil'];
    if (in_array($perfil, ['conductor', 'agente', 'admin'])) {
        $isLogged = true;
    } else {
        $perfil = 'invitado';
    }
} else {
    $perfil = 'invitado';
}