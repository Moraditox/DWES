// Cargar los contactos al iniciar la página
$(function () {
    // Realiza una petición GET a "index.php" para obtener la lista de contactos
    $.get("index.php", function (response) {
        // Convierte la respuesta de JSON a un objeto JavaScript
        let resultados = JSON.parse(response);
        // Recorre cada contacto en el resultado
        $.each(resultados, function (i, registro) {
            // Agrega cada registro de contacto a la tabla llamando a la función agregarRegistro
            agregarRegistro(registro);
        })
    })
});


/**
 * Función para agregar un registro de contacto a la tabla
 * @param {Object} registro - Objeto que contiene los datos del contacto (id, firstname, lastname, email)
 */

function agregarRegistro(registro) {
    // Selecciona el cuerpo de la tabla donde se mostrarán los contactos
    let cuerpoTablaContactos = $('#tablaContactos > tbody');
    // Crea una nueva fila (<tr>) con los datos del contacto y dos botones (Editar y Eliminar)
    let nuevaFila = '<tr data-id="' + registro.id + '">' + '<td>' + registro.firstname + '</td>' + '<td>' + registro.lastname + '</td>' + '<td>' + registro.email + '</td>' + '<td><button class="btn btn-primary editar">Editar</button> </td>' + '<td><button class="btn btn-danger eliminar">Eliminar</button> </td>' + '</tr>';
    // Añade la nueva fila al final del cuerpo de la tabla de contactos
    cuerpoTablaContactos.append(nuevaFila);
}

/**
 *  @param document Asignamos eventos a los botones de edición en mi documento
 */

$(document).on("click", ".editar", function () {
    // Encuentra la fila más cercana al botón clicado
    let fila = $(this).closest("tr");
    editarRegistro(fila);
});



/**
 * Función para editar un registro de contacto en la tabla.
 * @param {Object} filaActual - La fila del contacto que se desea editar.
 */

function editarRegistro(filaActual) {

    // Guardamos una copia de la fila original (para poder restaurarla si es necesario)
    let filaOriginal = filaActual.clone();

    // Obtenemos la siguiente fila después de la fila actual, en caso de que exista.
    let siguienteFila = filaActual.next();

    // Seleccionamos el cuerpo de la tabla donde se encuentran los contactos.
    let cuerpoTablaContactos = $('#tablaContactos tbody');

    // Creamos una versión editable de la fila actual, llamando a una función que convierte la fila a un formato editable.
    let filaEditable = obtenerFilaEditable(filaActual);

    // Eliminamos la fila original de la tabla (porque vamos a reemplazarla por una versión editable).
    filaActual.remove();

    // Verificamos si la fila siguiente existe (es decir, si hay una fila después de la actual).
    // Si existe, insertamos la fila editable antes de esa.
    // Si no existe una fila siguiente, agregamos la fila editable al final de la tabla.
    if (siguienteFila.children().length) {
        $(filaEditable).insertBefore(siguienteFila);
    } else {
        // Si no hay fila siguiente, simplemente añadimos la fila editable al final del cuerpo de la tabla.
        cuerpoTablaContactos.append(filaEditable);
    }

    // Definimos el evento para el botón de "Confirmar edición" cuando se hace clic en él
    $("#confirmar_edicion").on('click', function () {
        // Obtenemos la fila actual (donde se hizo clic) utilizando el método closest para buscar el <tr> más cercano
        let filaActual = $(this).closest('tr');

        // Recuperamos el ID de la fila actual (almacenado en el atributo 'data-id') para poder realizar la consulta al servidor
        let id = filaActual.attr('data-id');

        // Creamos un objeto de datos que contiene los valores actualizados del formulario de edición
        let datos = {
            // Obtenemos el valor del campo 'nombre' que está en un <input> dentro de la fila
            firstname: filaActual.find('input[name="nombre"]').val(),

            // Obtenemos el valor del campo 'apellido' que está en un <input> dentro de la fila
            lastname: filaActual.find('input[name="apellido"]').val(),

            // Obtenemos el valor del campo 'correo' que está en un <input> dentro de la fila
            email: filaActual.find('input[name="correo"]').val()
        };


        // Ahora enviamos los datos de los inputs al servidor utilizando una petición AJAX

        // Realizamos una PETICIÓN AJAX utilizando jQuery
        $.ajax('index.php?id=' + id, {
            method: 'PUT', // Usamos el método 'PUT' para indicar que estamos actualizando un registro
            data: datos,   // Le pasamos los datos obtenidos del formulario de edición (nombre, apellido, correo)

            // Función que se ejecuta si la petición es exitosa
            success: function () {
                // Si la petición es exitosa, eliminamos la fila editable
                filaActual.remove();

                // Actualizamos los datos de la fila original con los nuevos valores de los inputs
                filaOriginal.children().eq(0).text(datos.firstname);  // Actualizamos la columna 'nombre'
                filaOriginal.children().eq(1).text(datos.lastname);   // Actualizamos la columna 'apellido'
                filaOriginal.children().eq(2).text(datos.email);      // Actualizamos la columna 'correo'

                // Reinsertamos la fila original con los datos actualizados en la posición correcta
                // Si hay una fila siguiente, la insertamos antes de esa fila
                if (siguienteFila.children().length) {
                    $(filaOriginal).insertBefore(siguienteFila);
                } else {
                    // Si no hay una fila siguiente, la agregamos al final del cuerpo de la tabla
                    cuerpoTablaContactos.append(filaOriginal);
                }

                // Si la actualización fue exitosa, mostramos un mensaje de éxito utilizando SweetAlert
                Swal.fire("Actualizado", "El registro ha sido actualizado con éxito", "success");
            },

            // Función que se ejecuta si ocurre un error durante la petición
            error: function (errorThrown) {
                // Si hay un error, mostramos un mensaje de error utilizando SweetAlert
                Swal.fire("Error", "Ha ocurrido un error al intentar actualizar el registro" + errorThrown, "error");
            }
        });
    });

    // Evento para cancelar la edición del contacto
    $('#cancelar_edicion').on("click", function () {
        // Cuando se hace clic en el botón de cancelar edición, eliminamos la fila editable
        $(this).closest("tr").remove();

        // Restauramos la fila original, que contiene los datos previos a la edición
        // Si hay una fila siguiente, insertamos la fila original antes de esa
        if (siguienteFila.children().length) {
            $(filaOriginal).insertBefore(siguienteFila);
        } else {
            // Si no hay fila siguiente, simplemente agregamos la fila original al final del cuerpo de la tabla
            cuerpoTablaContactos.append(filaOriginal);
        }
    });


}


/**
 * Función para editar un registro de contacto en la tabla.
 * @param {Object} filaActual - La fila del contacto que se desea editar.
 */

function obtenerFilaEditable(filaActual) {
    return '<tr data-id="' + filaActual.attr('data-id') + '">' + '<td><input name="nombre" value="' + filaActual.children()[0].textContent + '"/> </td>' + '<td><input name="apellido" value="' + filaActual.children()[1].textContent + '"/> </td>' + '<td><input name="correo" value="' + filaActual.children()[2].textContent + '"/> </td>' + '<td><button id="confirmar_edicion" class="btn btn-success">Confirmar</button> </td>' + '<td><button id="cancelar_edicion" class="btn btn-danger">Cancelar</button> </td>' + '</tr>';
}


// Asignamos eventos a los botones

$(document).on("click", ".eliminar",function(){
    let file = $(this).closest("tr"); // Encuentra la fila más cercana al botón clicado
    eliminarRegistro(file);
});


/**
 * Función para eliminar un registro de contacto en la tabla.
 * @param {Object} filaActual - La fila del contacto que se desea eliminar.
 */

function eliminarRegistro(filaActual){
    // Obtenemos el 'data-id' de la fila actual (identificador único del registro)
    let id = filaActual.attr('data-id');
    
    // Obtenemos el nombre y apellido del contacto de la fila actual
    let nombre = filaActual.children()[0].textContent;
    let apellido = filaActual.children()[1].textContent;

    // Mostramos una alerta de confirmación con SweetAlert antes de eliminar el registro
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Vas a eliminar a '" + nombre + " " + apellido + "'. Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true, 
        confirmButtonColor: "#d33", 
        cancelButtonColor: "#3085d6", 
        confirmButtonText: "Sí, eliminar", 
        cancelButtonText: "Cancelar" 
    }).then((result) =>{ // Cuando el usuario elige una opción
        if(result.isConfirmed){ // Si el usuario confirma la eliminación
            // Realizamos una petición AJAX para eliminar el registro en el servidor
            $.ajax({
                url: 'index.php?id='+id, // Enviamos el id del registro a eliminar en la URL
                type: 'DELETE', // Usamos el método 'DELETE' para eliminar el registro
                success: function(){ // Si la petición es exitosa
                    // Desvanecemos (ocultamos) la fila eliminada con un efecto de fadeOut
                    filaActual.fadeOut(3000, function(){
                        // Después de que la fila se desvanezca, la eliminamos completamente de la tabla
                        $(this).remove();
                    })
                    // Mostramos un mensaje de éxito usando SweetAlert
                    Swal.fire("Eliminado", "El registro ha sido eliminado con éxito" + nombre + " " + apellido, "success");                    
                },
                error: function(errorThrown){ // Si ocurre un error durante la petición
                    // Mostramos un mensaje de error con SweetAlert
                    Swal.fire("Error", "Ha ocurrido un error al intentar eliminar el registro" + errorThrown, "error");                
                }
            })
        }
    });
}


/**
 * Función para añadir un registro de contacto en la tabla.
 * @param {Object} filaActual - La fila del contacto que se desea añadir.
 * 
 */

$("#nuevo_contacto").on("click",function(){
    // Deshabilitamos el botón para evitar que se cree más de un formulario
    $("#nuevo_contacto").prop('disabled', true);
    // Agregamos una fila editable sin valores
    $("#tablaContactos tbody").append('<tr>' +
        '<td><input name="nombre"/></td>' +
        '<td><input name="apellido"/></td>' +
        '<td><input name="correo"/></td>' +
        '<td><button id="confirmar_nuevo" class="btn btn-primary">Confirmar</button></td>' +
        '<td><button id="cancelar_nuevo" class="btn btn-secondary">Cancelar</button></td>' +
        '</tr>'
    );

    // Creamos una nueva fila

    let nuevaFila = $("#tablaContactos tbody").children().last(); //Esta es la fila editable que acabamos de agregar

    $("#confirmar_nuevo").on("click",function(){
        // Guardamos los campos
        let nombre = nuevaFila.find('input[name="nombre"]').val();
        let apellido = nuevaFila.find('input[name="apellido"]').val();
        let correo = nuevaFila.find('input[name="correo"]').val();
        // Validaciones
        if(nombre == "" || apellido == "" || correo == ""){
            Swal.fire("Campos vacíos", "Todos los campos son obligatorios", "error");
            return;
        }

        // Guardamos los datos del post

        let datosPost = {
            firstname: nombre,
            lastname: apellido,
            email: correo
        };

        console.log(datosPost);

        $.post('index.php', datosPost, function(response){
            nuevaFila.remove(); // Elimino la fila
            datosPost.id = response; // El PHP me devuelve el último id de la tabla
            agregarRegistro(datosPost); // Agrego la fila a la tabla
            Swal.fire("Registrado", "El registro ha sido agregado con éxito", "success");
            
        }).fail(function(errorThrown){
            Swal.fire("Error", "Ha ocurrido un error al intentar agregar el registro " + errorThrown, "error" );   
            
        })
        $("#nuevo_contacto").prop('disabled',false); // Habilitamos el botón para evitar que se cree más de un formulario
    });
    $("#cancelar_nuevo").on("click", function(){
        nuevaFila.remove();
        $("#nuevo_contacto").prop('disabled',false);
    })
});