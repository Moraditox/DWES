<?php
    /**
     * 
     * Enunciado
     * 
     * Fecha --> 17/10/2024
     * @author Héctor Mora Sánchez
    */
    
    //VERIFICAMOS SI LA COOKIE YA ESTA CREADA
    if(!isset($_COOKIE['contador'])){
        //CREAMOS LA COOKIE
        setcookie("contador", 0, time() + 3600);
    }else{
        $valor = $_COOKIE['contador'] + 1; //GUARDAMOS EN UNA VARIABLE EL VALOR DEL CONTADOR INCREMENTANDOLO
        setcookie("contador", $valor, time() + 3600);  //VOLVEMOS A CREAR LA COOKIE PARA QUE LA MACHAQUE Y LE PONEMOS LA VARIABLE EN LA CUAL ESTAMOS GUARDANDO EL VALOR
    }

    //MOSTRAMOS LA COOKIE
    echo $_COOKIE['contador'];
?>