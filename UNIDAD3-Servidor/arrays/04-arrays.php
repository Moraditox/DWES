<?php
/**
 * Enunciado:
 *  Un restaurante dispone de una carta de 3 primeros, 5 segundos y 3 postres.
 *  Almacenar información incluyendo foto y mostrar los menús disponibles. Mostrar el
 *  precio del menú suponiendo que éste se calcula sumando el precio de cada uno de
 *  los platos incluidos y con un descuento del 20 %.
 * @author Javier Ruiz Molero 
 **/

// Iniciar la sesión
session_start();

// Inicializar el array del menú seleccionado si no existe
if (!isset($_SESSION['menu'])) {
    $_SESSION['menu'] = array();
}

// Añadir plato al menú si se ha enviado un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plato']) && isset($_POST['tipo'])) {
    $plato = $_POST['plato'];
    $tipo = $_POST['tipo'];

    // Evitar duplicados
    if (!isset($_SESSION['menu'][$tipo][$plato])) {
        $_SESSION['menu'][$tipo][$plato] = true;
    }
}

$cartaRestaurante = array(
    "Primeros" => array(
        "Ensalada de alubias" => array(
            "./img/alubias.jpeg",
            7
        ),
        "Ensalada mixta" => array(
            "./img/ensalada.jpeg",
            6
        ),
        "Fajitas de pollo" => array(
            "./img/fajitas.jpeg",
            9
        )
    ),
    "Segundos" => array(
        "Pizza" => array(
            "./img/pizza.jpeg",
            12
        ),
        "San jacobo" => array(
            "./img/jacobo.jpeg",
            9
        ),
        "Flamenquin" => array(
            "./img/flamenquin.jpg",
            10
        ),
        "Croquetas" => array(
            "./img/croquetas.jpeg",
            7
        ),
        "Hamburguesa" => array(
            "./img/hambur.jpeg",
            5
        )
    ),
    "Postres" => array(
        "Tarta de queso" => array(
            "./img/queso.jpg",
            4
        ),
        "Tarta de 5 chocolates" => array(
            "./img/choco.jpeg",
            5
        ),
        "Helado" => array(
            "./img/hela.jpeg",
            3
        )
    )
 );
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            text-align: center;
            font-family: system-ui;
            text-transform: uppercase;
            font-size: 3rem;
        }
        section{
            display: flex;
            margin-top: 2vw;
        }
        .clase {
            width: 100%;
            margin: 0 1%;
            padding: 2% 3%;
            background-color: #fff1e4;
            height: fit-content;
        }
        h2{
            text-align: center;
            font-family: system-ui;
            font-size: 2rem;
            color: #353535;
        }
        h3{
            font-family: system-ui;
            font-size: 1.6rem;
            color: #ff5722;
        }
        .plato{
            margin: 20% 0px;
        }
        img{
            width: 100%;
            height: 20vw;
            object-fit: cover;
        }
        p{
            margin: 0;
            font-size: 1.2rem;
            font-family: monospace;
        }

        #menuseleccionado{
            background-color: #ff7b00;
            width: 100%;
            padding: 3%;
            display: flex;
        }
        #menuseleccionado div{
            width: 50%;
        }
        button{
            margin-top: 1vw;
            padding: 1vw;
            font-size: 1rem;
            text-transform: uppercase;
            background-color: #ff5722;
            color: white;
            border: 0;
        }
    </style>
 </head>
 <body>
    <h1>Carta restaurante</h1>
    <div>
        <h2>Menu seleccionado</h2>
        <div id="menuseleccionado">
            <div>
                <?php
                if (!empty($_SESSION['menu'])) {
                    $precioTotal = 0;
                    foreach($_SESSION['menu'] as $tipo => $platos){
                        foreach($platos as $plato => $seleccionado){
                            $precio = $cartaRestaurante[$tipo][$plato][1];
                            $precioTotal += $precio;
                            echo "<p>($tipo) $plato: $precio €</p>";
                        }

                    }
                }
                ?>
            </div>
            <div>
    
            <?php
            //Calcular precios
            $descuneto = $precioTotal * 0.20;
            $precioFinal = $precioTotal - $descuneto;

            echo "<p>Precio total = $precioTotal €</p>
                  <p>Descuento = $descuneto €</p>
                  <p>Precio Final = $precioFinal €</p>";

            ?>
            </div>
    </div>
    </div>
    <section>
        <?php
        foreach($cartaRestaurante as $clase => $platos){
            echo "<div class='clase'>
                  <h2>$clase</h2>";
            foreach($platos as $plato => $detalles){
                echo "<div class='plato'>
                      <h3>$plato</h3>
                      <div class='detalles'>
                      <img src='{$detalles[0]}'>
                      <p>Precio: {$detalles[1]} €</p>
                      <form method='POST'>
                          <input type='hidden' name='plato' value='$plato'>
                          <input type='hidden' name='tipo' value='$clase'>
                          <button type='submit' class='boton'>Añadir al menú</button>
                      </form>
                      </div>
                      </div>";    
            }
            echo "</div>";          
        }
        ?>
    </section>
 </body>
 </html>