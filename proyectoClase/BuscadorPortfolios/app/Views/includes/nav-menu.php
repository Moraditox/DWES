<body>
    <nav class="nav-menu">
        <ul>
            <li>
                <div class="dropdown">
                    <span class='user-name'><?php echo $_SESSION["usuario"]["nombre"]; ?></span>
                    <button class="dropbtn">
                        <?php $urlIMG = "../img-usuarios/" . $_SESSION["usuario"]["foto"]; ?>
                        <img src=<?php echo "$urlIMG" ?> alt="Perfil" class="User-icon-img">
                    </button>
                    <div class="dropdown-content">
                        <a href="/perfil">Perfil</a>
                        <a href="/cierre-sesion/">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</body>