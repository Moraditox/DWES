<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 01</title>
</head>
<body>
    <div class="col1">
        <h1><?php echo "Hector Mora";?></h1>
        <h2><?php echo "DWES";?></h2>
        <ul>
            <li>Mail: <?php echo "hectorgamerfmn@gmail.com";?></li>
            <li>Phone: <?php echo "602242747";?></li>
            <li>LinkedIn: <?php echo "mi linkedin";?></li>
            <li>Twitter: <?php echo "mi twitter";?></li>
        </ul>
    </div>

    <?php
        $nombreCompleto = "Hector Mora";
        $mail = "hectorgamerfmn@gmail.com";
        $phone = "602242747";
        $linkedin = "Mi linkedin";
        $twitter = "mi twitter";
    ?>

    <div class="col2">
        <h1><?php echo $nombreCompleto;?></h1>
        <h2><?php echo "DWES";?></h2>
        <ul>
            <li>Mail: <?php echo $mail;?></li>
            <li>Phone: <?php echo $phone;?></li>
            <li>LinkedIn: <?php echo $linkedin;?></li>
            <li>Twitter: <?php echo $twitter;?></li>
        </ul>
    </div>
</body>
</html>