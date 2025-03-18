<?php
/**
 * Probar clase contador
 */

require_once "Contador.php";

$nInstancias = Contador::nInstancias();

echo $nInstancias;

$c1 = new Contador();
$c2 = new Contador(100);
$c3 = new Contador();

echo $c1, $c2;

echo $c1->contar();
echo $c2->contar();
echo $c1->contar();

$nInstancias = Contador::nInstancias();
echo $nInstancias;

