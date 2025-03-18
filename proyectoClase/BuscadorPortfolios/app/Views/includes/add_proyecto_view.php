<div id="addProyect" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('addProyect')">&times;</span>
        <h1>Añadir un Proyecto</h1>
        <form action="/addProyect" method="POST">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo">
            <br>
            <label for="descripcion">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion">
            <br>
            <label for="logo">Logo:</label>
            <input type="file" name="logo" id="logoForm">
            <br>
            <label for="tecnologias">Tecnologias:</label>
            <input type="text" name="tecnologias" id="tecnologias">
            <br>
            <label for="visible">Visible</label>
            <div clas="div-radio-button">
                <input type="radio" name="visible" id="visible-si" value="1"> Sí
                <input type="radio" name="visible" id="visible-no" value="0"> No
            </div>
            <br>
            <input type="submit" name="add_proyecto" value="Añadir Proyecto" id="btn-aniadir">
        </form>
    </div>
</div>