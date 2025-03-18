<?php
define("LINE_CABECERA",1);
define("A_INICIO",2010);
define("A_FINAL",2030);

//definimos el directorio de subida de los archivos
define("DIRUPLOAD", 'upload/');
//definimos el tamaño maximo del archivo
define("MAXSIZE", 200000);
// extension del archivo
$allowedExts = array("csv");
//tipo de archivo
$allowedFormat = array("text/csv");

$caracteresBusqueda = array("Á","á","É","é","Í","í","Ó","ó","Ü","ü","Ú","ú","ñ","Ñ",",","\"");
$caracteresRemplaza = array("A","a","E","e","I","i","O","o","U","u","U","u","n","N","","");

$grupos = array("1 DAW","2 DAW", "1 ASIR", "2 ASIR");
$formato = array("Linux", "MySQL");



?>