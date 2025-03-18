<?php
foreach($data['usuario'][0] as $usuario) {
?>

<div id="editUser" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('editUser')">&times;</span>
        <h1>Edición de Usuario</h1>
        <form id="editUserForm" action="" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($usuario['nombre']) ? $usuario['nombre'] : ''; ?>">
            <br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo isset($usuario['apellidos']) ? $usuario['apellidos'] : '';?>">
            <br>
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto">
            <br>
            <label for="cat_profe">Categoria Profesional:</label>
            <input type="text" name="cat_profe" id="cat_profe" value="<?php echo isset($usuario['cat_profe']) ? $usuario['cat_profe'] : ''; ?>">
            <br>
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" value="<?php echo isset($usuario['email']) ? $usuario['email'] : ''; ?>">
            <br>
            <input type="submit" name="editar_Usuario" value="Editar Usuario" id="btn-edit">
        </form>
    </div>
</div>

<?php
    }
?>