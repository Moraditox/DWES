<?php

/**
 * 
 * Archivo de la vista del perfil del usuarioº
 * 
 * @author Héctor Mora Sánchez
 * @date 2025-05-10
 */

use function PHPSTORM_META\type;

include "edit_user_view.php";
include "edit_trabajo_view.php";
include "edit_skill_view.php";
include "edit_proyecto_view.php";
include "edit_redSocial_view.php";
include "add_trabajo_view.php";
include "add_skill_view.php";
include "add_proyecto_view.php";
include "add_redSocial_view.php";

// Guardar ID en sesión si viene por POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_editar'])) {
    $_SESSION['id_editar'] = intval($_POST['id_editar']);
    exit();
}

$url = explode('/', ($_SERVER['REQUEST_URI']));
if(count($url) > 2) {
    $id = end($url);
}

$usuarioSesion = null;
?>

<body>
    <section class="section-perfil">
        <?php
        if(count($url) > 2 ){
            foreach ($data['usuario'] as $usuario) {
                $usuarioSesion = $usuario;
                if($usuario["id"] == $id) {
                    $idUsuario = $usuario["id"];
                    $nombre = $usuario["nombre"];
                    $apellido = $usuario["apellidos"];
                    $foto = $usuario["foto"];
                    $cat_profe = $usuario["categoria_profesional"];
                    $visible = $usuario["visible"];
                    break;
                }
                if ($usuarioSesion === null) {
                    foreach ($data['usuario'][0] as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $subUsuario) {
                        if ($usuario["id"] == $subUsuario['id']) {
                            $usuarioSesion = $subUsuario;
                            break 2;
                        }
                        }
                    }
                    }
                }
            }
        }else {
            foreach ($data['usuario'] as $usuario) {
                $usuarioSesion = $usuario;
                if ($usuario["id"] == $_SESSION["usuario"]["id"]) {
                    $idUsuario = $usuario["id"];
                    $nombre = $usuario["nombre"];
                    $apellido = $usuario["apellidos"];
                    $foto = $usuario["foto"];
                    $cat_profe = $usuario["categoria_profesional"];
                    $visible = $usuario["visible"];
                    break;
                }
                if ($usuarioSesion === null) {
                    foreach ($data['usuario'][0] as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $subUsuario) {
                        if ($_SESSION["usuario"]["id"] == $subUsuario['id']) {
                            $usuarioSesion = $subUsuario;
                            break 2;
                        }
                        }
                    }
                    }
                }
            }
        }
        $data['usuario'] = [$usuarioSesion];
        ?>
        <?php $urlIMG = "../img-usuarios/" . $foto; ?>
        <div class="div-perfil">
            <img src=<?php echo "$urlIMG" ?> alt="Perfil" class="img-perfil">
            <span class='user-name-perfil'><?php echo $nombre . " " . $apellido; ?></span>
            <span class='cate-profe-perfil'><?php echo $cat_profe; ?></span>
        </div>
        <?php
            if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $idUsuario && empty($id)) {
                echo "<div class='button-container-perfil'>";
                if($visible == 0) {
                    echo "<a href='/mostrarUser/$idUsuario'>Mostrar Perfil</a>";
                } else {
                    echo "<a href='/mostrarUser/$idUsuario'>Ocultar Perfil</a>";
                }?>
                    <a onclick="mostrarFormularioEditar('editUser', 'editUserForm', <?php echo $idUsuario; ?>)">Editar</a>
                    <a href="/deleteUser/<?php echo $idUsuario; ?>">Eliminar</a>
                <?php echo "</div>";
            }
        ?>
    </section>

    <h1>Trabajos</h1>
    <?php
    if ($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $usuario['id'] && empty($id)) {
    ?>
    <div class="div-añadir">
        <a class="añadir-boton" onclick="mostrarFormulario('addJob')">Añadir Trabajo</a>
    </div>
    <?php
    }
    ?>
    <article class="article-full">
        <?php
        if (empty($id)) {
            $trabajos = $data['usuario'][0]["trabajos"];
        }else{
            $trabajos = $data['usuario'][0]["trabajosV"];
        }
        if (!empty($trabajos)) {
            foreach ($trabajos as $trabajo) {
                $idTrabajo = $trabajo['id'];
                echo "<article class='article'>";
                    echo "<h2>" . $trabajo["titulo"] . "</h2>";
                    echo "<p>" . $trabajo["descripcion"] . "</p>";
                    echo "<p> Fecha de inicio: " . $trabajo["fecha_inicio"] . "</p>";
                    echo "<p> Fecha de finalización: " . $trabajo["fecha_final"] . "</p>";
                    echo "<p> Logros: " . $trabajo["logros"] . "</p>";
                    if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $trabajo["usuarios_id"] && empty($id)) {
                        echo "<div class='button-container'>";
                        if($trabajo["visible"] == 0) {
                            echo "<a href='/mostrarJob/$idTrabajo'>Mostrar trabajo</a>";
                        } else {
                            echo "<a href='/mostrarJob/$idTrabajo'>Ocultar trabajo</a>";
                        }?>
                            <a onclick="mostrarFormularioEditar('editJob', 'editJobForm', <?php echo $idTrabajo; ?>)">Editar</a>
                            <a href="/deleteJob/<?php echo $idTrabajo; ?>">Eliminar</a>
                        <?php echo "</div>";
                    }
                echo "</article>";
            } 
        }else {  
                echo "<p>No se encontró información del trabajo.</p>";
        }?>
    </article>

    <h1>Skills</h1>
    <?php
    if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $usuario['id'] && empty($id)) {
    ?>
    <div class="div-añadir">
        <a class="añadir-boton" onclick="mostrarFormulario('addSkill')">Añadir Skill</a>
    </div>
    <?php
    }
    ?>
    <article class="article-full">
        <?php
        if (empty($id)) {
            $skills = $data['usuario'][0]["skills"];
        }else{
            $skills = $data['usuario'][0]["skillsV"];
        }
        if (!empty($skills)) {
            foreach ($skills as $skill) {
            $idSkill = $skill['id']; 
            echo "<article class='article'>";
                echo "<p> Habilidades: " . $skill["habilidades"] . "</p>";
                echo "<p> Categoria de las skills: " . $skill["categorias_skills_categoria"] . "</p>";
                if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $skill["usuarios_id"] && empty($id)) {
                    echo "<div class='button-container'>";
                    if($skill["visible"] == 0) {
                        echo "<a href='/mostrarSkill/$idSkill'>Mostrar Skill</a>";
                    } else {
                        echo "<a href='/mostrarSkill/$idSkill'>Ocultar Skill</a>";
                    }?>
                        <a onclick="mostrarFormularioEditar('editSkill', 'editSkillForm', <?php echo $idSkill; ?>)">Editar</a>
                        <a href="/deleteSkill/<?php echo $idSkill; ?>">Eliminar</a>
                    <?php echo "</div>";
                }
            echo "</article>";
            }
        } else {
            echo "<p>No se encontró información de las skills.</p>";
        }
        ?>
    </article>

    <h1>Proyectos</h1>
    <?php
    if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $usuario['id'] && empty($id)) {
    ?>
    <div class="div-añadir">
        <a class="añadir-boton" onclick="mostrarFormulario('addProyect')">Añadir Proyecto</a>
    </div>
    <?php
    }
    ?>
    <article class="article-full">
        <?php
        if (empty($id)) {
            $proyectos = $data['usuario'][0]["proyectos"];
        }else{
            $proyectos = $data['usuario'][0]["proyectosV"];
        }
        if (!empty($proyectos)) {
            foreach ($proyectos as $proyecto) {
                $idProyecto = $proyecto['id'];
                echo "<article class='article'>";
                    echo "<h2>" . $proyecto["titulo"] . "</h2>";
                    echo "<p>" . $proyecto["descripcion"] . "</p>";
                    echo "<p> Logo: " . $proyecto["logo"] . "</p>";
                    echo "<p> Tecnologia: " . $proyecto["tecnologias"] . "</p>";
                    if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $proyecto["usuarios_id"] && empty($id)) {
                        echo "<div class='button-container'>";
                        if($proyecto["visible"] == 0) {
                            echo "<a href='/mostrarProyect/$idProyecto'>Mostrar Proyecto</a>";
                        } else {
                            echo "<a href='/mostrarProyect/$idProyecto'>Ocultar Proyecto</a>";
                        }?>
                            <a onclick="mostrarFormularioEditar('editProyect', 'editProyectForm', <?php echo $idProyecto; ?>)">Editar</a>
                            <a href="/deleteProyect/<?php echo $idProyecto; ?>">Eliminar</a>
                        <?php echo "</div>";
                    }
                echo "</article>";
            }
        } else {
            echo "<p>No se encontró información de los proyectos.</p>";
        }
        ?>
    </article>

    <h1>Redes Sociales</h1>
    <?php
    if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $usuario['id'] && empty($id)) {
    ?>
    <div class="div-añadir">
        <a class="añadir-boton" onclick="mostrarFormulario('addRedSocial')">Añadir Red Social</a>
    </div>
    <?php
    }
    ?>
    <article class="article-full">
        <?php
        if (empty($id)) {
            $redes_sociales = $data['usuario'][0]["redes"];
        }else{
            $redes_sociales = $data['usuario'][0]["redesV"];
        }
        if (!empty($redes_sociales)) {
            foreach ($redes_sociales as $redesSociales) {
                $idRedSocial = $redesSociales['id'];
                echo "<article class='article'>";
                    echo "<p> Red Social: " . $redesSociales["redes_socialescol"] . "</p>";
                    echo "<p> URL: <a href='". $redesSociales["url"] ."'>" . $redesSociales["url"] . "</a></p>";
                    if($_SESSION['usuario']['auth'] == true && $_SESSION["usuario"]["id"] == $redesSociales["usuarios_id"] && empty($id)) {
                        echo "<div class='button-container'>";
                        if($redesSociales["visible"] == 0) {
                            echo "<a href='/mostrarRedSocial/$idRedSocial'>Mostrar Proyecto</a>";
                        } else {
                            echo "<a href='/mostrarRedSocial/$idRedSocial'>Ocultar Proyecto</a>";
                        }?>
                            <a onclick="mostrarFormularioEditar('editRedSocial', 'editRedSocialForm', <?php echo $idRedSocial ?>)">Editar</a>
                            <a href="/deleteRedSocial/<?php echo $idRedSocial; ?>">Eliminar</a>
                        <?php echo "</div>";
                    }
                echo "</article>";
            }
        } else {
            echo "<p>No se encontró información de las Redes Sociales.</p>";
        }
        ?>
    </article>
</body>