<?php
/**
 * 
 * 
 */
require_once("../app/Config/config.php");
require_once("../app/Models/Mascotas.php");

//Creamos perros sin utilizar el patron de diseño
$perros1 = new Perros();
$perros2 = new Perros();
//Se han creado dos objetos

//Creamos mascotas utilizando el patron de diseño
$perros3 = Perros::getinstancia();
$perros4 = Perros::getinstancia();
//Se ha creado un solo objeto

$perros = Perros::getinstancia();
$perros -> setNombre("Dacota");
$perros -> setPeso(50);
$perros -> setRaza("San Bernardo");
$perros -> set();
?>