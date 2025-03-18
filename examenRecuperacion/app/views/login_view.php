<?php
require_once "logued.php";
if ($isLogged) {
    header("Location: ..");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dirección general de tráfico</title>

</head>

<body>
    <?php
        require_once "header.php";
    ?>
    <h3>Formulario de inicio de sesión</h3>
    <form action="" method="post">
        <label for="usuario">Usuario:</label>
        <input type="usuario" id="usuario" name="usuario" value="<?php echo $data["usuario"] ?>"><?php echo $data["errorUsuario"] ?><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" value="<?php echo $data["password"] ?>"><?php echo $data["errorPassword"] ?><br><br>
        <label for="captcha">Selecciona un: <?php echo $_SESSION['captcha']; ?></label>
        <div>
            <input type="radio" id="captcha1" name="captcha" value="Coche">
            <label for="captcha1">🚗</label>
        </div>
        <div>
            <input type="radio" id="captcha2" name="captcha" value="Semaforo">
            <label for="captcha2">🚦</label>
        </div>
        <div>
            <input type="radio" id="captcha3" name="captcha" value="Peaton">
            <label for="captcha3">🚷</label>
        </div>
        <div class="error"><?php echo $data['errorCaptcha']; ?></div>
        <br />
        <input type="submit" id="enviar" value="Enviar">
    </form>
    <?php
    $videos = [
        "../../video1.mp4",
        "../../video2.mp4",
        "../../video3.mp4"
    ];

    if (!isset($_COOKIE['videoIndex'])) {
        $videoIndex = 0;
    } else {
        $videoIndex = (int)$_COOKIE['videoIndex'];
        $videoIndex = ($videoIndex + 1) % count($videos);
    }

    setcookie('videoIndex', $videoIndex, time() + (86400 * 30), "/"); // 30 days expiration
    ?>

    <video width="320" height="240" controls>
        <source src="videos/<?php echo $videos[$videoIndex]; ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</body>

</html>