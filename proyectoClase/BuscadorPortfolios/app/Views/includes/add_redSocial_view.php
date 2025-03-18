<div id="addRedSocial" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('addRedSocial')">&times;</span>
        <h1>Añadir una Red Social</h1>
        <form action="/addRedSocial" method="POST">
            <label for="nombre">Nombre red Social:</label>
            <input type="text" name="nombreSocial" id="nombreSocial">
            <br>
            <label for="apellidos">URL:</label>
            <input type="text" name="url" id="url">
            <br>
            <label for="visible">Visible</label>
            <div clas="div-radio-button">
                <input type="radio" name="visible" id="visible-si" value="1"> Sí
                <input type="radio" name="visible" id="visible-no" value="0"> No
            </div>
            <br>
            <input type="submit" name="add_redSocial" value="Añadir Red Social" id="btn-aniadir">
        </form>
    </div>
</div>