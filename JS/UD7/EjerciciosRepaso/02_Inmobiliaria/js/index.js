"use strict";

// Esperamos a que cargue el documento
$(function () {
  cargarZonas();
  $("#enviar").on("click", validarFormulario);
});

// Función para cargar las zonas
function cargarZonas() {
  // Realiza una solicitud AJAX de tipo GET al archivo "zonas.php" que devuelve datos en formato JSON
  $.getJSON("./php/zonas.php")
    .done((response) => {
      // Al recibir la respuesta, se extraen los datos (en formato JSON)
      let data = response.data;

      // Se selecciona el elemento <select> con el id "zona" donde se agregarán las opciones
      let $listaZona = $("#zona");

      // Se recorre cada elemento en la respuesta para crear las opciones del dropdown
      data.forEach((zona) => {
        $("<option>", {
          // Se define el valor y el texto de cada opción
          value: zona.idzona,
          text: zona.descripcion,
        }).appendTo($listaZona); // Se agrega la nueva opción al dropdown
      });
    })
    .fail((error) => {
      // Si la solicitud falla, se muestra un mensaje de error en la consola
      console.error("Error al obtener zonas: ", error);
    });
}


// Función para validar el formulario con JQuery

function validarFormulario(event) {
  // Evitamos que el formulario se envíe automáticamente
  event.preventDefault();

  //Guardamos los campos

  let $dni = $("#dni");
  let $zona = $("#zona");
  let $precio = $("#precio");
  let $numHabSeleccionado = $("input[name='numhab']:checked");

  let errores = [];
  // Reseteamos los estilos previos

  $(".error-borde").removeClass("error-borde");
  // Validamos DNI

  if (!validarDNI($dni.val().trim())) {
    errores.push("El DNI Ingresado no es válido");
    // Buscamos el input-group-text mas cercano al dni para mostrar el error
    $dni.closest(".input-group").find(".input-group-text").addClass("error-borde");
  }

  // Validamos la zona seleccionada

  if ($zona.val() === "") {
    errores.push("Debe seleccionar una zona");
    $zona.closest(".input-group").find(".input-group-text").addClass("error-borde")
  }

  // Validar precio
  if ($precio.val() === "") {
    errores.push("Debe seleccionar un precio máximo.");
    $precio.closest(".input-group").find(".input-group-text").addClass("error-borde")
  }

  // Validar número de habitaciones seleccionado

  if ($numHabSeleccionado.length === 0) {
    errores.push("Debe seleccionar un número de habitaciones");
    $("input[name='numhab']")
      .closest(".input-group")
      .find(".input-group-text")
      .addClass("error-borde");
  }

  // Si hay errores, mostramos una alerta con SweetAlert

  if (errores.length > 0) {
    Swal.fire("Errores en el formulario", errores.join("<br>"), "warning");
  } else {
    // Si todo está correcto, enviamos la solicitud
    mostrarInmuebles($zona.val(), $numHabSeleccionado.val(), $precio.val());
  }

  // Eliminar la clase de error cuando el usuario cambie el valor
  $("#dni, #zona, #precio, input[name='numhab']").on("input change", function () {
    $(this).closest(".input-group").find(".input-group-text").removeClass("error-borde");
    $(this).closest(".form-check").find("label").removeClass("error-borde");
  });

}


// Función para validar el DNI

function validarDNI(dni) {
  // Comprobamos que el formato sea correcto (8 números + 1 letra)
  return /^\d{8}[A-Z]$/.test(dni);

}

// Función que muestra los inmuebles disponibles en la tabla

function mostrarInmuebles(zona, habitaciones, precio) {
  // Guardamos el cuerpo de la tabla
  let $tbody = $("tbody"); // Seleccionamos el cuerpo de la tabla
  $tbody.empty();

  // Función jquery-ajax para obtener el fichero json

  $.getJSON(`./php/inmuebles.php?zona=${zona}&habitaciones=${habitaciones}&precio=${precio}`)
    .done((response) => {
      if (response.data.length === 0) {
        Swal.fire("Sin resultados", "No hay inmuebles disponibles para los filtros seleccionados.", "info");
        return;
      }

      // Iteramos sobre los inmuebles y los agregamos a la tabla

      response.data.forEach((inmueble) => {
        let $fila = $("<tr>").append(
          $("<td>").text(inmueble.idinmuebles),
          $("<td>").text(inmueble.domicilio),
          $("<td>").text(`${inmueble.precio}€`)
        );

        $fila.on("click", () => {
          $fila.toggleClass("selected");
        });

        $tbody.append($fila);
      });

        // Agregar botón para reservar
        $(".capaGrabar").html(
          "<button type='button' onclick='reservar()' class='boton btn btn-primary btn-lg mt-3'>Grabar</button>"
        );
    })

    .fail((error) => {
      console.error("Error al obtener los inmuebles", error);
      Swal.fire("Error", "No se pudo obtener la lista de inmuebles.", "error");
    });
}

// Función para reservar inmueble

function reservar() {
  let seleccionados = $(".selected td:first-child");
  if (seleccionados.length === 0) {
    Swal.fire("Atención", "Debe seleccionar al menos un inmueble para reservar.", "warning");
    return;
  }

  // Recorremos los inmuebles seleccionados

  seleccionados.each(function () {
    let datos = {
      dni: $("#dni").val().toUpperCase(),
      inmueble: $(this).text(),
    };

    $.ajax({
      url: "./php/reservas.php",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify(datos),
    })
      .done(() => {
        Swal.fire({
          text: "Se ha realizado la reserva",
          icon: "success",
        }).then(() => {
          reload();
        });
      }).fail(() => {
        Swal.fire({
          text: "Algo ha salido mal",
          icon: "warning",
        }).then(() => {
          reload();
        });
      });
  });
}

// Función para recargar el formulario

function reload(){
  $(".capaGrabar").empty();
  $("#frm")[0].reset();
  $("tbody").empty();
  $(".is-valid, .is-invalid").removeClass("is-valid is-invalid");
}