<?php
foreach($data['usuario'][0]["redes"] as $redesSociales) {
?>

<div id="editRedSocial" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('editRedSocial')">&times;</span>
        <h1>Edición de una Red Social</h1>
        <form id="editRedSocialForm" action="" method="POST">
            <label for="nombre">Nombre red Social:</label>
            <input type="text" name="nombreSocial" id="nombreSocial" value="<?php echo $redesSociales["redes_socialescol"]; ?>">
            <br>
            <label for="apellidos">URL:</label>
            <input type="text" name="url" id="url" value="<?php echo $redesSociales["url"]; ?>">
            <br>
            <label for="visible">Visible</label>
            <div clas="div-radio-button">
                <input type="radio" name="visible" id="visible-si" value="1"> Sí
                <input type="radio" name="visible" id="visible-no" value="0"> No
            </div>
            <br>
            <input type="submit" name="editar_redSocial" value="Editar Red Social" id="btn-editar">
        </form>
    </div>
</div>

<?php
    }
?>