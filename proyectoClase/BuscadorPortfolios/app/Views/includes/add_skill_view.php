<div id="addSkill" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('addSkill')">&times;</span>
        <h1>Edición de una Skill</h1>
        <form action="/addSkill" method="POST">
            <label for="nombre">Habilidades:</label>
            <input type="text" name="habilidades" id="habilidades">
            <br>
            <label for="apellidos">Categoria de la Skill:</label>
            <select name="categorias_skills_categorias" id="categorias_skills_categorias">
                <?php
                foreach($data['categoria_skill'] as $categoria_skill) {
                    echo "<option value=" . $categoria_skill['categoria'] . " selected>" . $categoria_skill['categoria'] . "</option>";
                }
                ?>
            </select>
            <br>
            <label for="visible">Visible</label>
            <div clas="div-radio-button">
                <input type="radio" name="visible" id="visible-si" value="1"> Sí
                <input type="radio" name="visible" id="visible-no" value="0"> No
            </div>
            <br>
            <input type="submit" name="add_skill" value="Añadir Skill" id="btn-editar">
        </form>
    </div>
</div>