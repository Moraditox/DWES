<?php
/**
 * Enunciado:
 * 3. Crear un array con los alumnos de clase y permitir la selección aleatoria de uno de
 * ellos. El resultado debe mostrar nombre y fotografía.
 * @author Javier Ruiz Molero 
 **/

$nombresAlumnos = array("Bermúdez González, Raúl", "Cañas González, Álvaro", "Carmona Cicchetti, Miguel", 
"Carrasco Castellano, Alejandro", "Cherif Mouaki Almabouada, Mostafa",
"Coronado Ortega, Alejandro", "Delgado Morente, Juan Diego", "Escoto García, Marlon Jafet", 
"Fernández Ariza, Ángel", "Fernández Arrayás, Alejandro", "Fernández Balsera, Daniel", 
"Ferrer López, Jesús", "Frías Rojas, Jesús", "Galán Navas, Manuel", "García Báez, Víctor", 
"García Díaz, Lucía", "González Martínez, Adrián", "Mariño Jiménez, Enrique", 
"Martín-Castaño Carrillo, Oscar", "Mayén Pérez, José María", "Mérida Velasco, Pablo", 
"Mora Sánchez, Héctor", "Pérez Cantarero, Luis", "Romero Romero, Carlos", "Ruiz Molero, Javier", 
"Vaquero Abad, Alejandro", "Villén Moyano, Luís Miguel");

// Selección aleatoria de un alumno
$indiceAleatorio = array_rand($nombresAlumnos);
$nombreSeleccionado = $nombresAlumnos[$indiceAleatorio];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Alumno seleccionado aleatoriamente</h1>
    <p class="nombre"><?= $nombreSeleccionado ?></p>
</body>
</html>