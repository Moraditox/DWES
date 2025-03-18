<?php
/**
 * Enunciado:
 *  
 * 1. Definir un array que permita almacenar y mostrar la siguiente información.
 *      a. Meses del año.
 *      b. Tablero para jugar al juego de los barcos.
 *      c. Nota de los alumnos de 2o DAW para el módulo DWES.
 *      d. Verbos irregulares en inglés.
 *      e. Información sobre continentes, países, capitales y banderas.
 * @author Javier Ruiz Molero 
 **/

// Meses del año
$mesesAnio = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
];

// Tablero barcos
$tablero = [
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"],
    ["~", "~", "~", "~", "~", "~", "~", "~", "~", "~"]
];

// Notas alumnos
$notasAlumnos = [
    "Javier" => 6,
    "Manuel" => 8,
    "Alejandro" => 2,
    "Lucia" => 5,
    "Pedro" => 8,
    "Pepe" => 6,
    "Carmen" => 5,
    "Estefania" => 1,
    "Luis" => 9,
    "Hector" => 6
];

// Verbos irregulares
$verbosIrregulares = [
    "be",
    "become",
    "begin",
    "bite",
    "blow",
    "buy"
];

// Arrays anidados / geografía
$geografia = [
    "Africa" => [
        "Marruecos" => [
            "Capital" => "Rabat",
            "Habitantes" => "37,46 millones"
        ],
        "Gambia" => [
            "Capital" => "Banjul",
            "Habitantes" => "2,71 millones"
        ]
    ],
    "Europa" => [
        "España" => [
            "Capital" => "Madrid",
            "Habitantes" => "47,62 millones"
        ],
        "Francia" => [
            "Capital" => "París",
            "Habitantes" => "67,94 millones"
        ]
    ],
    "Asia" => [
        "China" => [
            "Capital" => "Pekín",
            "Habitantes" => "1,41 mil millones"
        ],
        "Japón" => [
            "Capital" => "Tokio",
            "Habitantes" => "125,12 millones"
        ]
    ]
];
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
            font-size: 3rem;
            font-family: system-ui;
            text-transform: uppercase;
        }
        h2{
            color: white;
            font-size: 3rem;
            font-family: system-ui;
            text-transform: uppercase;
        }
        h3{
            text-align: center;
            font-size: 2rem;
            font-family: system-ui;
            text-transform: uppercase;
        }
        h4{
            font-size: 1.5rem;
            font-family: system-ui;
            color: white;
            margin-top: 3vw;
        }
        p{
            font-size: 1.2rem;
            font-family: system-ui;
            color: #d4d4d4;
        }
        #inicio{
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: .8vw;
            row-gap: 1.8rem;
        }
        #meses,#tablero,#verbos, #notas{
            margin: 2vw;
            box-shadow: 0px 0px 10px;
        }
        #tablero{
            text-align: -webkit-center;
        }
        li{
            list-style: none;
            font-size: 1rem;
            font-family: system-ui;
            margin-left: 11vw;
            padding: 0.5rem;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 10px 0;
        }
        td {
            width: 30px;
            height: 35px;
            text-align: center;
            border: 1px solid black;
        }
        #verbos li{
            margin-left: 8vw;
        }
        section{
            margin-top: 5vw;
            background-color: black;
            padding: 5vw;
        }
        section h3{
            color: #ff0000;
            text-align-last: start;
        }
        section ul{
            display:flex;
        }
        .pais{
            margin-bottom: 7vw;
        }
    </style>
</head>
<body>
    <h1>Arrays</h1>
    <div id="inicio">
        <div id="meses">
            <h3>Meses del año</h3>
            <ul>
                <?php
                foreach($mesesAnio as $mes){
                    echo "<li>$mes</li>";
                }
                ?>
            </ul>
        </div>
        <div id="tablero">
            <h3>Tablero</h3>
            <table>
                <?php
                // Imprimir el tablero
                foreach ($tablero as $fila) {
                    echo "<tr>";
                    foreach ($fila as $casilla) {
                        echo "<td>$casilla</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div id="notas">
            <h3>Notas alumnos</h3>
            <ul>
                <?php
                foreach ($notasAlumnos as $alumno => $nota) {
                    echo "<li>$alumno: $nota</li>";
                }
                ?>
                </ul>
        </div>
        <div id="verbos">
            <h3>Verbos irregulares</h3>
            <ul>
                <?php
                foreach ($verbosIrregulares as $verbo) {
                    echo "<li>$verbo</li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <section>
        <h2>Continentes</h2>
        <div>
            <?php
            foreach ($geografia as $continente => $paises) {
                echo "<h3>$continente</h3>";
                echo "<div class='pais'>";
                foreach ($paises as $pais => $info) {
                    echo "<h4><strong>$pais</strong></h4>
                          <p>Capital: {$info['Capital']}</p>
                          <p>Bandera: {$info['Habitantes']}</p>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </section>
</body>
</html>
