<?php
/**
 * 
 * Archivo de la vista del menú de navegación
 * 
 * @author Héctor Mora Sánchez
 * @date 2025-05-10
 */
?>
<body>
    <section class="section-portfolio">
        <?php
            if(empty($data["usuariosV"])){
                echo "<h2>No hay usuarios</h2>";    
            }else{
                foreach($data["usuariosV"]as $usuarios){
                    echo "<article>";
                        echo "<img src='../img-usuarios/{$usuarios['foto']}' alt=''>";
                        echo "<p>" . $usuarios['nombre'] . "</p></br>";
                        echo "<a>" . $usuarios['email'] . "</a></br>";
                        echo "<button><a href='/perfil/" . $usuarios['id'] . "'>Ver Portfolio</a></button>";
                    echo "</article>";
                }
            }
        ?>
    </section>
</body>