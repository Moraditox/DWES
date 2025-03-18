<?php

use App\Models\Usuarios;

$isLogged = false;
$usuario = Usuarios::getInstancia();

// Iniciamos sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['perfil_usuario']) && isset($_SESSION['user_id'])) {
    if($usuario->getConductores($_SESSION['user_id'])){
        $_SESSION['perfil_usuario'] = 'conductor';
        $isLogged = true;
    } elseif($usuario->getAgentes($_SESSION['user_id'])){
        $_SESSION['perfil_usuario'] = 'agente';
        $isLogged = true;
    } elseif($usuario->getAdmins($_SESSION['user_id'])){
        $_SESSION['perfil_usuario'] = 'admin';
        $isLogged = true;
    }
} else {
    $_SESSION['perfil_usuario'] = 'invitado';
}