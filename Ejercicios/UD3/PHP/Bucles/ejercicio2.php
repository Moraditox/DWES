<?php
// Inicializar la variable para la suma
$suma = 0;

// Inicializar un contador para contar los números pares
$contador = 0;

// Usar un bucle para encontrar y sumar los tres primeros números pares
for ($i = 1; $contador < 3; $i++) {
    if ($i % 2 == 0) { // Verifica si el número es par
        $suma += $i; // Sumar el número par a la suma
        $contador++; // Incrementar el contador de números pares
    }
}

// Mostrar el resultado
echo "La suma de los 3 primeros números pares es: " . $suma;
?>