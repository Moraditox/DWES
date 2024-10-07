<?php
/**
 * 
 * 
 * Crea un script que defina un array de números enteros y 
 * utilizando una función anónima genere un array con el 
 * cuadrado de los mismos.
 * 
 * @author Héctor Mora Sánchez
 */

 echo "Cuadrados de los numeros<br/>";
 $aNumeros = array(5,10,15,20,25,30);

 $cuadradoNumeros = array();
 $cuadradoNumeros = array_map(function($numero){
    return $numero * $numero;
 }, $aNumeros);

 print_r($cuadradoNumeros);
 ?>