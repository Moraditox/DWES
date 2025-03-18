<?php
require_once '../vendor/autoload.php';
require_once '../bootstrap.php';

use App\Controller\AuthController;
use App\Controller\ContactosController;
use App\Core\Router;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');

//Muy importante, sin esto no funciona la conexión con angular en los metodos delete y post
//El motivo es que en estos metodos primero se manda el metodo OPTIONS y esto generaba el error
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

//Recuperamos el método utilizado.
$requestMethod = $_SERVER['REQUEST_METHOD'];

//Parseamos la direccion de entrada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $request);

//Si existe recuperamos el id del usuario
$userId = null;
if (isset($uri[2])) {
    $userId = (int) $uri[2];
}

//Proceso de login
if ($request == '/login/') {
    $auth = new AuthController($requestMethod);
    if (!$auth->loginFromRequest()) {
        exit(http_response_code(401));
    }
}

$input = (array) json_decode(file_get_contents('php://input'), true);
// $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
// $arr = explode(' ', $authHeader);
// $jwt = $arr[1];

// if ($jwt) {
//     try {
//         $decoded = JWT::decode($jwt, new KEY(KEY, 'HS256')); //Si no es posible decodificar el token generamos un error
//     } catch (Exception $e) {
//         echo json_encode([
//             "mensaje" => "Acceso denegado",
//             "error" => $e->getMessage()
//         ]);
//         exit(http_response_code(401));
//     }
// }

//Peticion de contacto
$router = new Router();
$router->add(
    array(
        'name' => 'home',
        'path' => '/^\/contactos\/([0-9]+)?$/',
        'action' => ContactosController::class
    )
);

$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'];
    $controller = new $controllerName($requestMethod, $userId);
    $controller->processrequest();
} else {
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    echo json_encode($response);
}
