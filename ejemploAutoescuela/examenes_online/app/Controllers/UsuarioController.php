<?php

namespace App\Controllers;

use App\Models\Usuarios;

class UsuarioController extends BaseController
{

    // Manejo de la página principal de la aplicación

    public function indexAction()
    {

        // Creamos una instancia de usuarios
        $usuario = Usuarios::getInstancia();


        // Alamacenamos los datos en $data
        $data['usuarios'] = $usuario->getAll();
        // Llamamos a la función renderHTML
        $this->renderHTML('../app/views/index_view.php', $data);
    }

    // Manejo de la creación de usuarios (registro)

    public function AddAction()
    {
        $lprocesaFormulario = false;
        $data = [];
        $data['nombre'] = $data['apellidos'] = $data['email'] = $data['password'] = $data['password_confirmation'] = $data['picture'] = '';
        $data['errorNombre'] = $data['errorApellidos'] = $data['errorEmail'] = $data['errorPassword'] = $data['errorPassword_confirmation'] = $data['errorPicture']  = $data['errorCaptcha'] = '';
        $data['picture'] = '/img/default.png';
        $data['visible'] = 1;
        $img = false;


        // Generar nuevo CAPTCHA solo si no existe en la sesión
        if (!isset($_SESSION['num1']) || !isset($_SESSION['num2'])) {
            $_SESSION['num1'] = rand(1, 10);
            $_SESSION['num2'] = rand(1, 10);
            $_SESSION['captcha'] = $_SESSION['num1'] + $_SESSION['num2'];
        }

        // Asigna los valores a los datos del formulario
        $data['num1'] = $_SESSION['num1'];
        $data['num2'] = $_SESSION['num2'];

        if (!empty($_POST)) {
            // Saneamos las entradas antes de utilizarlas
            $data['nombre'] = $_POST['nombre'];
            $data['apellidos'] = $_POST['apellidos'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['password_confirmation'] = $_POST['password_confirmation'];
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['name'] != '') {
                $data['picture'] = $_FILES['profile_picture'];
                // Comprobamos si se ha subido una imagen
                if ($data['picture']['error'] == 0) {
                    // Comprobamos si la imagen es de tipo jpeg o png
                    if ($data['picture']['type'] == 'image/jpeg' || $data['picture']['type'] == 'image/png') {
                        // Comprobamos si la imagen no supera los 2MB
                        if ($data['picture']['size'] <= 2000000) {
                            $img = true;
                        } else {
                            $lprocesaFormulario = false;
                            $data['errorPicture'] = 'La imagen no puede superar los 2MB';
                        }
                    } else {
                        $lprocesaFormulario = false;
                        $data['errorPicture'] = 'El archivo subido no es una imagen';
                    }
                }
            }

            // Creamos una instancia de usuarios
            $usuario = Usuarios::getInstancia();
            $lprocesaFormulario = true;

            // Validamos los campos del formulario

            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['errorNombre'] = 'El nombre es obligatorio';
            }

            if (empty($data['apellidos'])) {
                $lprocesaFormulario = false;
                $data['errorApellidos'] = 'Los apellidos son obligatorios';
            }

            if (empty($data['email'])) {
                $lprocesaFormulario = false;
                $data['errorEmail'] = 'El email es obligatorio';
            } elseif ($usuario->emailExists($data['email'])) {
                $lprocesaFormulario = false;
                $data['errorEmail'] = 'El email ya está registrado';
            }

            // Validamos que el campo password no esté vacío
            if (empty($data['password'])) {
                $lprocesaFormulario = false;
                $data['errorPassword'] = "* La contraseña no puede estar vacía";
            }

            // valida que el campo password_confirmation sea igual que password
            if ($data['password'] !== $data['password_confirmation']) {
                $lprocesaFormulario = false;
                $data['errorPassword_confirmation'] = "* Las contraseñas no coinciden";
            }

            if ($_POST['captcha'] != $_SESSION['captcha']) {
                $lprocesaFormulario = false;
                $data['errorCaptcha'] = "Captcha incorrecto";
            }
        }

        if ($lprocesaFormulario) {
            if ($img) {
                // Subo la imagen
                $nombre = $data['picture']['name'];
                // Obtengo la extensión
                $ext = explode('.', $nombre);
                $name = end($ext);
                // Generamos un nombre para la imagen al azar
                $data['picture']['name'] = uniqid() . '.' . $name;
                // Movemos la imagen a la carpeta de imágenes en public/img
                move_uploaded_file($data['picture']['tmp_name'], '../public/img/' . $data['picture']['name']);
            } else {
                // Movemos el archivo a la carpeta de imágenes en public/img
                move_uploaded_file($data['picture']['tmp_name'], '../public/img/' . $data['picture']);
            }

            // Generación de token

            // Generación de token
            $rb = random_bytes(32);
            $token = base64_encode($rb);
            $secureToken = uniqid("", true) . $token;

            // Fecha de creación del token
            $fechaCreacionToken = date('Y-m-d H:i:s');
            $usuario->setFechaCreacionToken($fechaCreacionToken);

            $fotografia = isset($data['picture']['name']) ? $data['picture']['name'] : $data['picture'];

            // Hasheamos la contraseña
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
            // Guardamos el usuario en la base de datos

            $usuario->setNombre($data['nombre']);
            $usuario->setApellidos($data['apellidos']);
            $usuario->setFoto($fotografia);
            $usuario->setEmail($data['email']);
            $usuario->setPassword($hashedPassword);
            $usuario->setToken($secureToken);
            $usuario->set();

            header('Location: ..');
        } else {
            $this->renderHTML('../app/views/register_view.php', $data);
        }
    }



    // Función para el login de usuarios

    public function loginAction()
    {
        $data = array();
        $data['email'] = $data['password'] = '';
        $data['errorEmail'] = $data['errorPassword'] = '';

        if (!empty($_POST)) {
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            // Creamos una instancia de usuarios
            $usuario = Usuarios::getInstancia();

            // Validamos los campos del formulario
            if (empty($data['email'])) {
                $data['errorEmail'] = 'El email es obligatorio';
            }
            // Validamos si el correo existe en la base de datos
            if (!$usuario->emailExists($data['email'])) {
                $data['errorEmail'] = "* El email no está registrado";
            }

            if (empty($data['password'])) {
                $data['errorPassword'] = 'La contraseña es obligatoria';
            }

            if (empty($data['errorEmail']) && empty($data['errorPassword'])) {
                // Creamos una instancia de usuarios
                $usuario = Usuarios::getInstancia();
                $user = $usuario->getUserProfile($data['email']);
                $id = $usuario->getIdByEmail($data['email']);
                if ($user && password_verify($data['password'], $user['password'])) {
                    // Iniciamos sesión
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user_name'] = $user['nombre'];
                    $_SESSION['perfil_usuario'] = "usuario"; // Actualizamos el perfil del usuario
                    $_SESSION['foto'] = $user['foto'];
                    $_SESSION['email'] = $user['email'];
                    header('Location: /');
                    exit;
                } else {
                    $data['errorPassword'] = 'Email o contraseña incorrectos';
                }
            }
        }

        $this->renderHTML('../app/views/login_view.php', $data);
    }

    public function logoutAction()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }





    // Función para actualizar el usuario
    // Función para actualizar el usuario
    public function updateAction()
    {
        if (empty($_SESSION['perfil_usuario']) || $_SESSION['perfil_usuario'] != "usuario") {
            header("Location: /");
            exit;
        }

        $usuario = Usuarios::getInstancia();
        $user = $usuario->get($_SESSION['user_id']);

        $data = [
            'nombre' => $user['nombre'],
            'apellidos' => $user['apellidos'],
            'email' => $user['email'],
            'password' => '',
            'password_confirmation' => '',
            'picture' => $user['foto'],
            'errorNombre' => '',
            'errorApellidos' => '',
            'errorEmail' => '',
            'errorPassword' => '',
            'errorPassword_confirmation' => '',
            'errorPicture' => ''
        ];

        if (!empty($_POST)) {
            // Saneamos las entradas antes de utilizarlas
            $data['nombre'] = $_POST['nombre'];
            $data['apellidos'] = $_POST['apellidos'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['password_confirmation'] = $_POST['password_confirmation'];
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['name'] != '') {
                $data['picture'] = $_FILES['profile_picture'];
                // Comprobamos si se ha subido una imagen
                if ($data['picture']['error'] == 0) {
                    // Comprobamos si la imagen es de tipo jpeg o png
                    if ($data['picture']['type'] == 'image/jpeg' || $data['picture']['type'] == 'image/png') {
                        // Comprobamos si la imagen no supera los 2MB
                        if ($data['picture']['size'] <= 2000000) {
                            $img = true;
                        } else {
                            $data['errorPicture'] = 'La imagen no puede superar los 2MB';
                        }
                    } else {
                        $data['errorPicture'] = 'El archivo subido no es una imagen';
                    }
                }
            }

            // Validamos los campos del formulario
            $lprocesaFormulario = true;

            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['errorNombre'] = 'El nombre es obligatorio';
            }

            if (empty($data['apellidos'])) {
                $lprocesaFormulario = false;
                $data['errorApellidos'] = 'Los apellidos son obligatorios';
            }

            if (empty($data['email'])) {
                $lprocesaFormulario = false;
                $data['errorEmail'] = 'El email es obligatorio';
            } elseif ($data['email'] != $user['email'] && $usuario->emailExists($data['email'])) {
                $lprocesaFormulario = false;
                $data['errorEmail'] = 'El email ya está registrado';
            }

            if (!empty($data['password']) && $data['password'] !== $data['password_confirmation']) {
                $lprocesaFormulario = false;
                $data['errorPassword_confirmation'] = "* Las contraseñas no coinciden";
            }

            if ($lprocesaFormulario) {
                if ($img) {
                    // Subo la imagen
                    $nombre = $data['picture']['name'];
                    // Obtengo la extensión
                    $ext = explode('.', $nombre);
                    $name = end($ext);
                    // Generamos un nombre para la imagen al azar
                    $data['picture']['name'] = uniqid() . '.' . $name;
                    // Movemos la imagen a la carpeta de imágenes en public/img
                    move_uploaded_file($data['picture']['tmp_name'], '../public/img/' . $data['picture']['name']);
                    $fotografia = $data['picture']['name'];
                } else {
                    $fotografia = $data['picture'];
                }

                // Hasheamos la contraseña si se ha proporcionado una nueva
                if (!empty($data['password'])) {
                    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                } else {
                    $hashedPassword = $user['password'];
                }

                // Actualizamos el usuario en la base de datos
                $usuario->setId($_SESSION['user_id']);
                $usuario->setNombre($data['nombre']);
                $usuario->setApellidos($data['apellidos']);
                $usuario->setFoto($fotografia);
                $usuario->setEmail($data['email']);
                $usuario->setPassword($hashedPassword);
                $usuario->edit();

                $_SESSION['foto'] = $fotografia;

                // Redirigir al inicio
                header('Location: /');
                exit();
            }
        }

        

        $this->renderHTML('../app/views/edit_view.php', $data);
    }


   

    
}
