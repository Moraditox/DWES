<?php

session_start();

// Si no existe perfil_usuario, lo igualamos a "invitado"
$_SESSION['perfil_usuario'] = $_SESSION['perfil_usuario'] ?? "invitado";

// Requerimos lo necesario para cargar clases y el router
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\UsuarioController;
use App\Controllers\MultasController;
use App\Controllers\AdminController;

// Creamos el router
$router = new Router();


// ------------------
// Definición de rutas
// ------------------
$router->add([
    'name' => 'Inicio',
    'path' => '/^\/$/',
    'action' => [UsuarioController::class, 'indexAction']
]);

// Ruta para el registro de usuarios

$router->add([
    'name' => 'Registro de usuario',
    'path' => '/^\/usuarios\/register$/',
    'action' => [UsuarioController::class, 'registerAction'],
    // Sólo puede acceder un invitado (no logueado)
    'perfil' => ["invitado"]
]);

// Ruta para iniciar sesión
$router->add([
    'name' => 'Iniciar sesión de usuario',
    'path' => '/^\/usuarios\/login$/',
    'action' => [UsuarioController::class, 'loginAction'],
    // Sólo puede acceder un invitado (no logueado)
    'perfil' => ["invitado"]
]);

// Ruta para cerrar sesión
$router->add([
    'name' => 'Cerrar sesión de usuario',
    'path' => '/^\/usuarios\/logout$/',
    'action' => [UsuarioController::class, 'logoutAction'],
    // Aquí decimos que sólo pueden desloguearse los que estén en uno de estos perfiles
    'perfil' => ["admin","agente","conductor"]
]);

// Ruta para pagar la multa

$router->add([  
    'name' => 'multas',
    'path' => '/^\/multas\/pagar\/(\d+)$/',
    'action' => [MultasController::class, 'MultasAction'],
    'perfil' => ['conductor']
]);

// Ruta para nueva multa


$router->add([  
    'name' => 'nuevaMulta',
    'path' => '/^\/multas\/nuevaMulta\/$/',
    'action' => [MultasController::class, 'NuevaMultaAction'],
    'perfil' => ['agente']
]);


// Ruta para buscar conductores
$router->add([
    'name' => 'Buscar conductores',
    'path' => '/^\/conductores\/buscar$/',
    'action' => [AdminController::class, 'BuscarConductoresAction'],
    'perfil' => ['admin']
]);


// ------------------
// Lógica para despachar la ruta
// ------------------
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = $router->match($request);

if($route){
    // Si la ruta tiene perfiles restringidos y el actual no está en la lista, redirigimos
    if (isset($route['perfil']) && !in_array($_SESSION['perfil_usuario'], $route['perfil'])) {
        header("Location: /");
        exit();
    } else {
        // Llamamos al controlador/acción
        $controllerName = $route['action'][0];
        $actionName = $route['action'][1];
        $controller = new $controllerName;
        $controller->$actionName($request);
    }
}else{
    echo "No route";
}
?>

</body>
</html>
