<?php
/**
 * 
 * Funcion para eliminar un dato
 * 
 * @author Héctor Mora Sánchez
 */
 session_start();
 if(!$_SESSION["usuario"]["auth"]){
    header("location: ./index.php");
 }
include("lib/function.php");

function elminarDato(){
    $db = conectaDB();
    $id = $_GET["id"];
    $sql = "DELETE FROM perros WHERE id LIKE :id";

    $consulta = $db -> prepare($sql);
    if($consulta -> execute(array(":id" => $id))) {
        header("location: ./index.php");
    }else {
        header("location: ./index.php");
    }
}
elminarDato();
?>