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

class UsuariosController extends BaseController
{
    public function IndexAction()
    {
        //Creamos una instancia de usuarios
        $usuario = Usuarios::getInstancia();

        //Alamacenamos los datos en $data
        $data['usuarios'] = $usuario->getAll();
        $data['usuariosV'] = $usuario->getVisibles();

        //Llamamos a la función renderHTML
        $this->renderHTML('..\app\Views\index_view.php', $data);
    }

    public function PerfilesAction()
    {
        //Creamos una instancia de usuarios
        $usuario = Usuarios::getInstancia();

        //Alamacenamos los datos en $data
        $data['usuario'] = $usuario->getAll();

        //Llamamos a la función renderHTML
        $this->renderHTML('..\app\Views\perfil_view.php', $data);
    }

    public function PerfilesPublicAction()
    {
        //Creamos una instancia de usuarios
        $usuario = Usuarios::getInstancia();

        //Alamacenamos los datos en $data
        $data['usuario'] = $usuario->getAll();

        //Llamamos a la función renderHTML
        $this->renderHTML('..\app\Views\perfil_public_view.php', $data);
    }

    //Metodo para registrar al usuario
    public function AddUser()
    {
        $lprocesaFormulario = false;
        $data = [];
        $data['nombre'] = $data['apellidos'] = $data['foto'] = $data["cat_profe"] = $data["email"] = $data["contrasena"] = $data["verifiContrasena"] ='';

        if(isset($_POST["registro"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["nombre"] = clearData($_POST["nombre"]);
            $data["apellidos"] = clearData($_POST["apellidos"]);
            if($_POST["foto"] == ""){
                $data["foto"] = "User-icon.png";
            }else{
                $data["foto"] = clearData($_POST["foto"]);
            }
            $data["cat_profe"] = clearData($_POST["cat_profe"]);
            $data["email"] = clearData($_POST["email"]);
            $data["contrasena"] = clearData($_POST["contrasena"]);
            $data["verifiContrasena"] = clearData($_POST["verifiContrasena"]);

            $lprocesaFormulario = true;

            //Validamos que el campo nombre no esté vacío
            if (empty($data['nombre']) || empty($data['apellidos']) || empty($data['cat_profe']) || empty($data['email']) || empty($data['contrasena']) || empty($data['verifiContrasena'])) {
                $lprocesaFormulario = false;
                $mesajeError = "Fallo en el registro del usuario, rellena todos los campos";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                $_SESSION["registro"] = $data;
                header('Location: /');
                exit();
            }
        }

        if ($lprocesaFormulario) {
            //Generar token y fecha de creación
            $rb = random_bytes(32);
            $token = base64_encode($rb);
            $secureToken = uniqid('', true) . $token;
            $fecha_creacion_token = date('Y-m-d H:i:s');

            if($data['contrasena'] != $data['verifiContrasena']){
                $mesajeError = "Las contraseñas no coinciden";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                $_SESSION["registro"] = $data;
                header('Location: /');
                exit();
            }
            $_SESSION["registro"] = [];
            //Guardar el usuario en la base de datos
            $objUsuario = Usuarios::getInstancia();
            $objUsuario->setNombre($data['nombre']);
            $objUsuario->setApellidos($data['apellidos']);
            $objUsuario->setCategoriaProfesional($data['cat_profe']);
            $objUsuario->setEmail($data['email']);
            $objUsuario->setFoto($data['foto']);
            $objUsuario->setPassword($data['contrasena']);
            $objUsuario->setToken($secureToken);
            $objUsuario->setFechaCreacionToken($fecha_creacion_token);
            $objUsuario->set();
            $objUsuario->enviarCorreoActivacion();
            $mensajeExito = "Usuario registrado con exito";
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
            header('Location: /');
        }
    }

    //Metodo para loguear al usuario
    public function LoginUser(){
        $lprocesaFormulario = false;
        $data = array();
        $data['email'] = $data["contrasena"] = $data["foto"] = "";

        if (isset($_POST["login"])) {
            // Saneamos las entradas antes de utilizarlas
            $data["email"] = clearData($_POST["email"]);
            $data["contrasena"] = clearData($_POST["contrasena"]);

            $lprocesaFormulario = true;

            // Validamos que el campo nombre no esté vacío
            if (empty($data['email']) || empty($data['contrasena'])) {
                $lprocesaFormulario = false;
                $mesajeError = "Todos los campos son obligatorios";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                header('Location: /');
            }
        }

        if ($lprocesaFormulario) {
            //Comprobar que el usuario existe en la base de datos
            $objUsuario = Usuarios::getInstancia();
            $objUsuario->setEmail($data['email']);
            $objUsuario->setPassword($data['contrasena']);
            $usuario = $objUsuario->get();
            if($usuario){
                $_SESSION["usuario"] = ["id" => $usuario["id"], "auth" => true, "nombre" => $usuario['nombre'], "foto" => $usuario['foto']];
                $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => "Inicio de sesión completado"];
                header('Location: /');
            }else{
                if(!$objUsuario->getCuentaActiva()){
                    $mesajeError = "Tienes que activar la cuenta primero. Mira tu correo";
                    $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                    header('Location: /');
                }else{
                    $mesajeError = "Usuario o contraseña incorrectos";
                    $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                    header('Location: /');
                }
            }
        }
    }

    public function EditUsuario(){
        $lprocesaFormulario = false;
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);
        $data = [];
        $data['nombre'] = $data['apellidos'] = $data['foto'] = $data["cat_profe"] = $data["email"] = '';

        if(isset($_POST["editar_Usuario"])) {
            //Saneamos las entradas antes de utilizarlas
            $data["nombre"] = clearData($_POST["nombre"]);
            $data["apellidos"] = clearData($_POST["apellidos"]);
            if($_POST["foto"] == ""){
                $data["foto"] = "User-icon.png";
            }else{
                $data["foto"] = clearData($_POST["foto"]);
            }
            $data["cat_profe"] = clearData($_POST["cat_profe"]);
            $data["email"] = clearData($_POST["email"]);

            //Validamos que el campo nombre no esté vacío
            if (empty($data['nombre']) || empty($data['apellidos']) || empty($data['cat_profe']) || empty($data['email'])) {
                $lprocesaFormulario = false;
                $mesajeError = "Fallo en el registro del usuario, rellena todos los campos";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                $_SESSION["registro"] = $data;
                header('Location: /');
                exit();
            }

            $lprocesaFormulario = true;
        }

        if ($lprocesaFormulario) {
            //Guardar el usuario en la base de datos
            if($_SESSION["usuario"]["id"] != $id) {
                $mensajeError = "No puedes editar un usuario que no seas tu";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
                header('Location: /');
                exit();
            }
            $objUsuario = Usuarios::getInstancia();
            $objUsuario->setId($id);
            $objUsuario->setNombre($data['nombre']);
            $objUsuario->setApellidos($data['apellidos']);
            $objUsuario->setCategoriaProfesional($data['cat_profe']);
            $objUsuario->setEmail($data['email']);
            $objUsuario->setFoto($data['foto']);
            $objUsuario->edit();
            if($objUsuario){
                $mensajeExito = "Usuario editado con exito";
                $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
                header('Location: /perfil');
            }else {
                $mensajeExito = "Red Social no editada por error";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeExito];
                header('Location: /perfil');
            }
        }
    }

    public function DeleteUser(){
        $url = explode('/', ($_SERVER['REQUEST_URI']));
        $id = end($url);

        //Guardar el usuario en la base de datos
        $objUsuario = Usuarios::getInstancia();
        if($_SESSION["usuario"]["id"] != $id) {
            $mensajeError = "No puedes eliminar un trabajo que no es tuyo";
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mensajeError];
            header('Location: /');
            exit();
        }
        $objUsuario->setId($id);
        $objUsuario->delete();
        $_SESSION["usuario"] = ["auth" => false, "nombre" => "invitado", "foto" => "User-icon.jpg"];
        $mensajeExito = "usuario eliminado con exito";
        $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mensajeExito];
        header('Location: /');
    }

    //Método para verificar el token de activación
    public function verificarAction()
    {
        $usuario = Usuarios::getInstancia();
        $usuario->verificarToken();
        if ($usuario){
            header('Location: /'); //Redirige a la página principal
            exit;
        } else {;
            header('Location: /'); //Si falla, redirige al home
            exit;
        }
    }

    //Metodo para mostrar el usuario
    public function MostrarUsuario()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        //Obtenemos el trabajo y vemos si esta oculto o no
        $objTrabajo = Usuarios::getInstancia();
        $objTrabajo->setId($id);
        $objTrabajo->getUserVisible();
        header('Location: /perfil');
    }
}