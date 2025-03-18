$(function () {
    let victoriasJugador = 0;
    let victoriasMaquina = 0;
    let idPersonajeJugador = null;
    let idPersonajeMaquina = null;
    let personajesData = []; // Almacena todos los personajes

    //Cargamos lo primero la tabla
    cargarHistorial();

    // Cargar personajes de BBDD
    $.ajax({
        url: "php/get_personajes.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            personajesData = data;

            // Me quedo solo con los planetas
            let planetas = [];
            personajesData.forEach(personaje => {
                if (planetas.indexOf(personaje.planeta) == -1) { // No lo encuentra en el array
                    planetas.push(personaje.planeta);
                }
            });

            // let planetas = new Set(); // No permite duplicados
            // personajesData.forEach(personaje =>{
            //     planetas.add(personaje.planeta);
            // })

            // Añado planetas a select
            let selectPlaneta = $("#planeta");
            planetas.forEach(planeta => {
                selectPlaneta.append(`<option value="${planeta}">${planeta}</option>`);
            });
        }
    });
    $("#planeta").change(function() {
        let planetaSeleccionado = $(this).val();
        let selectPersonaje = $("#personaje");
        //Limpiar lo que ya tenia
        selectPersonaje.empty();

        //Primero la opción de selecciona uno
        selectPersonaje.append("<option value='' disabled selected>Elige un personaje...</option>");

        let personajesFiltrados;
        //Vamos a cargar los personajes dependiendo del planeta
        if(planetaSeleccionado == "todos") {
            personajesFiltrados = personajesData.slice(); //Hacemos una copia
        }else {
            personajesFiltrados = [];
            personajesData.forEach(function(personaje) {
                if(personaje.planeta == planetaSeleccionado) {
                    personajesFiltrados.push(personaje);
                }
            });
        }

        personajesFiltrados.forEach(personaje => {
            selectPersonaje.append(`<option value="${personaje.id}">${personaje.nombre}</option>`);
        });

        //Hablitamos el select
        selectPersonaje.prop("disabled", false);
    });

    $("#personaje").change(function() {
        $("#confirmarPersonaje").prop("disabled", false);
    });

    //Vamos a añadir evento al botón confirmar perosnaje
    $("#confirmarPersonaje").on("click", function() {
        let idPersonaje = $("#personaje").val();
        let personajeTexto = $("#personaje option:selected").text();

        //Filtrar personajes disponibles, todos menos el mío
        let personajesDisponlibles = personajesData.filter(p => p.id != idPersonaje);
        
        //Seleccionamo un personaje aleatorio
        let personajeAleatorio = personajesDisponlibles[Math.floor(Math.random() * personajesDisponlibles.length)];
        //Los datos del personaje de la maquina
        idPersonajeMaquina = personajeAleatorio.id;
        let personajeMaquinaTexto = personajeAleatorio.nombre;
        let imagenMaquina = "img/" + personajeAleatorio.imagen;

        //Los datos de mi personaje
        let personajeJugador = personajesData.find(p => p.id == idPersonaje);
        let imagenJugador = "img/" + personajeJugador.imagen;

        //Mostar los nombre e imagenes
        $("#jugador1").text(personajeTexto);
        $("#jugador2").text(personajeMaquinaTexto);
        $("#imgJugador1").attr("src",imagenJugador);
        $("#imgJugador2").attr("src",imagenMaquina);

        //Ocultamos y mostramos contenedores
        $("#seleccionPersonaje").hide();
        $("#arena").show();
        $("#seccionJuego").show();
    });

    //Vamos a añadir eventos a los botones del juego
    $(".eleccion").on("click", function() {
        let eleccionJuagador = $(this).data("eleccion");
        let opciones = ["piedra", "papel", "tijera"];
        let eleccionMaquina = opciones[Math.floor(Math.random() * opciones.length)];
        //Mostramos las jugadas
        $("#eleccionJugador").text(eleccionJuagador);
        $("#eleccionMaquina").text(eleccionMaquina);

        let resultado = "";
        let ganador = null;
        if(eleccionJuagador == eleccionMaquina) {
            resultado = "Empate!";
        }else if(eleccionJuagador == "piedra" && eleccionMaquina == "tijera" ||
            eleccionJuagador == "papel" && eleccionMaquina == "piedra" ||
            eleccionJuagador == "tijera" && eleccionMaquina == "papel") {
            resultado = "Has ganado la ronda!";
            victoriasJugador++;
            ganador = $("#jugador1").text(); //Nombre del jugador
        }else{
            resultado = "La maquina ha ganado la ronda!";
            victoriasMaquina++;
            ganador = $("#jugador2").text(); //Nombre del jugador
        }
        $("#resultado").text(resultado);
        $("#marcador").text(victoriasJugador + " - " + victoriasMaquina);

        //Controlamos el fin del juego, di alguine tiene 2 victorias
        if(victoriasJugador == 2 || victoriasMaquina == 2){
            let resultadoFinal;
            let perdedor;
            if(victoriasJugador == 2){
                resultadoFinal = $("#jugador1").text();
                perdedor = "#imgJugador2";
            }else{
                resultadoFinal = $("#jugador2").text();
                perdedor = "#imgJugador1";
            }
            guardarCombate(idPersonajeJugador, idPersonajeMaquina, resultadoFinal);

            //No dejar pedir mas jugadas
            $(".eleccion").prop("disabled", true);

            //Efecto de desvanecimiento
            $(perdedor).fadeOut(2000);

            setTimeout(() => {
                Swal.fire({
                    title: victoriasJugador === 2 ? "Ganastes el Torneo Saiyan" : "La maqina ganó...",
                    text: victoriasJugador === 2 ? "Eres el campeon del torneo!" : "La maquina gano el torneo",
                    icon: victoriasJugador === 2 ? "success": "error",
                    confirmButtonText: "Aceptar",
                    allowOutsideClick: false
                }).then(() => {
                    location.reload();
                })
            })
        }
    });
    function guardarCombate(personaje1, personaje2, resultado){
        let nombreJugador = $("#jugador1").text();
        let nombreMaquina = $("#jugador2").text();
        $.ajax({
            url: "php/guardar_combate.php",
            method: "POST",
            data: {personaje1: nombreJugador, personaje2: nombreMaquina, resultado: resultado},
            dataType: "json",
            success: function (response) {
                if(!response.success){
                    console.log("Error al guardar el combate");
                }
                cargarHistorial(); //Recargo la tabla otra vez               
            }
        });
    }

    function cargarHistorial(){
        axios.get("php/get_historial.php")
        .then(response => {
            let tablaHistorial = $("#tablaHistorial");
            tablaHistorial.empty(); //Limpio la tabla

            response.data.forEach((combate, index) => {
                tablaHistorial.append(`
                    <tr>
                        <td>
                        <td class="col-jugador1">${combate.personaje1}</td>
                        <td class="col-jugador2">${combate.personaje2}</td>
                        <td>${combate.resultado}</td>
                        <td class="col-fecha">${combate.fecha}</td>
                        <td>
                            <button class="btn btn-warning btn-sm revancha">🔄 Revancha</button>
                        </td>
                    </tr>
                `);
            });
            //Revancha


        })
        .catch(error => {
            console.error("Erro al cargar el historial de combates", error);
        });
    }
});
