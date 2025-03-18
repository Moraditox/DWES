<?php
/**
*
* Proyecto de clase el cual nos solicitan un buscador de portfolios
*
* @autor Héctor Mora Sánchez
* @date 2025-05-10
*/
require_once "../vendor/autoload.php";
require_once "../bootstrap.php";

session_start();
if(!isset($_SESSION["usuario"])) {
    $_SESSION["usuario"] = ["auth" => false, "nombre" => "invitado", "foto" => "User-icon.jpg"];
}
if(!isset($_SESSION["mensaje"])) {
    $_SESSION["mensaje"] = ["tipo" => "", "texto" => ""];
}

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\UsuariosController;
use App\Controllers\TrabajosController;
use App\Controllers\SkillsController;
use App\Controllers\ProyectosController;
use App\Controllers\RedesSocialesController;

$router = new Router();
$router->add([
    'name'=>'home',
    'path'=>'/^\/$/',
    'action'=>[UsuariosController::class, 'IndexAction'],
    'auth' => ['Invitado', 'Usuario']
]);

$router->add([
    'name'=>'perfil',
    'path'=>'/^\/perfil$/',
    'action'=>[UsuariosController::class, 'PerfilesAction'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'perfilPublic',
    'path'=>'/^\/perfil\/[0-9]+$/',
    'action'=>[UsuariosController::class, 'PerfilesPublicAction'],
    'auth' => ['Invitado', 'Usuario']
]);

$router->add([
    'name'=>'addUser',
    'path'=>'/^\/addUser/',
    'action'=>[UsuariosController::class, 'AddUser'],
    'auth' => ['Invitado', 'Usuario']
]);

$router->add([
    'name'=>'loginUser',
    'path'=>'/^\/loginUser/',
    'action'=>[UsuariosController::class, 'LoginUser'],
    'auth' => ['Invitado', 'Usuario']
]);

$router->add([
    'name'=>'editUser',
    'path'=>'/^\/editUser\/[0-9]+$/',
    'action'=>[UsuariosController::class, 'EditUsuario'],
    'auth' => ['Usuario']
]);

$router->add([
    'name'=>'deleteUser',
    'path'=>'/^\/deleteUser\/[0-9]+$/',
    'action'=>[UsuariosController::class, 'DeleteUser'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'mostrarUser',
    'path'=>'/^\/mostrarUser\/[0-9]+$/',
    'action'=>[UsuariosController::class, 'MostrarUsuario'],
    'auth'=>['Usuario']
]);

$router->add([
    'name' => 'verificar',
    'path' => '/^\/verificar(\?token=.*)?$/',
    'action' => [UsuariosController::class, 'verificarAction'],
    'auth' => ['Invitado', 'Usuario']
]);

$router->add([
    'name'=>'addJob',
    'path'=>'/^\/addJob/',
    'action'=>[TrabajosController::class, 'AddJob'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'editJob',
    'path'=>'/^\/editJob\/[0-9]+$/',
    'action'=>[TrabajosController::class, 'EditJob'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'deleteJob',
    'path'=>'/^\/deleteJob\/[0-9]+$/',
    'action'=>[TrabajosController::class, 'DeleteJob'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'mostrarJob',
    'path'=>'/^\/mostrarJob\/[0-9]+$/',
    'action'=>[TrabajosController::class, 'MostrarTrabajo'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'addSkill',
    'path'=>'/^\/addSkill/',
    'action'=>[SkillsController::class, 'AddSkill'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'editSkill',
    'path'=>'/^\/editSkill\/[0-9]+$/',
    'action'=>[SkillsController::class, 'EditSkill'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'deleteSkill',
    'path'=>'/^\/deleteSkill\/[0-9]+$/',
    'action'=>[SkillsController::class, 'DeleteSkill'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'mostrarSkill',
    'path'=>'/^\/mostrarSkill\/[0-9]+$/',
    'action'=>[SkillsController::class, 'MostrarSkill'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'addProyect',
    'path'=>'/^\/addProyect/',
    'action'=>[ProyectosController::class, 'AddProyect'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'editProyect',
    'path'=>'/^\/editProyect\/[0-9]+$/',
    'action'=>[ProyectosController::class, 'EditProyect'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'deleteProyect',
    'path'=>'/^\/deleteProyect\/[0-9]+$/',
    'action'=>[ProyectosController::class, 'DeleteProyect'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'mostrarProyect',
    'path'=>'/^\/mostrarProyect\/[0-9]+$/',
    'action'=>[ProyectosController::class, 'MostrarProyect'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'cierre-sesion',
    'path'=>'/^\/cierre-sesion\/$/',
    'action'=>[IndexController::class, 'CierreSesion'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'addRedSocial',
    'path'=>'/^\/addRedSocial/',
    'action'=>[RedesSocialesController::class, 'AddRedSocial'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'editRedSocial',
    'path'=>'/^\/editRedSocial\/[0-9]+$/',
    'action'=>[RedesSocialesController::class, 'EditRedSocial'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'deleteRedSocial',
    'path'=>'/^\/deleteRedSocial\/[0-9]+$/',
    'action'=>[RedesSocialesController::class, 'DeleteRedSocial'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'mostrarRedSocial',
    'path'=>'/^\/mostrarRedSocial\/[0-9]+$/',
    'action'=>[RedesSocialesController::class, 'MostrarRedSocial'],
    'auth'=>['Usuario']
]);

$router->add([
    'name'=>'buscar-perfil',
    'path'=>'/^\/buscar-perfil\/.*$/',
    'action'=>[IndexController::class, 'buscarAction'],
    'auth' => ['Invitado', 'Usuario']
]);

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if ($route) {
    $userAuth = $_SESSION['usuario']['auth'] ? 'Usuario' : 'Invitado';
    
    //Si la ruta requiere autenticación y el usuario no tiene acceso, manejar la redirección
    if (isset($route['auth']) && !in_array($userAuth, $route['auth'])) {
        if ($request !== "/") {
            header('Location: /');
            exit();
        } else {
            echo "Acceso denegado. Inicia sesión para continuar.";
            exit();
        }
    }

    //Ejecutar la acción del controlador si todo está correcto
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "Error 404: Página no encontrada";
}
?>