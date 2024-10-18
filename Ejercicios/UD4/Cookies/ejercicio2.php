<?php
    /**
     * 
     * Borrar cookie
     * 
     * Fecha --> 17/10/2024
     * @author Héctor Mora Sánchez
    */

    if(isset($_COOKIE['cookie1'])){
        //BORRAR COOKIE
        setcookie("cookie1","hola mundo", time() - 60,);
        echo "COOKIE BORRADA";
    }
?>