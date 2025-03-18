<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\Multas;

class UsuarioController extends BaseController
{
    // Muestra la lista de usuarios (o lo que necesites en tu página de inicio)
    public function indexAction()
    {
        // Verificamos si hay una sesión iniciada
        if (!isset($_SESSION['user_id'])) {
            // Si no hay sesión, redirigimos al login
            header('Location: /usuarios/login');
            exit();
        }

        // Instancia de multas
        $multas = Multas::getInstancia();
        $usuario = Usuarios::getInstancia();
        $perfil_usuario_conductor = $usuario->getConductores($_SESSION['user_id']);
        $perfil_usuario_agente = $usuario->getAgentes($_SESSION['user_id']);
        $data = [];

        if (!empty($perfil_usuario_conductor)) {
            // Obtener multas del conductor
            $data['multasConductor'] = $multas->getMultasByConductor($perfil_usuario_conductor['id']);
        } elseif (!empty($perfil_usuario_agente)) {
            // Obtener multas registradas por el agente
            $data['multasAgente'] = $multas->getMultasByAgente($perfil_usuario_agente['id']);
        }

        // if($_SESSION['perfil_usuario'] == 'admin'){
        //     $data['conductores'] = $usuario->getAllConductores();

        //     // Para cada conductor, obtenemos los puntos y el número de sanciones
        //     foreach ($data['conductores'] as &$conductor) {
        //         $multas = Multas::getInstancia();
        //         $multasDelConductor = $multas->getMultasByConductor($conductor['id']);
        //         $conductor['puntos'] = count($multasDelConductor);
        //         $conductor['num_sanciones'] = count($multasDelConductor);
        //     }
        // }

        // Renderizamos la vista con los datos obtenidos
        $this->renderHTML('../app/views/index_view.php', $data);
    }

    // Manejo de login
    public function loginAction()
    {
        // Inicializamos datos
        $data = [];
        $data['usuario'] = $data['password'] = '';
        $data['errorUsuario'] = $data['errorPassword'] = $data['errorCaptcha'] = '';
        $data['captcha'] = '';
        $captcha = ['Coche', 'Peaton', 'Semaforo'];
        if (!isset($_SESSION['captcha'])) {
            $data['captcha'] = $captcha[rand(0, 2)];
            $_SESSION['captcha'] = $data['captcha'];
        }

        // Si nos llega algo por POST, procesamos el formulario
        if (!empty($_POST)) {
            $data['usuario'] = $_POST['usuario'] ?? '';
            $data['password'] = $_POST['password'] ?? '';
            $data['captcha'] = $_POST['captcha'] ?? '';

            if (empty($data['usuario'])) {
                $data['errorUsuario'] = 'El usuario es obligatorio';
            }

            if (empty($data['password'])) {
                $data['errorPassword'] = 'La contraseña es obligatoria';
            }

            // Verificación del captcha
            if ($data['captcha'] != $_SESSION['captcha']) {
                $data['errorCaptcha'] = 'Captcha incorrecto';
            }

            // Si no hay errores, buscamos el usuario en la BD
            if (empty($data['errorUsuario']) && empty($data['errorPassword']) && empty($data['errorCaptcha'])) {
                $usuarioModel = Usuarios::getInstancia();
                $usuarioModel->setUsuario($data['usuario']);
                $usuarioModel->setPassword($data['password']);
                $user = $usuarioModel->login();


                // Comparación de la contraseña en texto plano (ojo, no es seguro)
                if (is_array($user) && $user['password'] === $data['password']) {
                    
                    // Éxito: guardamos datos en la sesión
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nombre'];

                    // Redirigimos al inicio
                    header('Location: /');
                    exit;
                } else {
                    $data['errorPassword'] = 'Usuario o contraseña incorrectos';
                }
            }
        }

        // Si hay errores o es la primera vez, mostramos la vista del login
        $this->renderHTML('../app/views/login_view.php', $data);
    }

    public function registerAction()
    {
        $lprocesaFormulario = false;
        $data = [];
        $data['usuario'] = $data['nombre'] = $data['password'] = $data['password_confirmation'] = '';
        $data['errorUsuario'] = $data['errorNombre'] = $data['errorPassword'] = $data['errorPassword_confirmation'] = '';

        if (!empty($_POST)) {
            // Saneamos las entradas antes de utilizarlas
            $data['usuario'] = trim($_POST['usuario']);
            $data['nombre'] = trim($_POST['nombre']);
            $data['password'] = trim($_POST['password']);
            $data['password_confirmation'] = trim($_POST['password_confirmation']);
            
            $usuarioModel = Usuarios::getInstancia();
            $lprocesaFormulario = true;

            // Validación de campos
            if (empty($data['usuario'])) {
                $lprocesaFormulario = false;
                $data['errorUsuario'] = 'El nombre de usuario es obligatorio';
            } elseif ($usuarioModel->getByUsuario($data['usuario'])) {
                $lprocesaFormulario = false;
                $data['errorUsuario'] = 'El nombre de usuario ya está registrado';
            }

            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['errorNombre'] = 'El nombre es obligatorio';
            }

            if (empty($data['password'])) {
                $lprocesaFormulario = false;
                $data['errorPassword'] = 'La contraseña es obligatoria';
            }

            if ($data['password'] !== $data['password_confirmation']) {
                $lprocesaFormulario = false;
                $data['errorPassword_confirmation'] = 'Las contraseñas no coinciden';
            }
        }

        if ($lprocesaFormulario) {
            // Hasheamos la contraseña
    
            // Guardamos el usuario en la base de datos
            $usuarioModel->setUsuario($data['usuario']);
            $usuarioModel->setNombre($data['nombre']);
            $usuarioModel->setPassword($data['password']);
            $usuarioModel->setPerfil('conductor'); // Perfil por defecto
            $usuarioModel->set();

            // Redirigir al inicio después del registro exitoso
            header('Location: /usuarios/login');
            exit();
        } else {
            $this->renderHTML('../app/views/register_view.php', $data);
        }
    }

    // Manejo del logout
    public function logoutAction()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }
}
