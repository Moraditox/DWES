<?php
/**
 * Test 1 para comprobar el manejo de fichero de texto
 * @author Name <email@email.com>
 */
include "./conf/config.php";

// abrir fichero
$file = fopen("./RegMisAlu.csv","r");
$alumno="";
//Despreciamos linea cabecera
for ($i=0; $i < LINE_CABECERA; $i++) {
    fgets($file);
}
// recorremos el fichero mostrando los alumnos hasta feof
while (!feof($file)) {
    // cargamos la linea del fichero
    $alumno=fgets($file);
    // remplazamos los caracteres especiales
    $alumno_st=str_replace($caracteresBusqueda,$caracteresRemplaza,$alumno);
    // lo pasamos a minuscula todo
    $alumno_min=strtolower($alumno_st);
    //se imprime
    echo $alumno_min."<br/>";
}
fclose($file);


?>