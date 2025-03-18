<?php
/**
 *
 * Vista de la página principal
 *  
 * @autor Héctor Mora Sánchez
 * @date 2025-05-10
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js" defer></script>
    <title>Buscador De Portfolios</title>
</head>
<body>
    <!-- Cabecera -->
    <?php include "includes/cabecera_view.php";
    ?>

    <div>
        <?php
            if (isset($_SESSION["mensaje"])) {
                $mensaje = $_SESSION["mensaje"];
                if($mensaje["tipo"] == "") {
                    $mensaje["tipo"] = "";
                    $claseMensaje = $mensaje["tipo"];
                }else{
                    $claseMensaje = $mensaje["tipo"] == "exito" ? "mensaje-exito" : "mensaje-error";
                }
                echo "<div id='mensaje' class='$claseMensaje'>{$mensaje['texto']}</div>";
                unset($_SESSION["mensaje"]); //Limpiar el mensaje después de mostrarlo
            }

            if($_SESSION["usuario"]["auth"]) {
                include "includes/nav-menu.php";
            }else {
                include "includes/nav-login-registro_view.php";
                include "includes/login_view.php";
                include "includes/registro_view.php";
            }
        ?>
    </div>
    <main>
        <?php
            include "includes/menu-portfolio_view.php";
        ?>
    </main>
    <footer></footer>
</body>
</html>