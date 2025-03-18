<?php

session_start();

$_SESSION['perfil_usuario'] = $_SESSION['perfil_usuario'] ?? "invitado";
// requreimos el bootstrap y el autoload para la carga automatica de clases
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

// Usamos el espacio de nombre
use App\Core\Router;
use App\Controllers\UsuarioController;
use App\Controllers\ExamenesController;
use App\Controllers\NotasController;

// Creamos una instancia de la clase Router
$router = new Router();

// Añadimos rutas al array

// Ruta para todos los usuarios
$router->add([  
    'name' => 'Inicio',
    'path' => '/^\/$/',
    'action' => [UsuarioController::class, 'indexAction']
]);

// Ruta para añadir un usuario
$router->add([  'name' => 'Añadir usuario',
                'path' => '/^\/usuarios\/add$/',
                'action' => [UsuarioController::class, 'addAction'],
                'perfil' => ["invitado"]]);

// Ruta para loguearse un usuario
$router->add([  'name' => 'Iniciar sesión de usuario',
                'path' => '/^\/usuarios\/login$/',
                'action' => [UsuarioController::class, 'loginAction'],
                'perfil' => ["invitado"]]);

// Ruta para cerrar sesión
$router->add([  'name' => 'Cerrar sesión de usuario',
                'path' => '/^\/usuarios\/logout$/',
                'action' => [UsuarioController::class, 'logoutAction'],
                'perfil' => ["usuario"]]);

// Ruta para realizar un examen
$router->add([  'name' => 'Realizar examen',
                'path' => '/^\/examenes\/realizar$/',
                'action' => [ExamenesController::class, 'realizarExamenAction'],
                'perfil' => ["usuario"]]);

// Ruta para enviar un examen
$router->add([  'name' => 'Enviar examen',
                'path' => '/^\/examenes\/submit$/',
                'action' => [ExamenesController::class, 'submitExamenAction'],
                'perfil' => ["usuario"]]);

// Ruta para ver las notas
$router->add([  'name' => 'Ver notas',
                'path' => '/^\/notas$/',
                'action' => [NotasController::class, 'indexAction'],
                'perfil' => ["usuario"]]);

// Ruta para actualizar un usuario
$router->add([  'name' => 'Actualizar usuario',
                'path' => '/^\/usuarios\/update$/',
                'action' => [UsuarioController::class, 'updateAction'],
                'perfil' => ["usuario"]]);




// Esto limpia la ruta de la petición
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = $router->match($request);

if($route){
    if (isset($route['perfil']) && !in_array($_SESSION['perfil_usuario'], $route['perfil'])) {
        header("Location: /");
        exit();
    } else{
        $controllerName = $route['action'][0];
        $actionName = $route['action'][1];
        $controller = new $controllerName;
        $controller->$actionName($request);
    }
    
}else{
    echo "No route";
}