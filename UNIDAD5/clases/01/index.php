<?php

// Requerimos clase persona
require_once "01-clase.php";

// Creamos una persona
$persona = new Persona("Javier", "Ruiz", "Molero");

$persona -> saludo();
echo $persona -> nombre();
?>

