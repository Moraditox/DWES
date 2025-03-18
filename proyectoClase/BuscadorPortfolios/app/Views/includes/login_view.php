<body>
    <div id="inicioSesionModal" class="modal">
        <div id="div-form">
            <span class="close" onclick="cerrarFormulario('inicioSesionModal')">&times;</span>
            <h1>Inicio de Sesión</h1>
            <form action="/loginUser" method="POST">
                <label for="usuario">E-mail:</label>
                <input type="text" name="email" id="email">
                <br>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena">
                <br>
                <input type="submit" name="login" value="Iniciar Sesión" id="btn-iniciar-sesion">
            </form>
        </div>
    </div>
</body>