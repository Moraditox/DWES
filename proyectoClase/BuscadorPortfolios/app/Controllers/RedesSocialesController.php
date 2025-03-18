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
use App\Models\RedesSociales;

class RedesSocialesController extends BaseController {

    public function AddRedSocial()
    {
        $lprocesaFormulario = false;
        $data = [];
        $data['nombreSocial'] = $data["url"] = $data["visible"] = $data["usuario_id"] = '';

        if(isset($_POST["add_redSocial"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["nombreSocial"] = clearData($_POST["nombreSocial"]);
            $data["url"] = clearData($_POST["url"]);
            $data["visible"] = $_POST["visible"];
            $data["usuario_id"] = $_SESSION["usuario"]["id"];

            $lprocesaFormulario = true;

            //Validamos que el campo nombre no esté vacío
            if (empty($data["nombreSocial"]) || empty($data["url"]) || empty($data['visible']) || empty($data["usuario_id"])) {
                $lprocesaFormulario = false;
                $mesajeError = "Fallo al añadir una red social nueva";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                header('Location: /perfil');
                exit();
            }
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            $objRedSocial = RedesSociales::getInstancia();
            if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
                $mensajeError = "No puedes añadir una red social que no es tuya";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objRedSocial->setRedSocial($data["nombreSocial"]);
            $objRedSocial->setUrl($data["url"]);
            $objRedSocial->setUsuariosId($data["usuario_id"]);
            $objRedSocial->setVisible($data["visible"]);
            $objRedSocial->set();
            $mensajeExito = "Red Social añadida con exito";
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
            header('Location: /perfil');
        }
    }

    public function EditRedSocial()
    {
        $lprocesaFormulario = false;
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data = [];
        $data['nombreSocial'] = $data["url"] = $data["visible"] = $data["usuario_id"] = '';

        if(isset($_POST["editar_redSocial"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["nombreSocial"] = clearData($_POST["nombreSocial"]);
            $data["url"] = clearData($_POST["url"]);
            $data["visible"] = $_POST["visible"];
            $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

            $lprocesaFormulario = true;
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            $objRedSocial = RedesSociales::getInstancia();
            if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
                $mensajeError = "No puedes editar una red social que no es tuya";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objRedSocial->setId($id);
            $objRedSocial->setRedSocial($data["nombreSocial"]);
            $objRedSocial->setUrl($data["url"]);
            $objRedSocial->setVisible($data["visible"]);
            $objRedSocial->edit();
            if($objRedSocial){
                $mensajeExito = "Red Social editada con exito";
                $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
                header('Location: /perfil');
            }else {
                $mensajeExito = "Red Social no editada por error";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeExito];
                header('Location: /perfil');
            }
        }
    }

    public function DeleteRedSocial()
    {
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

        //Guardar el usuario en la base de datos
        $objRedSocial = RedesSociales::getInstancia();
        if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
            $mensajeError = "No puedes eliminar una red social que no es tuya";
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
            header('Location: /');
            exit();
        }
        $objRedSocial->setId($id);
        $objRedSocial->delete();
        $mensajeExito = "Red Social eliminada con exito";
        $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
        header('Location: /perfil');
    }

    public function MostrarRedSocial()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        //Obtenemos el trabajo y vemos si esta oculto o no
        $objTrabajo = RedesSociales::getInstancia();
        $objTrabajo->setId($id);
        $objTrabajo->getRedSocialVisible();
        header('Location: /perfil');
    }
}