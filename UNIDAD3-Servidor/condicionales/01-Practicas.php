<?php
// Almacena tres números en variables y escribirlos en pantalla de manera ordenada.


// Almacenamos numeros en variables
$a = 10;
$b = 20;
$c = 6;

if ($a <= $b && $a <= $c) {
    // Si $a es el menor
    if ($b <= $c) {
        // Si $b es menor o igual a $c
        echo "$a - $b - $c";
    } else {
        // Si $c es menor que $b
        echo "$a - $c - $b";
    }
} elseif ($b <= $a && $b <= $c) {
    // Si $b es el menor
    if ($a <= $c) {
        // Si $a es menor o igual a $c
        echo "$b - $a - $c";
    } else {
        // Si $c es menor que $a
        echo "$b - $c - $a";
    }
} else {
    // Si $c es el menor
    if ($a <= $b) {
        // Si $a es menor o igual a $b
        echo "$c - $a - $b";
    } else {
        // Si $b es menor que $a
        echo "$c - $b - $a";
    }
}