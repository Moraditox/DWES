<?php
foreach($data['usuario'][0]["trabajos"] as $trabajo) {
?>

<div id="editJob" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('editJob')">&times;</span>
        <h1>Edición de un Trabajo</h1>
        <form id="editJobForm" action="" method="POST">
            <label for="nombre">Titulo:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $trabajo["titulo"]; ?>">
            <br>
            <label for="apellidos">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?php echo $trabajo["descripcion"]; ?>">
            <br>
            <label for="foto">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $trabajo["fecha_inicio"]; ?>">
            <br>
            <label for="cat_profe">Fecha de Fin:</label>
            <input type="date" name="fecha_final" id="fecha_final" value="<?php echo $trabajo["fecha_final"]; ?>">
            <br>
            <label for="email">Logros:</label>
            <input type="text" name="logros" id="logros" value="<?php echo $trabajo["logros"]; ?>">
            <br>
            <input type="submit" name="editar_trabajo" value="Editar Trabajo" id="btn-editar">
        </form>
    </div>
</div>

<?php
    }
?>