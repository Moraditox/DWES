<?php
    /**
     * 
     * Formulario para crear un currículum que incluya: Campos de texto, grupo de
     * botones de opción, casilla de verificación, lista de selección única, lista de
     * selección múltiple, botón de validación, botón de imagen, botón de reset, etc.
     * 
     * Fecha -> 15/10/2024
     * @author Héctor Mora Sánchez
    */
    
    $lProcesaFormulario = false;

    if(isset($_POST['restablecer'])){
        $nombre = "";
        $apellidos = "";
        $email = "";
        $genero = "";
        $habilidades = [];
        $educacion = "";
        $idiomas = [];
        $experiencia = "";
        $foto = "";
        $mensaje_foto = "";
    }else if(isset($_POST['enviar'])){
        $lProcesaFormulario = true;
    }

    if($lProcesaFormulario){
        if(isset($_POST["nombre"])){
            $nombre = $_POST["nombre"];
        }else{
            $lProcesaFormulario = false;
        }

        if(isset($_POST["apellidos"])){
            $apellidos = $_POST["apellidos"];
        }else{
            $lProcesaFormulario = false;
        }

        if(isset($_POST["email"])){
            $email = $_POST["email"];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $lProcesaFormulario = false;
                $email = "";
            }
        }else{
            $lProcesaFormulario = false;
        }

        if(isset($_POST["sexo"])){
            $genero = $_POST["sexo"];
        }else{
            $lProcesaFormulario = false;
        }

        if(isset($_POST["habilidades"])){
            $habilidades = $_POST['habilidades'] ? $_POST['habilidades'] : [];
        }else{
            $lProcesaFormulario = false;
        }
        
        if(isset($_POST["educacion"])){
            $educacion = $_POST["educacion"];
        }else{
            $lProcesaFormulario = false;
        }
        
        if(isset($_POST["idiomas"])){
            $idiomas = $_POST['idiomas'] ? $_POST['idiomas'] : [];
        }else{
            $lProcesaFormulario = false;
        }

        if(isset($_POST["experiencia"])){
            $experiencia = $_POST['experiencia'];
        }else{
            $lProcesaFormulario = false;
        }
        
        if(isset($_POST["foto"])){
            if ($_FILES['foto']['error'] == 0) {
                $foto = $_FILES['foto'];
                $ruta_destino = 'uploads/' . $foto['name'];
                move_uploaded_file($foto['tmp_name'], $ruta_destino);
                $mensaje_foto = "Foto subida correctamente.";
            } else {
                $mensaje_foto = "No se ha subido ninguna foto.";
            }
        }else{
            $lProcesaFormulario = false;
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Formularios</title>
</head>
<body>
    <?php
        if($lProcesaFormulario){
            echo "<h1>Datos del Formulario</h1>";
            echo "Nombre: $nombre <br/>";
            echo "Apellidos: $apellidos <br/>";
            echo "Email: $email <br/>";
            echo "Genero: $genero <br/>";
            echo "Habilidades: ". implode(", ", $habilidades) ."<br/>";
            echo "Educación: $educacion <br/>";
            echo "Idiomas: ". implode(", ", $idiomas) ."<br/>";
            echo "Experiencia Laboral: $experiencia <br/>";
            echo "Foto: $mensaje_foto <br/>";
        }else{
    ?>
    <h1>Currículum</h1>
    <form action="" method="POST">
        <label>Datos Personales:</label><br/>
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre ?>"/><br/>
        <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidos ?>"/><br/>
        <input type="text" name="email" placeholder="Email" value="<?php echo $email ?>"/><br/>

        <br/><label>Género:</label><br/>
        <input type="radio" name="sexo" id="masculino" value="Masculino" <?php echo ($genero  == "Masculino") ? 'checked' : ''; ?>><label for="masculino">Masculino</label>
        <input type="radio" name="sexo" id="otro" value="Otro" <?php echo ($genero  == "Otro") ? 'checked' : ''; ?>><label for="otro">Otro</label><br/>
        <input type="radio" name="sexo" id="Femenino" value="Femenino" <?php echo ($genero  == "Femenino") ? 'checked' : ''; ?>><label for="femenino">Femenino</label><br/>

        <br/><label>Habilidades:</label><br/>
        <input type="checkbox" id="html" name="habilidades[]" value="HTML" <?php echo (isset($habilidades) && in_array("HTML", $habilidades)) ? 'checked' : ''; ?>><label for="html">HTML</label>
        <input type="checkbox" id="css" name="habilidades[]" value="CSS" <?php echo (isset($habilidades) && in_array("CSS", $habilidades)) ? 'checked' : ''; ?>><label for="css">CSS</label><br/>
        <input type="checkbox" id="js" name="habilidades[]" value="JavaScript" <?php echo (isset($habilidades) && in_array("JavaScript", $habilidades)) ? 'checked' : ''; ?>><label for="js">JavaScript</label>
        <input type="checkbox" id="python" name="habilidades[]" value="Python" <?php echo (isset($habilidades) && in_array("Python", $habilidades)) ? 'checked' : ''; ?>><label for="python">Python</label><br/>

        <br/><label for="educacion">Nivel de Educación:</label><br/>
        <select id="educacion" name="educacion">
            <option value="Bachillerato" <?php echo ($educacion == "Bachillerato") ? 'selected' : ''; ?>>Bachillerato</option>
            <option value="Tecnico" <?php echo ($educacion == "Tecnico") ? 'selected' : ''; ?>>Técnico</option>
            <option value="Carrera" <?php echo ($educacion == "Carrera") ? 'selected' : ''; ?>>Carrera</option>
            <option value="Master" <?php echo ($educacion == "Master") ? 'selected' : ''; ?>>Master</option>
            <option value="Doctorado" <?php echo ($educacion == "Doctorado") ? 'selected' : ''; ?>>Doctorado</option>
        </select><br/>

        <br/><label for="idiomas">Idiomas:</label><br/>
        <select id="idiomas" name="idiomas[]" multiple>
            <option value="Español" <?php echo (isset($idiomas) && in_array('Español', $idiomas)) ? 'selected' : ''; ?>>Español</option>
            <option value="Ingles" <?php echo (isset($idiomas) && in_array('Ingles', $idiomas)) ? 'selected' : ''; ?>>Inglés</option>
            <option value="Frances" <?php echo (isset($idiomas) && in_array('Frances', $idiomas)) ? 'selected' : ''; ?>>Francés</option>
            <option value="Aleman" <?php echo (isset($idiomas) && in_array('Aleman', $idiomas)) ? 'selected' : ''; ?>>Alemán</option>
            <option value="Chino" <?php echo (isset($idiomas) && in_array('Chino', $idiomas)) ? 'selected' : ''; ?>>Chino</option>
        </select><br/>

        <br/><label for="experiencia">Experiencia Laboral:</label><br/>
        <textarea id="experiencia" name="experiencia" rows="4" value="<?php echo isset($experiencia) ? $experiencia : ''; ?>"></textarea><br/>

        <br/><label for="foto">Subir Foto:</label><br/>
        <input type="file" id="foto" name="foto" accept="image/*"><br/>

        <br/><input type="submit" name="enviar" value="Enviar">
        <input type="reset" name="restablecer" value="Restablecer">
    </form>
    <?php
        }
    ?>
</body>
</html>