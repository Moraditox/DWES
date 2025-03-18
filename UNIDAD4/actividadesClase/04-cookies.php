<?php
/**
 * Enunciado: Contador 
 * @author javier ruiz molero
*/

if(!isset($_COOKIE["contador"])){
    setcookie("contador", 0, time()+3600);
} else {
    setcookie("contador", $_COOKIE["contador"] + 1, time()+3600);

    echo $_COOKIE["contador"];
}
