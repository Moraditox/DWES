<?php
    foreach ($proyectos as $carpetas => $subcarpetas) {
        echo "<h6 id='carpetas'>$carpetas</h6>";
        if(is_array( $subcarpetas )) {
            foreach($subcarpetas as $carpetas2 => $subcarpetas2){
                if(is_array( $subcarpetas2 )) {
                    echo "<h6 id='subcarpetas'>$carpetas2</h6>";
                    foreach ($subcarpetas2 as $archivo => $ruta) {
                        echo "<li><a href='$ruta'>$archivo</a></li>"; // Usa elementos de lista para mejor estructura
                    }
                }else{
                    echo "<li><a href='$subcarpetas2'>$carpetas2</a></li>";
                }
            }           
        }
    } 
?>