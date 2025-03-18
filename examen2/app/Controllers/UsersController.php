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
use App\Models\Usuarios;
use App\Models\Multas;

class UsersController extends BaseController {
    //Metodo para loguear al usuario
    public function LoginUser(){
        $lprocesaFormulario = false;
        $data = array();
        $data['usuario'] = $data["password"] = $data['capcha'] = $data['multas'] = "";

        if (isset($_POST["login"])) {
            // Saneamos las entradas antes de utilizarlas
            $data["usuario"] = clearData($_POST["usuario"]);
            $data["password"] = clearData($_POST["password"]);
            $data['capcha'] = $_POST['capcha'];

            $lprocesaFormulario = true;

            // Validamos que el campo nombre no esté vacío
            if (empty($data['usuario']) || empty($data['password'])) {
                $lprocesaFormulario = false;
                $mesajeError = "Todos los campos son obligatorios";
                $_SESSION["mensaje"] = ["texto" => $mesajeError];
                header('Location: /');
            }

            if (empty($data['capcha']) || $data['capcha'] != $_COOKIE['capcha']) {
                $lprocesaFormulario = false;
                $mesajeError = "No has puesto bien el Capcha";
                $_SESSION["mensaje"] = ["texto" => $mesajeError];
                header('Location: /');
            }
        }

        if ($lprocesaFormulario) {
            //Comprobar que el usuario existe en la base de datos
            setcookie("capcha", "");
            $objUsuario = Usuarios::getInstancia();
            $objMultas = Multas::getInstancia();
            $objUsuario->setUsuario($data['usuario']);
            $objUsuario->setPassword($data['password']);
            $usuario = $objUsuario->getUsuarioByUser();
            if($usuario){
                $data['multas'] = $objMultas->getMultasIdConductor($usuario['id']);
                $_SESSION["user"] = ["id" => $usuario["id"], "perfil" => $usuario['perfil']];
                $_SESSION["datos"] = [$data];
                header('Location: /');
            }
        }
    }

    public function CerrarSesion(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }

    public function MultasConductor(){
        $this->renderHTML('../app/views/multas_view.php');
    }

    public function PagarMultas(){
        $this->renderHTML('../app/views/pagarMultas_view.php');
    }
}