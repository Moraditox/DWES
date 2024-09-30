<?php
    //Almacena tres números en variables y escribirlos en pantalla de manera ordenada.
    $a = 1;
    $b = 2;
    $c = 3;

    if($a>$b && $a>$c) {
        echo `a: $a`;
        if($b>$c){
            echo `b: $b`;
            echo `c: $c`;
        }else{
            echo `c: $c`;
            echo `b: $b`;
        }
    }else if($b>$a && $b>$c) {
        echo `b: $b`;
        if($a>$c){
            echo `a: $a`;
            echo `c: $c`;
        }else{
            echo `c: $c`;
            echo `a: $a`;
        }
    }else{
        echo `c: $c`;
        if($a>$b){
            echo `a: $a`;
            echo `b: $b`;
        }else{
            echo `b: $b`;
            echo `a: $a`;
        }
    }