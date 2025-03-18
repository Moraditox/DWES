<?php
/**
 * Array de 8 dimensiones
 * Crea un script en PHP que recorra y muestre los valores de un array con 8 niveles de profundidad.
*/

include "config.php";

foreach ($arrayMultidimensional as $key1 => $value) {
    echo "<h1>$key1</h1>";
    if(is_array($value)){
        foreach ($value as $key2 => $value2) {
            if(is_array($value2)){
                echo "<h2>$key2</h2>";
                foreach ($value2 as $key3 => $value3) {
                    if(is_array($value3)){
                        echo "<h3>$key3</h3>";
                        foreach ($value3 as $key4 => $value4) {
                            if(is_array($value4)){
                                echo "<h4>$key4</h4>";
                                foreach ($value4 as $key5 => $value5) {
                                    if(is_array($value5)){
                                        echo "<h5>$key5</h5>";
                                        foreach ($value5 as $key6 => $value6) {
                                            if(is_array($value6)){
                                                echo "<h6>$key6</h6>";
                                                foreach ($value6 as $key7 => $value7) {
                                                    if(is_array($value7)){
                                                        echo "<p>$key7</p>";
                                                        foreach ($value7 as $key8 => $value8) {
                                                            if(is_array($value8)){
                                                                echo "<p>$key8</p>";
                                                            } else {
                                                                echo "<p>$value8</p>";
                                                            }    
                                                        }
                                                    } else {
                                                        echo "<p>$value7</p>";
                                                    }
                                                }
                                            } else {
                                                echo "<p>$value6</p>";
                                            }
                                        }
                                    } else {
                                        echo "<p>$value5</p>";
                                    }   
                                }
                            } else {
                                echo "<p>$value4</p>";
                            }
                        }
                    } else {
                        echo "<p>$value3</p>";
                    }  
                }
            } else {
                echo "<p>$value2</p>";
            }
        }
    } else{
        echo "<p>$value</p>";
    }
    
}

