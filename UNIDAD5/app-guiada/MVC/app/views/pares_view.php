<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numero pares</title>
</head>
<body>
    <?php
        $request = $_SERVER['REQUEST_URI'];
        $frase = explode("/", $request);
        $numero_uri = end($frase);

        $numero = 1;
        $numeros_contados = 0;

        while($numeros_contados < $numero_uri){
            // Verificar si el número es par
            if($numero % 2 == 0){
                echo $numero . "<br/>";
                $numeros_contados++;
            }
            // Incrementar el número
            $numero++;
        }
    ?>
</body>
</html>