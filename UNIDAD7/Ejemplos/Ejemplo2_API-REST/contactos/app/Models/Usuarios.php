<?php
namespace App\Models;

class Usuarios extends DBAbstractModel {
    private static $instancia;

    public static function getInstancia(){
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone() {
        trigger_error("La clonacion no es permitida!.", E_USER_ERROR);
    }

    # Crear un nuevo usuario comprobando por código que no exista
    public function login($usuario, $password){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
        $this->parametros['usuario'] = $usuario;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no escontrado';
        }
        return $this->rows[0] ?? null;
    }

    public function set(){}
    public function get(){}
    public function edit(){}
    public function delete() {}
}
?>