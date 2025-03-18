<?php
include "./conf/config.php";
// comprobamos si existe el $_POST send sino volvemos a la pagina de formulario
if (!isset($_POST['send'])) {
    header('Location: test3.php');
}
// si existe guardamos los datos en variables
$grupo = $_POST["grupo"];
$curso = $_POST["curso"];
$formato = $_POST["formato"];

$temp = explode(".", $_FILES["file"]["name"]);//file es el nombre del input
$extension = end($temp);
if (($_FILES["file"]["size"] < MAXSIZE) && (in_array($_FILES["file"]["type"],$allowedFormat))&&(in_array($extension,$allowedExts))) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return code: ".$_FILES["file"]["error"]. "<br/>";
    }else{
        $filename = $_FILES["file"]["name"];
        // codificamos el nombre del fichero en el servidor
        $filename=uniqid().'.'.pathinfo($filename,PATHINFO_EXTENSION);
        if (file_exists(DIRUPLOAD.$filename)) {
            echo $_FILES["file"]["name"]." Ya existe";
        }else{
            move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD. $filename);
            echo "<br/>";
            echo '<a href="javascript:history.back()">Volver</a>';
        }
    }
}