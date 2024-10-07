<?php
    /**
    * 
    * Dias de la semana en un array
    * @author Hector Mora Sánchez
    * 
    */

    //Cargar en un array los dias de la semana
    $diasSemana = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
    //Calculamos el tamaño del array
    $numDias = count($diasSemana);

    //Hacemos un bucle para recorrer el array entero
    for($i = 0; $i < $numDias; $i++){
        echo $diasSemana[$i];
        echo "<br/>";
    }
?>