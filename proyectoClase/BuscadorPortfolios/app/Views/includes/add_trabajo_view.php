<div id="addJob" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('addJob')">&times;</span>
        <h1>Añadir Trabajo</h1>
        <form action="/addJob" method="POST">
            <label for="nombre">Titulo:</label>
            <input type="text" name="titulo" id="titulo">
            <br>
            <label for="apellidos">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion">
            <br>
            <label for="foto">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio">
            <br>
            <label for="cat_profe">Fecha de Fin:</label>
            <input type="date" name="fecha_final" id="fecha_final">
            <br>
            <label for="email">Logros:</label>
            <input type="text" name="logros" id="logros">
            <br>
            <label for="visible">Visible</label>
            <div class="div-radio-button">
                <input type="radio" name="visible" id="visible-si" value="1"> Sí
                <input type="radio" name="visible" id="visible-no" value="0"> No
            </div>
            <br>
            <input type="submit" name="add_trabajo" value="Añadir Trabajo" id="btn-editar">
        </form>
    </div>
</div>