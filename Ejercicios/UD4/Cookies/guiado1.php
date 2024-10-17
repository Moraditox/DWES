<?php
    /**
     * 
     * Crear cookie
     * 
     * Fecha --> 17/10/2024
     * @author Héctor Mora Sánchez
    */
    //CREAR COOKIE
    setcookie("cookie1","hola mundo", time() + 60,);

    echo "Inicio<br/>";

    //MOSTRAR COOKIE
    if(isset($_COOKIE["cookie1"])){
        echo $_COOKIE['cookie1'];
    }

    echo "<br/>Fin"
?>