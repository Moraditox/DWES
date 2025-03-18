<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numeros</title>
</head>
<body>
    <?php
        $numero = 1;
        $numeros_contados = 0;

        while($numeros_contados < 10){
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