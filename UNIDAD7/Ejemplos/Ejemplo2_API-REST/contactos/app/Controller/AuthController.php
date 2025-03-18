<?php
namespace App\Controller;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use App\Models\Usuarios;

class AuthController {
    private $requestMethod; //Metodo de solicitud HTTP (GET, POST, PUT, DELETE)
    private $userId; //identificador del usuario autenticado
    private $users;

    public function __construct($requestMethod) {
        $this->requestMethod = $requestMethod;
        $this->users = Usuarios::getInstancia();
    }

    public function loginFromRequest() {
        $input = json_decode(file_get_contents("php://input"), true);
        if(json_last_error() != JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['mensaje' => 'El JSON recibido no es válido.', "error" => json_last_error_msg()]);
            exit;
        }
        $usuario = $input['usuario'];
        $password = $input['password'];
        $dataUser = $this->users->login($usuario, $password);

        if($dataUser) {
            $key = KEY; //Clave para la codificación del JWT
            $issuer_claim = "http://www.api-rest-contactos.local"; //Emisor del token
            $audience_claim = "http://www.api-rest-contactos.local"; //Audiencia del token
            $issuedat_claim = time(); //Tiempo en que fue emitido el token
            $notbefore_claim = time(); //Tiempo antes del cual no es válido el token
            $exprie_claim = $issuedat_claim + 3600; //Tiempo en que expirará el token

            $token = [
                "iss" => $issuer_claim,
                "aud"=> $audience_claim,
                "iat"=> $issuedat_claim,
                "nbf"=> $notbefore_claim,
                "exp"=> $exprie_claim,
                "data" => [
                    "usuario" => $usuario
                ]
            ];

            $jwt = JWT::encode($token, $key, 'HS256'); //genera el token JWT
            $res = json_encode(
                [
                    "mensaje" => "Acceso concedido",
                    "jwt"=> $jwt,
                    "usuario" => $usuario,
                    "expiraAt" => $exprie_claim
                ]
            );

            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = $res;
        }else{
            $response['status_code_header'] = 'HTTP/1.1 401 Login failed';
            $response['body'] = null;
        }

        header($response['status_code_header']); //Envia el encabezado de respuesta HTTP
        if($response['body']){
            echo $response['body']; //Imprime el cuerpo de la respuesta si existe
        }
    }
}
?>