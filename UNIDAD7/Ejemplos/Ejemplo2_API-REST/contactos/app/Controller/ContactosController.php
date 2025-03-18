<?php
namespace App\Controller;

use App\Models\Contactos;
class ContactosController {

    #Propiedades de la clase
    private $requestMethod; //Método http
    private $contactosId; //ID
    private $contactos; //Contactos

    #Constructor. Necesita Petición, contactosId
    public function __construct($requestMethod, $contactosId) {
        $this->requestMethod = $requestMethod;
        $this->contactosId = $contactosId;
        $this->contactos = contactos::getInstancia();
    }

    /**
     * Función que preocesa la petición
     * return: Respuesta de la petición
     */
    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getContactos($this->contactosId);
                break;
            case 'POST':
                $response = $this->createContactos();
                break;
            case 'PUT':
                $response = $this->uptadeContactos($this->contactosId);
                break;
            case "DELETE":
                $response = $this->deleteContactos($this->contactosId);
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
    
    private function getContactos($id) {
        $result = $this->contactos->get($id);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createContactos() {
        $input = (array) json_decode(file_get_contents('php://input') , true);
        if(!$this->validateContacto($input)) {
            return $this->notFoundResponse();
        }
        $this -> contactos -> set($input);
        $response['status_code_header'] = 'HTTP/1.1 200 created';
        $response['body'] = $input;
        return $response;
    }

    public function uptadeContactos($id) {
        $input = (array) json_decode(file_get_contents('php://input') , true);
        if(!$this->validateContacto($input)) {
            return $this->notFoundResponse();
        }
        $this -> contactos -> edit($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    public function deleteContactos($id) {
        $result = $this->contactos->delete($id);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function validateContacto($input) {
        if (! isset($input['nombre']) || ! isset($input['telefono']) || ! isset($input['email'])) {
            return false;
        }
        return true;
    }

    public function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
?>