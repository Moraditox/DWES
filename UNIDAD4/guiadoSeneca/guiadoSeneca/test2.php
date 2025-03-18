<?php
/**
 * Test 1 para comprobar el manejo de fichero de texto
 * @author Name <email@email.com>
 */
include "./conf/config.php";
// declaracion de variables
$aUsuarios=array();
$desglose=[];//array
$alumno="";
$nombreUsuario="";
$contadorRepetidos=1;
// abrir fichero
$file = fopen("./RegMisAlu.csv","r");
//Despreciamos linea cabecera
for ($i=0; $i < LINE_CABECERA; $i++) {
    fgets($file);
}
// recorremos el fichero mostrando los alumnos hasta feof
while (!feof($file)) {
    $nombreUsuario="";
    // cargamos la linea del fichero
    $alumno=fgets($file);
    // remplazamos los caracteres especiales
    $alumno_st=str_replace($caracteresBusqueda,$caracteresRemplaza,$alumno);
    // lo pasamos a minuscula todo
    $alumno_min=strtolower($alumno_st);
    $desglose=explode(" ", $alumno_min);
    $nombreUsuario = substr($desglose[0],0,2).substr($desglose[1],0,2).substr($desglose[2] ?? "",0,2);
    if (!in_array($nombreUsuario, $aUsuarios)) {
        $aUsuarios[] = $nombreUsuario;
    } else {
        $contador = 1;
        do {
            $nuevoNombreUsuario = $nombreUsuario . $contador;
            $contador++;
        } while (in_array($nuevoNombreUsuario, $aUsuarios));
        array_push($aUsuarios,$nuevoNombreUsuario);
    }

    //Ejemplo con foreach

    // foreach ($desglose as $value) {
    //     $nombreUsuario = $nombreUsuario. substr($value,0,2);
    // }
}

foreach ($aUsuarios as $value) {
    echo $value."<br/>";
}
fclose($file);


?>