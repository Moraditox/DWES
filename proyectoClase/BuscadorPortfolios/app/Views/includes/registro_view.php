<div id="registroModal" class="modal">
    <div id="div-form">
        <span class="close" onclick="cerrarFormulario('registroModal')">&times;</span>
        <h1>Registro de Usuario</h1>
        <form action="/addUser" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($_SESSION['registro']['nombre']) ? $_SESSION['registro']['nombre'] : ''; ?>">
            <br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo isset($_SESSION['registro']['apellidos']) ? $_SESSION['registro']['apellidos'] : '';?>">
            <br>
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto">
            <br>
            <label for="cat_profe">Categoria Profesional:</label>
            <input type="text" name="cat_profe" id="cat_profe" value="<?php echo isset($_SESSION['registro']['cat_profe']) ? $_SESSION['registro']['cat_profe'] : '' ?>">
            <br>
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" value="<?php echo isset($_SESSION['registro']['email']) ? $_SESSION['registro']['email'] : ''; ?>">
            <br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena">
            <br>
            <label for="contrasena">Verificar Contraseña:</label>
            <input type="password" name="verifiContrasena" id="verifiContrasena">
            <br>
            <input type="submit" name="registro" value="Registrarse" id="btn-registrar">
        </form>
    </div>
</div>