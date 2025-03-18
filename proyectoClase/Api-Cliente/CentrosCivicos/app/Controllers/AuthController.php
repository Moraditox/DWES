<?php
namespace App\Controllers;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use App\Models\Users;

class AuthController {
    private $requestMethod; //Metodo de solicitud HTTP (GET, POST, PUT, DELETE)
    private $userId; //identificador del usuario autenticado
    private $users;

    public function __construct($requestMethod) {
        $this->requestMethod = $requestMethod;
        $this->users = Users::getInstancia();
    }

    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                break;
            case 'POST':
                $response = $this->loginFromRequest();
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

    public function loginFromRequest(){
        // decodificar el json que viene en el body de la petición
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        // obtener el nombre y la contraseña del json
        $email = $input['email'];
        $password = $input['password'];

        // obtener el usuario y la contraseña de la base de datos
        $dataUser = $this->users->login($email, $password);
        $idUser = $this->users->getIdByEmail($email);
        // si el usuario y la contraseña son correctos
        if($dataUser){
            $key = KEY; // llave de seguridad
            $issuser_claim = "http://centroscivicos.local"; // emisor
            $audiencia_claim = "http://centroscivicos.local"; // audiencia
            $issuedat_claim = time(); // fecha de emisión
            $notbefore_claim = time(); // no válido antes de esta fecha
            $expire_claim = $issuedat_claim + 3600; // fecha de expiraciónn del token

            $token = [
                "iss" => $issuser_claim, // emisor
                "aud" => $audiencia_claim, // audiencia
                "iat" => $issuedat_claim, // fecha de emisión
                "nbf" => $notbefore_claim, // no válido antes de esta fecha
                "exp" => $expire_claim, // fecha de expiración
                // información del token
                "data" => [
                    "id" => $idUser, // se guarda el id del usuario
                ]
            ];
            $jwt = JWT::encode($token, $key, 'HS256'); // generar el token
            $res = json_encode(value: [
                'message' => 'Inicio de sesión exitoso', // mensaje de éxito
                'jwt' => $jwt, // token
                'usuario' => $idUser, // id del usuario
                "expireAt" => $expire_claim // fecha de expiración del token
            ]);
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = $res;
        } else{
            $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
            $response['body'] = "Usuario o contraseña incorrectos";
        }
        return $response;
    }

    public function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
?>