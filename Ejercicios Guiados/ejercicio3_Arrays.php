<?php
/**
 * 
 * 
 * Ejemplo de uso de las funciones anónimas
 * @author Héctor Mora Sánchez
 */

 $aPaises = array(
    array('id' => 'es', 'pais' => 'España', 'capital' => 'Madrid'),
    array('id' => 'it', 'pais' => 'Italia', 'capital' => 'Roma'),
    array('id' => 'fr', 'pais' => 'Francia', 'capital' => 'Paris')
 );

 //Obtener un array con los paises.

 //Opción 1. Manera tradicional.
 echo "Opcuon 1<br/>";
 $nombrePaises = array();
foreach ($aPaises as $pais) {
    $nombrePaises[] = $pais['pais'];
}

print_r($nombrePaises);

//Opción 2. Con funciones anónimas.
echo "<br/>Opcion 2<br/>";
/*
array_map devuelve un array
despues de pasar cada uno de los elementos del array
(segundo parametro)
por la funcion (primer parametro)
*/
$nombrePaises = array_map(function ($pais){
    return $pais['pais'];
}, $aPaises);

print_r($nombrePaises);
?>