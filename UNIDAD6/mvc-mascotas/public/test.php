<?php
require_once "../app/Config/conf.php";
require_once "../app/Models/Mascotas.php";

// Creamos mascotas sin utilizar el patron de diseño. Se crean dos objetos
$mascota1 = new Mascotas();
$mascota2 = new Mascotas();

// Creamos mascotas utilizando el patron de diseño. Se crea solo una instancia para las dos mascotas
$mascota3 = Mascotas::getInstancia();
$mascota4 = Mascotas::getInstancia();

$mascota = Mascotas::getInstancia();
// $mascota->setNombre("Dakota");
// $mascota->setPeso(12);
// $mascota->setRaza("San Bernardo");
// // $mascota->set();
// $resultado = $mascota->get(14);
// foreach($resultado as $key => $value){
//     echo $key . " : " . $value . "<br>";
// }

// Probamos la modificacion de mascotas
$mascota->get(13);

// $mascota->setNombre("FIRULAIS");

// Probamos la eliminacion de mascotas
$mascota->delete();