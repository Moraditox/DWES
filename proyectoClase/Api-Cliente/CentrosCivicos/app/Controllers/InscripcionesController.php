<?php

namespace App\Controllers;

use App\Models\Inscripciones;

require_once '../app/lib/decodificarToken.php';

class InscripcionesController {
    #Propiedades de la clase
    private $requestMethod; //Método http
    private $inscripcionesId; //ID
    private $inscripciones; //Contactos

    #Constructor. Necesita Petición, contactosId
    public function __construct($requestMethod, $inscripcionesId) {
        $this->requestMethod = $requestMethod;
        $this->inscripcionesId = $inscripcionesId;
        $this->inscripciones = Inscripciones::getInstancia();
    }

    /**
     * Función que preocesa la petición
     * return: Respuesta de la petición
     */
    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getInscripcionesByIdUser();
                break;
            case 'POST':
                $response = $this->createInscripcion();
                break;
            case 'PUT':
                $response = $this->notFoundResponse();
                break;
            case 'DELETE':
                $response = $this->deleteInscripcion();
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

    private function getInscripcionesByIdUser() {
        $idUser = decodificarToken();
        $result = $this->inscripciones->getByIdUser($idUser);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createInscripcion() {
        $idUser = decodificarToken();
        $input = (array) json_decode(file_get_contents('php://input') , true);
        if(!$this->validateUser($input)) {
            return $this->notFoundResponse();
        }
        $result = $this->inscripciones->set($idUser, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 created';
        $response['body'] = json_encode($input);
        return $response;
    }

    public function deleteInscripcion() {
        $result = $this->inscripciones->delete($this->inscripcionesId);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = "Inscripcion eliminada";
        return $response;
    }

    private function validateUser($input) {
        if (! isset($input['solicitante']) || ! isset($input['telefono']) || ! isset($input['email']) 
        || ! isset($input['actividad_id']) || ! isset($input['fecha_inscripcion']) || ! isset($input['estado'])) {
            return false;
        }
        return true;
    }

    public function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = 'Inscripciones no encontradas';
        return $response;
    }
}
?>