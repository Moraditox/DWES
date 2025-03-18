<?php

namespace App\Controllers;

use App\Models\Reservas;

require_once '../app/lib/decodificarToken.php';

class ReservasController {
    #Propiedades de la clase
    private $requestMethod; //Método http
    private $reservasId; //ID
    private $reservas; //Contactos

    #Constructor. Necesita Petición, contactosId
    public function __construct($requestMethod, $reservasId) {
        $this->requestMethod = $requestMethod;
        $this->reservasId = $reservasId;
        $this->reservas = Reservas::getInstancia();
    }

    /**
     * Función que preocesa la petición
     * return: Respuesta de la petición
     */
    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getReservasByIdUser();
                break;
            case 'POST':
                $response = $this->createReserva();
                break;
            case 'PUT':
                $response = $this->notFoundResponse();
                break;
            case 'DELETE':
                $response = $this->deleteReserva();
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

    private function getReservasByIdUser() {
        $idUser = decodificarToken();
        $result = $this->reservas->getByIdUser($idUser);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createReserva() {
        $idUser = decodificarToken();
        $input = (array) json_decode(file_get_contents('php://input') , true);
        if(!$this->validateUser($input)) {
            return $this->notFoundResponse();
        }
        $result = $this->reservas->set($idUser, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 created';
        $response['body'] = json_encode($input);
        return $response;
    }

    public function deleteReserva() {
        $idUser = decodificarToken();
        $reserva = $this->reservas->getByIdUser($idUser);
        if (!$reserva || $reserva[0]['id_usuario'] != $idUser) {
            $response['status_code_header'] = 'HTTP/1.1 404 no Autorizado';
            $response['body'] = 'No es tu reserva';
            return $response;
        }
        $result = $this->reservas->delete($this->reservasId);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = "Reserva eliminada";
        return $response;
    }

    private function validateUser($input) {
        if (! isset($input['solicitante']) || ! isset($input['telefono']) || ! isset($input['email']) 
        || ! isset($input['instalacion_id']) || ! isset($input['fecha_inicio']) || ! isset($input['fecha_fin'])
        || ! isset($input['estado'])) {
            return false;
        }
        return true;
    }

    public function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = 'Reservas no encontradas';
        return $response;
    }
}
?>