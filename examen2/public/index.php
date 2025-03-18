<?php
session_start();
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

$aCapcha = ["Peaton", "Coche", "Semaforo"];

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = ["perfil" => "invitado"];
}

if(!isset($_SESSION["mensaje"])){
    $_SESSION["mensaje"] = ["texto" => ""];
}

if(!isset($_SESSION["datos"])){
    $_SESSION["datos"] = [];
}

$numRandom = rand(0, 2);
foreach($aCapcha as $key => $value){
    if($key == $numRandom){
        setcookie("capcha", $value);
    }
}

use App\Core\Router;
use App\Controllers\DefaultController;
use App\Controllers\UsersController;

$router = new Router();

$router->add([  'name' => 'index',
                'path' => '/^\/$/',
                'action' => [DefaultController::class, 'IndexAction'],
                'auth' => ['invitado', 'admin', 'agente', 'conductor']]);
                
$router->add([  'name' => 'login',
                'path' => '/^\/login$/',
                'action' => [UsersController::class, 'LoginUser'],
                'auth' => ['invitado', 'admin', 'agente', 'conductor']]); 

$router->add([  'name' => 'cerrarSesion',
                'path' => '/^\/cerrarSesion$/',
                'action' => [UsersController::class, 'CerrarSesion'],
                'auth' => ['admin', 'agente', 'conductor']]);

$router->add([  'name' => 'multas',
                'path' => '/^\/multas$/',
                'action' => [UsersController::class, 'MultasConductor'],
                'auth' => ['conductor']]); 

$router->add([  'name' => 'pagarMultas',
                'path' => '/^\/pagarMulta$/',
                'action' => [UsersController::class, 'PagarMultas'],
                'auth' => ['conductor']]); 

$router->add([  'name' => 'multaPagada',
                'path' => '/^\/multaPagada$/',
                'action' => [UsersController::class, 'DeleteMulta'],
                'auth' => ['conductor']]); 

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if($route){
    //Si la ruta requiere autenticación y el usuario no tiene acceso, manejar la redirección
    if (isset($route['auth']) && !in_array($_SESSION['user']['perfil'], $route['auth'])) {
        if ($request !== "/") {
            header('Location: /');
            exit();
        } else {
            echo "Acceso denegado. Inicia sesión para continuar.";
            exit();
        }
    }
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
}else{
    echo "No route";
}
?>
