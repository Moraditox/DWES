<?php
/**
 * 
 * Procesador del formulario
 * Fecha -> 08/10/2024
 * @author Héctor Mora Sánchez
 */

 //CONTRL DE ACCESO AL FORMULARIO
 if(!isset($_POST["enviar"])){
    header("location:form.php");
 }

 echo "Datos del formulario: <br/>";

 foreach($_POST as $clave => $valor){
    echo $valor;
    echo "<br/>";
 }
?>