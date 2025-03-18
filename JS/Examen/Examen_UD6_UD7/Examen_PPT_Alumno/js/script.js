let personajes = [];
let personajeAleatorio;

$(function(){
    $.get("php/get_personajes.php", function(response){
        let personajes = JSON.parse(response);

        $.each(personajes, function(i, registro){
            seleccionarPlaneta(registro);
            $('#planeta').change(function(){
                const personajes = [];
                seleccionarPersonaje(registro);
            });
        });

        $('#personaje').change(function(){
            $("#confirmarPersonaje").prop('disabled', false);
            personajeAleatorio = obtenerPersonajeAleatorio(personajes);
            console.log(personajeAleatorio);
        });

        $("#confirmarPersonaje").on('click', function(){
            mostrarCombate(personajes, personajeAleatorio);
        });

        $(document).on('click','.eleccion', function(){
            seleccionJuego();
        });
    }).fail(function(){
        console.log('Error al cargar los personajes');
    });

    //FUncion que muestra todos los planetas que ahi
    function seleccionarPlaneta(registro){
        $('#planeta').append('<option value="' + registro.planeta + '">' + registro.planeta + '</option>');
    }

    //Funcion que muestra los personajes del planeta seleccionado
    function seleccionarPersonaje(registro){
        const planeta = $('#planeta').val();
        $("#personaje").prop('disabled', false);

        if(planeta == registro.planeta){
            personajes.push(registro.nombre);
        }

        if(planeta == registro.planeta){
            $('#personaje').append('<option value="' + registro.nombre + '">' + registro.nombre + '</option>');
        }else if(planeta == 'todos'){
            $('#personaje').append('<option value="' + registro.nombre + '">' + registro.nombre + '</option>');
        }
    };

    //Funcion que obtiene un personaje aleatorio
    function obtenerPersonajeAleatorio(personajes){
        let personajeAleatorio1 = Math.floor(Math.random() * 12);
        personajes.forEach(function(element, id) {
            console.log(personajeAleatorio1);
            console.log(element);
            if(personajeAleatorio1 == id){
                element.nombre;
            }
        });
    }

    //Funcion que muestra la parte del combate con el nombre y la imagen de cada personaje
    function mostrarCombate(personajes, personajeAleatorio){
        $('#seleccionPersonaje').hide();
        $("#arena").show();
        $("#seccionJuego").show();
        let nombrePersonaje1 = $('#personaje').val();
        // let nombrePersonaje2 = personajeAleatorio.nombre;
        let fotoPersonaje1;
        let fotoPersonaje2;

        console.log(personajes);

        personajes.forEach(element => {
            if(element.nombre == nombrePersonaje1){
                fotoPersonaje1 = element.imagen;
            }
        })

        $('#jugador1').text(nombrePersonaje1);
        $('#imgJugador1').attr({src: "img/" + fotoPersonaje1});
        // $('#jugador2').text(nombrePersonaje2);
        $('#imgJugador2').attr({src: "img/" + fotoPersonaje2});
    }
    
    //Funcion para poder saber que esta seleccionando cada uno y subir el marcador
    function seleccionJuego(){
        let seleccionJugador1 = $(this).attr('data-eleccion');
        console.log(seleccionJugador1);
        let seleccionJugador2Random = Math.floor(Math.random() * 3);
        let aEleccion = ['piedra', 'papel', 'tijera'];
        let seleccionJugador2;
        let puntosJugardor = 0;
        let puntosMaquina = 0;


        aEleccion.forEach((element, id) => {
            if(seleccionJugador2Random == id){
                seleccionJugador2 = element;
            }
        });

        $('#eleccionJugador').text(seleccionJugador1);
        $('#eleccionMaquina').text(seleccionJugador2);

        if (seleccionJugador1 == 'piedra' && seleccionJugador2 == 'papel'){
            puntosMaquina++;
        }else if(seleccionJugador1 == 'papel' && seleccionJugador2 == 'piedra'){
            puntosJugardor++;
        }else if(seleccionJugador1 == 'tijera' && seleccionJugador2 == 'piedra'){
            puntosJugardor++;
        }else if(seleccionJugador1 == 'papel' && seleccionJugador2 == 'tijera'){
            puntosMaquina++;
        }else if(seleccionJugador1 == 'piedra' && seleccionJugador2 == 'tijera'){
            puntosJugardor++;
        }else if(seleccionJugador1 == 'tijera' && seleccionJugador2 == 'piedra'){
            puntosMaquina++;
        }
        $('#marcador').text(puntosJugardor + ' - ' + puntosMaquina);
    }
});