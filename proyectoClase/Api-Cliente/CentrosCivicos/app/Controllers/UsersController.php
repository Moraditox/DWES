<?php

namespace App\Controllers;

use App\Models\Users;

require_once '../app/lib/decodificarToken.php';

class UsersController {
    #Propiedades de la clase
    private $requestMethod; //Método http
    private $usersId; //ID
    private $users; //Contactos

    #Constructor. Necesita Petición, contactosId
    public function __construct($requestMethod, $usersId) {
        $this->requestMethod = $requestMethod;
        $this->usersId = $usersId;
        $this->users = Users::getInstancia();
    }

    /**
     * Función que preocesa la petición
     * return: Respuesta de la petición
     */
    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getUser();
                break;
            case 'POST':
                $response = $this->createUser();
                break;
            case 'PUT':
                $response = $this->uptadeContactos();
                break;
            case 'DELETE':
                $response = $this->deleteUsuario();
                break;
            default:
                $response = $this->notFoundResponse(); 
                break;
        }
        header($response['status_code_header']);
        if($response['body']) {
            echo $response['body'];
        }
    }

    private function getUser() {
        $idUser = decodificarToken();
        $result = $this->users->get($idUser);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createUser() {
        $input = (array) json_decode(file_get_contents('php://input') , true);
        if(!$this->validateUser($input)) {
            return $this->notFoundResponse();
        }
        $result = $this->users->set($input);
        $response['status_code_header'] = 'HTTP/1.1 200 created';
        $response['body'] = json_encode($input);
        return $response;
    }

    public function uptadeContactos() {
        $idUser = decodificarToken();
        $input = (array) json_decode(file_get_contents('php://input') , true);
        if(!$this->validateUser($input)) {
            return $this->notFoundResponse();
        }
        $this->users->edit($idUser, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = "Usuario modificado";
        return $response;
    }

    public function deleteUsuario() {
        $idUser = decodificarToken();
        $result = $this->users->delete($idUser);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = "Usuario eliminado";
        return $response;
    }

    private function validateUser($input) {
        if (! isset($input['nombre']) || ! isset($input['email']) || ! isset($input['password'])) {
            return false;
        }
        return true;
    }

    public function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = 'Usuario no encontrado';
        return $response;
    }
}
?>