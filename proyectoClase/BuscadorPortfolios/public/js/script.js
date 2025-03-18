//FUNCIONES PARA EL INICIO DE SESION
function mostrarFormulario(id) {
    let modal = document.getElementById(id);
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Deshabilitar el scroll
}

function mostrarFormularioEditar(id, formId, trabajoId = null) {
    let modal = document.getElementById(id);
    modalId = modal.id;
    let form = document.getElementById(formId);
    form.action = "/" + modalId + "/" + trabajoId; // Asigna la acción con la ID del trabajo
    fetch(window.location.href, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id_editar=" + trabajoId
    }).then(response => response.json())
    modal.style.display = "block";
    document.body.style.overflow = 'hidden'; // Deshabilitar el scroll
    
}

function cerrarFormulario(id) {
    let modal = document.getElementById(id);
    modal.style.display = 'none';
    document.body.style.overflow = 'auto'; // Habilitar el scroll
}

// Ocultar el mensaje después de 5 segundos
window.onload = function() {
    var mensaje = document.getElementById('mensaje');
    if (mensaje) {
        setTimeout(function() {
            mensaje.style.display = 'none';
        }, 5000); // 5000 milisegundos = 5 segundos
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const selectBusqueda = document.getElementById('busqueda');
    const inputBuscador = document.getElementById('buscador');

    selectBusqueda.addEventListener('change', function() {
        if (selectBusqueda.value === 'nombre') {
            inputBuscador.placeholder = 'Buscar por nombre';
            inputBuscador.name = 'buscador_nombre';
        } else if (selectBusqueda.value === 'email') {
            inputBuscador.placeholder = 'Buscar por e-mail';
            inputBuscador.name = 'buscador_email';
        }
    });

    // Manejar el menú desplegable
    document.querySelector('.dropbtn').addEventListener('click', function() {
        document.querySelector('.dropdown-content').classList.toggle('show');
    });

    // Cerrar el menú si se hace clic fuera de él
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName('dropdown-content');
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
});