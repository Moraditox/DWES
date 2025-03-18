<?php
foreach($data['usuario'][0]["skills"] as $skill) {
?>

<div id="editSkill" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('editSkill')">&times;</span>
        <h1>Edición de una Skill</h1>
        <form id="editSkillForm" action="" method="POST">
            <label for="nombre">Habilidades:</label>
            <input type="text" name="habilidades" id="habilidades" value="<?php echo $skill["habilidades"]; ?>">
            <br>
            <label for="apellidos">Categoria de la Skill:</label>
            <select name="categorias_skills_categorias" id="categorias_skills_categorias">
                <?php
                foreach($data['usuario'][0]["categoria_skill"] as $categoria_skill) {
                    echo "<option value=" . $categoria_skill['categoria'] . " selected>" . $categoria_skill['categoria'] . "</option>";
                }
                ?>
            </select>
            <br>
            <input type="submit" name="editar_skill" value="Editar Skill" id="btn-editar">
        </form>
    </div>
</div>

<?php
    }
?>