<body>
    <div id="progress"></div>
    <header>
        <h1><a href="/"><img src="../img/logo.png" alt="" id="logo"></a>Buscador de Portfolios</h1>
        
        <?php if(($_SERVER['REQUEST_URI'] === '/') || preg_match('/buscar-perfil\/.*$/', $_SERVER['REQUEST_URI'])) { ?>
            <section class="section-buscador">
            <form action="/buscar-perfil/" method="GET">
            <input type="text" name="q" id="q" placeholder="Haz tu busqueda">
            <button type="submit">Buscar</button>
            </form>
            </section>
           <?php } ?>
        <nav>
            <ul>
                <li><a href="#"><img src="../img/gorjeo.png" alt=""></a></li>
                <li><a href="#"><img src="../img/instagram.png" alt=""></a></li>
                <li><a href="#"><img src="../img/linkedin.png" alt=""></a></li>
                <li><a href="#"><img src="../img/tik-tok.png" alt=""></a></li>
            </ul>
        </nav>
    </header>
</body>