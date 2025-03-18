<?php
/**
 * Formulario para crear un currículum que incluya: Campos de texto, grupo de
 * botones de opción, casilla de verificación, lista de selección única, lista de
 * selección múltiple, botón de validación, botón de imagen, botón de reset, etc.
*/

$lProcesaFormulario = false;
$eNombre = $eApellidos = $eDeportes = $eEdad = $eGenero = $eEstudios = "";


if(isset($_POST["submit"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $nombre = $_POST["nombre"] ?? "";
    $apellidos = $_POST["apellidos"] ?? "";
    $edad = $_POST["edad"] ?? "";
    $genero = $_POST["genero"] ?? "";
    $estudios = $_POST["estudios"] ?? "";
    $deportes = $_POST["deportes"] ?? [];

    if($nombre == ""){
        $eNombre = "El nombre es obligatorio";
        $lProcesaFormulario = false;
    }
    if($apellidos == ""){
        $eApellidos = "Los apellidos es obligatorio";
        $lProcesaFormulario = false;
    }
    if($edad == ""){
        $eEdad = "El edad es obligatorio";
        $lProcesaFormulario = false;
    }
    if(empty($genero)){
        $eGenero = "El genero es obligatorio";
        $lProcesaFormulario = false;
    }
    if(empty($deportes)){
        $eDeportes = "El deportes es obligatorio";
        $lProcesaFormulario = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Curriculum</h1>
    <?php
    if($lProcesaFormulario){ ?>
        <h2><?php echo $nombre ?></h2>
        <h2><?php echo $apellidos ?></h2>
        <h2><?php echo $edad ?></h2>
        <h2><?php echo $genero ?></h2>
        <h2><?php echo $estudios ?></h2>
        <h2>DEportes</h2>
        <?php
            foreach ($deportes as $deporte) {
                echo "<h3>$deporte</h3>";
            }
        ?>
    <?php } else {?>
        <form action="" method="post">
            <label for="nombre">Nombre</label><br/>
            <input type="text" name="nombre" id=""><br/><?php echo $eNombre ?><br/>

            <label for="apellidos">Apellidos</label><br/>
            <input type="text" name="apellidos" id=""><br/><?php echo $eApellidos ?><br/>

            <label for="edad">Edad</label><br/>
            <input type="text" name="edad" id=""><br/><?php echo $eEdad ?><br/>

            <label for="genero">Genero</label><br/>
            <input type="radio" name="genero" value="Hombre">Hombre
            <input type="radio" name="genero" value="Mujer">Mujer <br/><?php echo $eGenero ?><br/>

            <label for="estudios">Estudios</label><br/>
            <select name="estudios">
                <option value="ESO"> Eso</option>
                <option value="Grado medio"> Grado medio</option>
                <option value="Grado superior">Grado superior</option>
                <option value="Bachillerato">Bachillerato</option>
            </select>
            <br/>

            <label for="deportes">Deportes</label><br/>
            <input type="checkbox" name="deportes[]" value="Futbol">Futbol
            <input type="checkbox" name="deportes[]" value="Baloncesto">Baloncesto
            <input type="checkbox" name="deportes[]" value="Natacion">Natacion
            <input type="checkbox" name="deportes[]" value="Ciclismo">Ciclismo<br/>
            <?php echo $eDeportes ?><br/>
            <br/>
            <input type="submit" value="Submit" name="submit">
        </form>



    <?php } ?>
</body>
</html>