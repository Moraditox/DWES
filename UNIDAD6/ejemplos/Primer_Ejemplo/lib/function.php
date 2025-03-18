<?php
/**
 * 
 * FUNCION PARA CONECTARSE A LA BASE DE DATOS
 * 
 * @author Héctor Mora Sánchez
 */

require_once("../app/Config/config.php");

function conectaDB() {
    try {
        $dsn = "mysql:host=localhost;dbname=portfolio";
        $db = new PDO($dsn, "portfolio", "usuario"); //Manejo de errores
        $db -> setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $db -> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        return($db);
    }catch(PDOException $e) {
        echo "Error conexión";
        exit();
    }
}

function clearData($dato) {
    return $dato;
} 
?>