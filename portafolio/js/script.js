// Obtener la fecha actual
const fechaActual = new Date();
const mes = fechaActual.getMonth(); // Obtener el mes actual (0-11)
const hora = fechaActual.getHours(); // Obtener la hora actual (0-23)

// Función para cambiar la imagen de cabecera según la estación del año
function cambiarImagenEstacion() {
    const imagen = document.getElementById('header-image');
    if (mes >= 2 && mes <= 4) {
        // Primavera (marzo, abril, mayo)
        imagen.src = 'img/primavera.jpg';
    } else if (mes >= 5 && mes <= 7) {
        // Verano (junio, julio, agosto)
        imagen.src = 'img/verano.jpg';
    } else if (mes >= 8 && mes <= 10) {
        // Otoño (septiembre, octubre, noviembre)
        imagen.src = 'img/otono.jpg';
    } else {
        // Invierno (diciembre, enero, febrero)
        imagen.src = 'img/invierno.jpg';
    }
}

// Función para cambiar el color de fondo según la hora del día
function cambiarColorFondo() {
    if (hora >= 6 && hora < 12) {
        // Mañana (6 AM a 12 PM)
        document.body.style.backgroundColor = '#FFFAE3'; // Amarillo claro
    } else if (hora >= 12 && hora < 18) {
        // Tarde (12 PM a 6 PM)
        document.body.style.backgroundColor = '#FFD700'; // Dorado
    } else if (hora >= 18 && hora < 21) {
        // Atardecer (6 PM a 9 PM)
        document.body.style.backgroundColor = '#FF8C00'; // Naranja oscuro
    } else {
        // Noche (9 PM a 6 AM)
        document.body.style.backgroundColor = '#2C3E50'; // Azul oscuro
    }
}

// Ejecutar las funciones al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    cambiarImagenEstacion(); // Cambiar la imagen de cabecera según la estación
    cambiarColorFondo();     // Cambiar el color de fondo según la hora del día
});;