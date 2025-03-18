<?php
// requreimos el bootstrap y el autoload para la carga automatica de clases
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";
require_once "../app/Controllers/PerrosController.php";

// Usamos el espacio de nombre
use App\Core\Router;
use App\Controllers\PerrosController;

// Creamos una instancia de la clase Router
$router = new Router();

// Añadimos rutas al array
$router->add([  'name' => 'primera',
                'path' => '/^\/$/',
                'action' => [PerrosController::class, 'IndexAction']]);

$router->add([  'name' => 'añadir',
                'path' => '/^\/mascotas\/add$/',
                'action' => [PerrosController::class, 'AddAction']]);

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request); // Comprobamos que coincide una ruta

if($route){
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
}else{
    echo "No route";
}
?>