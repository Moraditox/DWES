<?php
$aImagenes = ["/img/imagenTrafico1.jpg", 
              "/img/imagenTrafico2.jpg", 
              "/img/imagenTrafico3.jpg",
              "/img/imagenTrafico4.jpg", 
              "/img/imagenTrafico5.jpg",
              "/img/imagenTrafico6.jpg"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js" defer></script>
    <title>Multas de trafico</title>
</head>
<body>
    <header>
        <h2>Gestion de Multas</h2>
        <?php
            if($_SESSION['user']['perfil'] == 'invitado'){?>
                <form action="/login" method="POST">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario"><br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"><br>
                    <p>Selecciona: <?php echo $_COOKIE['capcha'] ?></p>
                    <input type="radio" name="capcha" value="Peaton">Peaton
                    <input type="radio" name="capcha" value="Coche">Coche
                    <input type="radio" name="capcha" value="Semaforo">Semaforo<br>
                    <input type="submit" name="login" value="Login">
                </form>
                <p><?php echo $_SESSION['mensaje']['texto'] ?></p>
            <?php }else{
                echo "<p>Bienvenido " . $_SESSION['user']['perfil'] . "</p>";
                if($_SESSION['user']['perfil'] == 'conductor'){?>
                    <ul>
                    <li><a href='/cerrarSesion'>Cerrar Sesion</a></li>
                    <li><a href='/multas'>Multas</a></li>
                    </ul>
                <?php }else if($_SESSION['user']['perfil'] == 'agente'){?>
                    <ul>
                        <li><a href='/cerrarSesion'>Cerrar Sesion</a></li>
                        <li><a href='/listaMultas'>Lista Multas</a></li>
                    </ul>
            <?php } 
            } ?>
    </header>
    <main>
        <?php
            $numRandom = rand(0, 2);
            foreach($aImagenes as $key => $imagen){
                if($key == $numRandom){
                    echo "<img src='" . $imagen . "' alt='Imagen de trafico' width='300px' height='300px'>";
                }
            }
        ?>
    </main>
    <footer></footer>
</body>
</html>