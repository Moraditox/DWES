<?php
/**
 * ejercicio formulario dinamico
 * @AUTHOR JAVIER RUIZ MOELRO
 */

$datos = array(
    "nombre" => $_POST["nombre"],
    "apellidos" => $_POST["apellidos"],
    "email" => $_POST["email"]
);

if(isset($_POST["enviar"])){
    $email = $_POST["email"];

    foreach($datos as $dato => $valor){
        // Si estamos en el campo "email", validamos
        if($dato === "email"){
            if(!filter_var($valor, FILTER_VALIDATE_EMAIL)){
                echo "El email no es valido</br>";
            } else{
                echo "$dato: $valor</br>";
            }
        } else {
            echo "$dato: $valor</br>";
        }
    }
}

