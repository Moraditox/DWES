<?php
/**
 * Procesar los datos personales introducidos y mostrarlos por pantalla
 * Fecha --> 07/1072024
 * @author Héctor Mora Sánchez
 */
$datosPersonales =  array(
                        "Nombre" => $_POST["nombre"],
                        "Apellidos" => $_POST["apellidos"],
                        "Email" => $_POST["email"]
                    );

foreach($datosPersonales as $nombre => $valor){
    echo "$nombre: $valor <br/>";
}
?>