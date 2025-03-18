<?php 
session_start();

if(!isset($_SESSION["nombre"])){
    $_SESSION["nombre"] = "javier";
    $_SESSION["apellidos"] = "ruiz";
}
?>
