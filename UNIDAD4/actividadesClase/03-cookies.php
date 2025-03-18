<?php
/**
 * Enunciado: Crear cookie de duracion limitada
 * @author javier ruiz molero
*/

// Eliminar cookie
setcookie("nombre","Javier",time()+60); 

if(isset($_COOKIE["nombre"])){
    echo $_COOKIE["nombre"];


}

