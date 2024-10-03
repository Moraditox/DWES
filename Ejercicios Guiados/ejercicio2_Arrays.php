<?php
    /**
    * 
    * Enunciado: Almacenar numero de dias del mes con Array Asociativo
    * Que febrero sea un array indexado con 28 o 29 dias siendo un array bidimensional
    * @author Hector Mora Sánchez
    * 
    */

    //Declaramos el array asociativo
    $meses = array(
        "Enero" => 31,
        "Febrero" => $Febrero = array(
            "normal" => 28,
            "bisiesto" => 29
        ),
        "Marzo" => 31,
        "Abril" => 30,
        "Mayo" => 31,
        "Junio" => 30,
        "Julio" => 31,
        "Agosto" => 31,
        "Septiembre" => 30,
        "Octubre" => 31,
        "Noviembre" => 30,
        "Diciembre" => 31
    );

    //Recorremos el array que tiene todas las claves y valores para despues imprimirlos por pantalla
    foreach($meses as $mes => $dias){
        //Comprobamos si el valor que tenemos en este momento es otro array
        if(is_array($dias)){
            echo "$mes cuando es: <br/>";
            //Recorremos los valores del array asociativo que viene del array anterior que era indexado
            foreach($Febrero as $clave => $valor){
                echo "- Un año $clave tiene $valor dias <br/>";
            }
        }else{
            echo "$mes tiene: $dias dias <br>";
        }
    }
?>