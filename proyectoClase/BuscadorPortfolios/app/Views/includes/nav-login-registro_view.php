<body>
    <nav class="nav-menu">
        <ul>
            <li>
                <div class="dropdown">
                    <span class='user-name'><?php echo $_SESSION["usuario"]["nombre"]; ?></span>
                    <button class="dropbtn">
                        <img src="../img-usuarios/User-icon.png" alt="Perfil" class="User-icon-img">
                    </button>
                    <div class="dropdown-content">
                        <a onclick="mostrarFormulario('inicioSesionModal')">Login</a>
                        <a onclick="mostrarFormulario('registroModal')">Sing in</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</body>