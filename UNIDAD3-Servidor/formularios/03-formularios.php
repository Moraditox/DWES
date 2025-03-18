<?php
/**
 * Enunciado: Crear una aplicación que almacene información de países: nombre capital y
 * bandera. Diseñar un formulario que permita seleccionar un país y nos muestre el
 * nombre de la capital y la bandera.
 * @author javier 
*/
$paises = array(
    "España" => array(
        "capital" => "Madrid",
        "bandera" => "https://th.bing.com/th/id/R.abe87bd955c6d1db52d54ae98e300372?rik=iUAQTM40lBJdAQ&pid=ImgRaw&r=0"
    ),
    "Francia" => array(
        "capital" => "Paris",
        "bandera" => "https://th.bing.com/th/id/OIP.N3mMMvUhar0cvYTUsSbdTQHaEO?rs=1&pid=ImgDetMain"
    ),
    "Italia" => array(
        "capital" => "Roma",
        "bandera" => "https://th.bing.com/th/id/R.3ba9493427df34414e852098c0b0b152?rik=GdjkYRi2lpEDjw&riu=http%3a%2f%2fwallpapercave.com%2fwp%2fwp1841324.jpg&ehk=461xLmfJ4w4nzSodg8JL1XT92fLDazEnQndDbtRMnTU%3d&risl=&pid=ImgRaw&r=0"
    ),
    "Japon" => array(
        "capital" => "Tokio",
        "bandera" => "https://th.bing.com/th/id/OIP.cbvoUYlED76g3OtMPpJkdAHaEm?rs=1&pid=ImgDetMain"
    )
);

$lProcesaFormulario = false;

if(isset($_POST["enviar"])){
    $lProcesaFormulario = true;
}

if($lProcesaFormulario){
    $paisSeleccionado = $_POST["paises"];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
        }
        h1{
            font-size: 4vw;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
            margin-bottom: 4vw;
        }
        h3{
            font-size: 3vw;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
            color: #cece5e;
            margin-bottom: 2vw;
        }
        form {
            text-align: center;
        }
        select{
            width: fit-content;
            padding: 2vw;
            font-size: 3vw;
        }
        form div{
            margin-top: 3vw;
        }
        div input{
            padding: 2vw 3vw;
            font-size: 4vw;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin-bottom: 5vw;
        }
        #info{
            padding: 3vw;
            background-color: black;
            text-align: center;
        }
        h2{
            font-size: 3vw;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
            color: white;
            margin-bottom: 2vw;
        }
        h4{
            font-size: 2vw;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
            color:#d3d3d3;
            margin-bottom: 4vw;
        }
        img{
            width: 50vw;
        }
    </style>
</head>
<body>
    <h1>INFORMACIÓN SOBRE PAISES</h1>
    <form action="" method="post">
        <h3>Selecciona un pais:</h3>
        <select name="paises" id="paises">
            <?php
            foreach($paises as $pais => $info){
                // Mantener el país seleccionado
                $selected = ($pais === $paisSeleccionado) ? 'selected' : '';
                echo "<option value='$pais' $selected>$pais</option>";
            }
            ?>
        </select>
        <div>
            <input type="submit" name="enviar" value="Mostrar Pais">
        </div>      
    </form>
    <?php
    if($lProcesaFormulario){
        $capital = $paises[$paisSeleccionado]['capital'];
        $bandera = $paises[$paisSeleccionado]['bandera'];

        echo "
        <div id='info'>
            <h2>$paisSeleccionado</h2>
            <h4>Capital: $capital</h4>
            <img src='$bandera'>
        </div>
        ";
    }
    ?>
</body>
</html>