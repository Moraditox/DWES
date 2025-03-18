<?php

namespace App\Controllers;

use App\Models\CentrosCivicos;

class CentrosCivicosController {
    #Propiedades de la clase
    private $requestMethod; //Método http
    private $centrosCivicosId; //ID
    private $centrosCivicos; //Contactos

    #Constructor. Necesita Petición, contactosId
    public function __construct($requestMethod, $centrosCivicosId) {
        $this->requestMethod = $requestMethod;
        $this->centrosCivicosId = $centrosCivicosId;
        $this->centrosCivicos = CentrosCivicos::getInstancia();
    }

    /**
     * Función que preocesa la petición
     * return: Respuesta de la petición
     */
    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                if($this->centrosCivicosId){
                    $response = $this->getCentroCivico($this->centrosCivicosId);
                    break;
                }else{
                    $response = $this->getCentrosCivicosAll();
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

    private function getCentroCivico($id) {
        $result = $this->centrosCivicos->get($id);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getCentrosCivicosAll(){
        $result = $this->centrosCivicos->getAll();
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