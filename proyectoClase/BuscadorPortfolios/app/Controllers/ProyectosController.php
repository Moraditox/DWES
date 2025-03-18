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
use App\Models\Proyectos;

class ProyectosController extends BaseController
{
    public function IndexAction()
    {
        //Creamos una instancia de usuarios
        $proyectos = Proyectos::getInstancia();

        //Alamacenamos los datos en $data
        $data['proyectos'] = $proyectos->getAll();

        //Llamamos a la función renderHTML
        $this->renderHTML('/perfil', $data['proyectos']);
    }

    public function AddProyect()
    {
        $lprocesaFormulario = false;
        $data = [];
        $data['titulo'] = $data["descripcion"] = $data["logo"] = $data["tecnologias"] = $data['visible'] = $data["usuario_id"] = '';

        if(isset($_POST["add_proyecto"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["titulo"] = clearData($_POST["titulo"]);
            $data["descripcion"] = clearData($_POST["descripcion"]);
            $data["logo"] = clearData($_POST["logo"]);
            $data["tecnologias"] = clearData($_POST["tecnologias"]);
            $data['visible'] = $_POST["visible"];
            $data["usuario_id"] = $_SESSION["usuario"]["id"];

            $lprocesaFormulario = true;

            //Validamos que el campo nombre no esté vacío
            if (empty($data["titulo"]) || empty($data["descripcion"]) || empty($data["logo"]) || empty($data["tecnologias"]) || empty($data["visible"]) || empty($data["usuario_id"])) {
                $lprocesaFormulario = false;
                $mesajeError = "Fallo al añadir el proyecto";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                header('Location: /perfil');
            }
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            $objProyecto = Proyectos::getInstancia();
            if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
                $mensajeError = "No puedes añadir un proyecto que no es tuyo";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objProyecto->setTitulo($data["titulo"]);
            $objProyecto->setDescripcion($data["descripcion"]);
            $objProyecto->setLogo($data["logo"]);
            $objProyecto->setVisible($data["visible"]);
            $objProyecto->setTecnologias($data["tecnologias"]);
            $objProyecto->setUsuariosId($data["usuario_id"]);
            $objProyecto->set();
            $mensajeExito = "Proyecto añadido con éxito";
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
            header('Location: /perfil');
        }
    }

    public function EditProyect()
    {
        $lprocesaFormulario = false;
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data = array();
        $data['titulo'] = $data["descripcion"] = $data["logo"] = $data["tecnologias"] = $data["usuario_id"] = '';

        if(isset($_POST["editar_trabajo"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["titulo"] = clearData($_POST["titulo"]);
            $data["descripcion"] = clearData($_POST["descripcion"]);
            $data["logo"] = clearData($_POST["logo"]);
            $data["tecnologias"] = clearData($_POST["tecnologias"]);
            $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

            $lprocesaFormulario = true;
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            $objProyecto = Proyectos::getInstancia();
            if($_SESSION["usuario"]["id"] !== $data["usuario_id"]) {
                $mensajeError = "No puedes editar un proyecto que no es tuyo";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objProyecto->setId($id);
            $objProyecto->setTitulo($data["titulo"]);
            $objProyecto->setDescripcion($data["descripcion"]);
            $objProyecto->setLogo($data["logo"]);
            $objProyecto->setTecnologias($data["tecnologias"]);
            $objProyecto->edit();
            if($objProyecto){
                $mensajeExito = "Proyecto editado con exito";
                $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
                header('Location: /perfil');
            }else {
                $mensajeExito = "Proyecto no editado por error";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeExito];
                header('Location: /perfil');
            }
        }
    }

    public function DeleteProyect()
    {
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

        //Guardar el usuario en la base de datos
        $objProyecto = Proyectos::getInstancia();
        if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
            $mensajeError = "No puedes eliminar un proyecto que no es tuyo";
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
            header('Location: /');
            exit();
        }
        $objProyecto->setId($id);
        $objProyecto->delete();
        $mensajeExito = "Proyecto eliminado con exito";
        $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
        header('Location: /perfil');
    }

    public function MostrarProyect()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        //Obtenemos el trabajo y vemos si esta oculto o no
        $objTrabajo = Proyectos::getInstancia();
        $objTrabajo->setId($id);
        $objTrabajo->getProyectsVisible();
        header('Location: /perfil');
    }
}