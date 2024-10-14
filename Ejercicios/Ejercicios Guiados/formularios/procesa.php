<?php
/**
 * 
 * Procesador del formulario
 * Fecha -> 08/10/2024
 * @author Héctor Mora Sánchez
 */

 $Datos = array(
   "Nombre" => $_POST["nombre"],
   "Apellidos" => $_POST["apellidos"],
   "Email" => $_POST["email"]
 );

 //CONTROL DE ACCESO AL FORMULARIO
 if (!isset($_POST["enviar"])){
   header("location:ejemplo4.php");
 }

 echo "Datos de formularios: <br/>";

 foreach($Datos as $clave => $valor) {
    if ($clave == "email" && !filter_var($valor, FILTER_VALIDATE_EMAIL)) {
      header("location:ejemplo4.php");
    }else{
      echo "$clave:  $valor <br/>";
    }
 }
?>