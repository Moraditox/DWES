<?php
/**
 *
 * Archvio de la clase UsuariosController
 *  
 * @autor Héctor Mora Sánchez
 * @date 2025-05-10
*/
namespace App\Controllers;

require_once "../app/Lib/function.php";
use App\Models\Skills;

class SkillsController extends BaseController {

    public function AddSkill()
    {
        $lprocesaFormulario = false;
        $data = array();
        $data['habilidades'] = $data["categorias_skills_categorias"] = $data['visible'] = $data["usuario_id"] = '';

        if(isset($_POST["add_skill"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["habilidades"] = clearData($_POST["habilidades"]);
            $data["categorias_skills_categorias"] = $_POST["categorias_skills_categorias"];
            $data['visible'] = $_POST["visible"];
            $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

            $lprocesaFormulario = true;

            //Validamos que el campo nombre no esté vacío
            if (empty($data["habilidades"]) || empty($data["categorias_skills_categorias"]) || empty($data["usuario_id"])) {
                $lprocesaFormulario = false;
                $mesajeError = "Fallo al añadir una skill nueva";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                header('Location: /perfil');
                exit();
            }
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            $objSkill = Skills::getInstancia();
            if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
                $mensajeError = "No puedes añadir una skill que no es tuya";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objSkill->setHabilidades($data['habilidades']);
            $objSkill->setCategorias($data['categorias_skills_categorias']);
            $objSkill->setVisibles($data['visible']);
            $objSkill->setUsuariosId($data['usuario_id']);
            $objSkill->set();
            $mensajeExito = "Skill añadida con exito";
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
            header('Location: /perfil');
        }
    }

    public function EditSkill()
    {
        $lprocesaFormulario = false;
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data = array();
        $data['habilidades'] = $data['categorias_skills_categorias'] = '';

        if(isset($_POST["editar_skill"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["habilidades"] = clearData($_POST["habilidades"]);
            $data["categorias_skills_categorias"] = $_POST["categorias_skills_categorias"];
            $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

            $lprocesaFormulario = true;
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            $objSkill = Skills::getInstancia();
            if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
                $mensajeError = "No puedes editar una skill que no es tuya";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objSkill->setId($id);
            $objSkill->setHabilidades($data["habilidades"]);
            $objSkill->setCategorias($data["categorias_skills_categorias"]);
            $objSkill->edit();
            if($objSkill){
                $mensajeExito = "Sillk editado con exito";
                $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
                header('Location: /perfil');
            }else {
                $mensajeExito = "Sillk no editada por error";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeExito];
                header('Location: /perfil');
            }
        }
    }

    public function DeleteSkill()
    {
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

        //Guardar el usuario en la base de datos
        $objSkill = Skills::getInstancia();
        if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
            $mensajeError = "No puedes eliminar una skill que no es tuya";
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
            header('Location: /');
            exit();
        }
        $objSkill->setId($id);
        $objSkill->delete();
        $mensajeExito = "Skill eliminada con exito";
        $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
        header('Location: /perfil');
    }

    public function MostrarSkill()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        //Obtenemos el trabajo y vemos si esta oculto o no
        $objSkill = Skills::getInstancia();
        $objSkill->setId($id);
        $objSkill->getSkillVisible();
        header('Location: /perfil');
    }
}