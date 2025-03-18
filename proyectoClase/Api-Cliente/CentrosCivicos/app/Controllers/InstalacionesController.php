<?php

namespace App\Controllers;

use App\Models\Instalaciones;

class InstalacionesController {
    #Propiedades de la clase
    private $requestMethod; //Método http
    private $centrosCivicosId; //ID
    private $intalaciones; //Contactos

    #Constructor. Necesita Petición, contactosId
    public function __construct($requestMethod, $centrosCivicosId) {
        $this->requestMethod = $requestMethod;
        $this->centrosCivicosId = $centrosCivicosId;
        $this->intalaciones = Instalaciones::getInstancia();
    }

    /**
     * Función que preocesa la petición
     * return: Respuesta de la petición
     */
    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                if($this->centrosCivicosId){
                    $response = $this->getInstalaciones($this->centrosCivicosId);
                    break;
                }else{
                    $response = $this->getInstalacionesFiltro();
                    break;
                }
            case 'POST':
                break;
            case 'PUT':
                break;
            case "DELETE":
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

    private function getInstalaciones($id) {
        $result = $this->intalaciones->get($id);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getInstalacionesFiltro(){
        $input = (array) json_decode(file_get_contents('php://input') , true);
        $result = $this->intalaciones->getFiltro($input);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    public function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
?>