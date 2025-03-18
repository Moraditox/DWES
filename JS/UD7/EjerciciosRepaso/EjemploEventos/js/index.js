'use strict'

// Función que se ejecuta cuando el documento ha sido cargado
$(function () {

    // Cargamos el select con las categorías ordenadas por orden alfabético con el fichero php/categorias.php. Usaremos axios
    $('document').ready(function () {
        
        // Realizamos la petición AJAX
        axios.get('php/categorias.php')
            .then(function (response) {
                console.log(response);

                // Si la petición es correcta, recorremos el array de categorías y las añadimos al select
                if (response.data) {
                    // Ordenamos las categorías por descripción alfabéticamente
                    response.data.data.sort((a, b) => a.descripcion.localeCompare(b.descripcion));
                    
                    // Recorremos el array de categorías y las añadimos al select
                    response.data.data.forEach(categoria => {
                        $('#categorias').append(`<option value="${categoria.id}">${categoria.descripcion}</option>`);
                    });
                }
            })
            .catch(function (error) {
                // Si hay un error, lo mostramos por consola
                console.error(error);
        });

        // Ocultamos el botón de grabar porque la página de inicio está vacía
        $('button[type="type"]').hide();
    });

    // Evento que se ejecuta cuando el input de id "cdgCli" pierde el foco
    $('#cdgCli').blur(function () {
        // Recogemos el valor del input de id "cdgCli"
        const cdgCli = $('#cdgCli').val();

        // Realizamos la petición AJAX
        $.ajax({
            url: 'php/cliente.php',
            type: 'POST',
            data: { cliente: cdgCli },
            success: function (response) {
                // Si tenemos respuesta, asignamos el nombre del cliente en el input de id "nomCli"
                if (response.data && response.data.length > 0) {
                    console.log(response.data[0].nomApe);
                    $('#nameCli').val(response.data[0].nomApe);
                } else {
                    $('#nameCli').val('Cliente no registrado');
                }
            },
            error: function () {
                // Si el cliente no existe, mostramos "Cliente no registrado"
                $('#nameCli').val('Cliente no registrado');

                // Ponemos el foco de nuevo en el input del cliente
                $('#cdgCli').focus();
            }
        });
    });

    // Cuando el usuario seleccione una categoría, mostramos los eventos que tengan esa id_categoria y
    // deshabilitamos la primera option del select. Usaremos axios
    $('#categorias').change(function () {
        // Recogemos el valor del select
        const idCategoria = $('#categorias').val();
    
        // Realizamos la petición AJAX
        axios.post('php/eventos.php', new URLSearchParams({ categoria: idCategoria }))
            .then(function (response) {
                console.log(response);
                // Aquí puedes manejar la respuesta y mostrar los eventos en el frontend.
                if (response.data && response.data.data) {
                    // Agregamos los eventos recibidos al select de eventos
                    $('#eventos').empty();

                    $('#eventos').append('<option value="">Selecciona un evento</option>');
                    // Ordenamos los eventos por descripción alfabéticamente
                    response.data.data.sort((a, b) => a.descripcion.localeCompare(b.descripcion));
                    response.data.data.forEach(evento => {
                        $('#eventos').append(`<option value="${evento.id}">${evento.descripcion}</option>`);
                    });
                }
            })
            .catch(function (error) {
                // Si hay un error, lo mostramos por consola
                console.error(error);
            });
    
        // Deshabilitamos la primera opción del select solo después de que se seleccione una categoría
        $('#categorias option:first').prop('disabled', true);
    });

    // Vamos a recoger el valor del número de entradas, si el usuario se pasa de las entradas disponibles,
    // Mostraremos un mensaje a lado del número de entradas disponibles. Usaremos axios
    $('#entradas').change(function () {
        // Recogemos el valor del input de id "entradas"
        const numEntradas = $('#entradas').val();
        const idEvento = $('#eventos').val();

        if (numEntradas === '' || idEvento === '') {
            return;
        }

        // Realizamos la petición AJAX
        axios.post('php/evento.php', new URLSearchParams({ idEvento: idEvento}))
            .then(function (response) {

                // Si el número de entradas es mayor que las entradas disponibles, mostramos un mensaje de error
                if (response.data.data[0].entradas < numEntradas) {
                    $('.errorAforo').text('Entradas disponibles: ' + response.data.data[0].entradas);
                } else {
                    $('.errorAforo').text('');
                }

            })
            .catch(function (error) {
                // Si hay un error, lo mostramos por consola
                console.error(error);
            });
    });

    // Al clickar añadir evento, validaremos los campos del formulario y si todo es correcto
    // añadiremos los datos a la tabla.

    $('button[type="submit"]').click(function (e) {
        e.preventDefault();

        // Recogemos los valores de los inputs
        const idEvento = $('#eventos').val();
        const numEntradas = $('#entradas').val();
        // Comprobamos que fecha es del tipo date
        const fecha = $('#fecha').val();
        const nomApe = $('#nameCli').val();
        const cdgCli = $('#cdgCli').val();

        // Validamos los campos
        if (idEvento === '' || numEntradas === '' || fecha === '' || nomApe === '' || cdgCli === '') {
            alert('Todos los campos son obligatorios');
            return;
        }

        // Recuperamos la información del evento seleccionado
        axios.post('php/evento.php', new URLSearchParams({ idEvento: idEvento}))
            .then(function (response) {
                // Si el número de entradas es mayor que las entradas disponibles, mostramos un mensaje de error
                if (response.data.data[0].entradas < numEntradas) {
                    $('.errorAforo').text('Entradas disponibles: ' + response.data.data[0].entradas);
                    return;
                } else {
                    $('.errorAforo').text('');
                }

                console.log(response);
                // Añadimos los datos a la tabla
                $('.table tbody').append(`
                    <tr>
                        <td>${idEvento}</td>
                        <td>${response.data.data[0]['descripcion']}</td>
                        <td>${numEntradas}</td>
                        <td>${response.data.data[0]['precioEntrada']}</td>
                        <td>${response.data.data[0]['precioEntrada'] * numEntradas}</td>
                        <td>${fecha}</td>
                    </tr>
                `);

                // Limpiamos los campos
                $('#eventos').val('');
                $('#entradas').val('');
                $('#precio').val('');
                $('#fecha').val('');
                $('#categorias').val('');
            })
            .catch(function (error) {
                // Si hay un error, lo mostramos por consola
                console.error(error);
            });

            // Si el botón de grabar está oculto, lo mostramos
            $('button[type="type"]').show();
    });

    // Al pulsar el botón grabar, guardamos los datos en la base de datos mediante compra.php
    $('button[type="type"]').click(function () {
        // Recogemos los datos de la tabla
        const table = $('.table tbody tr');

        // Por cada fila ejecutamos una petición AJAX
        table.each(function (index, element) {
            const usuario = $('#cdgCli').val();
            const idEvento = $(element).find('td').eq(0).text();
            const entradas = $(element).find('td').eq(2).text();
            const total = $(element).find('td').eq(4).text();
            const fecha = $(element).find('td').eq(5).text();

            // Realizamos la petición AJAX
            axios.post('php/compra.php', new URLSearchParams({
                usuario: usuario,
                idEvento: idEvento,
                entradas: entradas,
                importe: total,
                fecha: fecha
            }))
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    // Si hay un error, lo mostramos por consola
                    console.error(error);
            });

            // Actualizamos el número de entradas en la base de datos
            axios.post('php/actualizarEntradas.php', new URLSearchParams({
                evento: idEvento,
                tickets: entradas
            }));
        });

        // Vaciamos la tabla, ocultamos el botón de grabar
        $('.table tbody').empty();
        $('button[type="type"]').hide();
    });
})