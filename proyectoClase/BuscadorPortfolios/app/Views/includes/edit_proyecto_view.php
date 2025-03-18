<?php
foreach($data['usuario'][0]["proyectos"] as $proyecto) {
?>

<div id="editProyect" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('editProyect')">&times;</span>
        <h1>Edición de un Proyecto</h1>
        <form id="editProyectForm" action="" method="POST">
            <label for="nombre">Titulo:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $proyecto["titulo"]; ?>">
            <br>
            <label for="apellidos">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?php echo $proyecto["descripcion"]; ?>">
            <br>
            <label for="foto">Logo:</label>
            <input type="file" name="logoForm" id="logoForm">
            <br>
            <label for="cat_profe">Tecnologias:</label>
            <input type="text" name="tecnologias" id="tecnologias" value="<?php echo $proyecto["tecnologias"]; ?>">
            <br>
            <input type="submit" name="editar_trabajo" value="Editar Trabajo" id="btn-editar">
        </form>
    </div>
</div>

<?php
    }
?>