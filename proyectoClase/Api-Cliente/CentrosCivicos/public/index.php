<?php
require_once '../vendor/autoload.php';
require_once '../bootstrap.php';

use App\Controllers\AuthController;
use App\Controllers\UsersController;
use App\Controllers\CentrosCivicosController;
use App\Controllers\InstalacionesController;
use App\Controllers\ActividadesController;
use App\Controllers\ReservasController;
use App\Controllers\InscripcionesController;
use App\Core\Router;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');

//Muy importante, sin esto no funciona la conexión con angular en los metodos delete y post
//El motivo es que en estos metodos primero se manda el metodo OPTIONS y esto generaba el error
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

//Recuperamos el método utilizado.
$requestMethod = $_SERVER['REQUEST_METHOD'];

//Parseamos la direccion de entrada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $request);

//Si existe recuperamos el id del usuario
$userId = null;
if(isset($uri[3])) {
    $userId =(int) $uri[3];
}

function isAuthenticated() {
    if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
        return false;
    }
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    $arr = explode(" ", $authHeader);
    $jwt = $arr[1];
    if (!$jwt) {
        return false;
    }
    try {
        $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
        return true;
    } catch (Exception $e) {
        return false;
    }
}

//Peticion de contacto
$router = new Router();
$router->add(array(
    'name'=> 'usuario',
    'path'=> '/^\/api\/user$/',
    'action'=> UsersController::class,
    'auth'=> 'true'
));

$router->add(array(
    'name'=> 'register',
    'path'=> '/^\/api\/register$/',
    'action'=> UsersController::class,
    'auth'=> 'false'
));

$router->add(array(
    'name'=> 'login',
    'path'=> '/^\/api\/login$/',
    'action'=> AuthController::class,
    'auth'=> 'false'
));

$router->add(array(
    'name'=> 'centrosCivicos',
    'path'=> '/^\/api\/centros\/([0-9]+)?$/',
    'action'=> CentrosCivicosController::class,
    'auth'=> 'false'
));

$router->add(array(
    'name'=> 'Insatalaciones',
    'path'=> '/^\/api\/centros\/([0-9]+)?\/instalaciones$/',
    'action'=> InstalacionesController::class,
    'auth'=> 'false'
));

$router->add(array(
    'name'=> 'Instalaciones-Filtros',
    'path'=> '/^\/api\/instalaciones$/',
    'action'=> InstalacionesController::class,
    'auth'=> 'false'
));

$router->add(array(
    'name'=> 'Actividades',
    'path'=> '/^\/api\/centros\/([0-9]+)?\/actividades$/',
    'action'=> ActividadesController::class,
    'auth'=> 'false'
));

$router->add(array(
    'name'=> 'Actividades-Filtros',
    'path'=> '/^\/api\/actividades$/',
    'action'=> ActividadesController::class,
    'auth'=> 'false'
));

$router->add(array(
    'name'=> 'Reservas',
    'path'=> '/^\/api\/reservas\/([0-9]+)?$/',
    'action'=> ReservasController::class,
    'auth'=> 'true'
));

$router->add(array(
    'name'=> 'Inscripciones',
    'path'=> '/^\/api\/inscripciones\/([0-9]+)?$/',
    'action'=> InscripcionesController::class,
    'auth'=> 'true'
));


$route = $router->match($request);
if($route) {
    if(isset($route['auth']) && $route['auth'] == 'true' && !isAuthenticated()) {
        header('HTTP/1.1 401 Unauthorized');
        $response['body'] = json_encode(array("message" => "No autorizado"));
        echo json_encode($response['body']);
        exit();
    }
    $controllerName = $route['action'];
    $controller = new $controllerName($requestMethod, $userId);
    $controller->processrequest();
} else {
    echo "Error Index";
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    echo json_encode($response);
}
?>