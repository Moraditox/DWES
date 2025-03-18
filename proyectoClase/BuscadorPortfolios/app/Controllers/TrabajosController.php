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
use App\Models\Trabajos;

class TrabajosController extends BaseController
{
    public function AddJob()
    {
        $lprocesaFormulario = false;
        $data = [];
        $data['titulo'] = $data['descripcion'] = $data['fecha_inicio'] = $data["fecha_final"] = $data["logros"] = $data["visible"] = $data["usuario_id"] = '';

        if(isset($_POST["add_trabajo"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["titulo"] = clearData($_POST["titulo"]);
            $data["descripcion"] = clearData($_POST["descripcion"]);
            $data["fecha_inicio"] = clearData($_POST["fecha_inicio"]);
            $data["fecha_final"] = clearData($_POST["fecha_final"]);
            $data["logros"] = clearData($_POST["logros"]);
            $data['visible'] = $_POST["visible"];
            $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

            $lprocesaFormulario = true;

            //Validamos que los campos no estén vacíos
            if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['fecha_inicio']) || empty($data['fecha_final']) || empty($data['usuario_id'])) {
                $lprocesaFormulario = false;
                $mesajeError = "Fallo en el registro del trabajo";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                header('Location: /perfil');
                exit();
            }
        }

        if ($lprocesaFormulario) {
            //Guardar el trabajo en la base de datos
            $objTrabajo = Trabajos::getInstancia();
            if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
                $mensajeError = "No puedes añadir un trabajo que no es tuyo";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objTrabajo->setTitulo($data["titulo"]);
            $objTrabajo->setDescripcion($data["descripcion"]);
            $objTrabajo->setFechaInicio($data["fecha_inicio"]);
            $objTrabajo->setFechaFinal($data["fecha_final"]);
            $objTrabajo->setVisible($data['visible']);
            $objTrabajo->setLogros($data["logros"]);
            $objTrabajo->setUsuariosId($data["usuario_id"]);
            $objTrabajo->set();
            $mensajeExito = "Trabajo añadido con éxito";
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
            header('Location: /perfil');
        }
    }

    public function EditJob()
    {
        $lprocesaFormulario = false;
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);
        $data = array();
        $data['titulo'] = $data['descripcion'] = $data['fecha_inicio'] = $data["fecha_final"] = $data["logros"] = $data["usuario_id"] = '';

        if(isset($_POST["editar_trabajo"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["titulo"] = clearData($_POST["titulo"]);
            $data["descripcion"] = clearData($_POST["descripcion"]);
            $data["fecha_inicio"] = clearData($_POST["fecha_inicio"]);
            $data["fecha_final"] = clearData($_POST["fecha_final"]);
            $data["logros"] = clearData($_POST["logros"]);
            $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

            $lprocesaFormulario = true;
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            $objTrabajo = Trabajos::getInstancia();
            if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
                $mensajeError = "No puedes editar un trabajo que no es tuyo";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objTrabajo->setId($id);
            $objTrabajo->setTitulo($data["titulo"]);
            $objTrabajo->setDescripcion($data["descripcion"]);
            $objTrabajo->setFechaInicio($data["fecha_inicio"]);
            $objTrabajo->setFechaFinal($data["fecha_final"]);
            $objTrabajo->setLogros($data["logros"]);
            $objTrabajo->edit();
            $mensajeExito = "Trabajo editado con exito";
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
            header('Location: /perfil');
        }
    }

    public function DeleteJob()
    {
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data["usuario_id"] = clearData($_SESSION["usuario"]["id"]);

        //Guardar el usuario en la base de datos
        $objTrabajo = Trabajos::getInstancia();
        if($_SESSION["usuario"]["id"] != $data["usuario_id"]) {
            $mensajeError = "No puedes eliminar un trabajo que no es tuyo";
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
            header('Location: /');
            exit();
        }
        $objTrabajo->setId($id);
        $objTrabajo->delete();
        $mensajeExito = "Trabajo eliminado con exito";
        $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
        header('Location: /perfil');
    }

    public function MostrarTrabajo()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        //Obtenemos el trabajo y vemos si esta oculto o no
        $objTrabajo = Trabajos::getInstancia();
        $objTrabajo->setId($id);
        $objTrabajo->getJobVisible();
        header('Location: /perfil');
    }
}