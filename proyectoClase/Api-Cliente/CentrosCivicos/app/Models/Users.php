<?php
namespace App\Models;

class Users extends DBAbstractModel {
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
    public function set($user_data=[]){
        //para borrarlo en postman hay que añadir en: body, raw, {"nombre":"quino", etc}
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();

        //$this->execute_single_query();
        $this->mensaje = 'Usuario añadido';
    }

    public function get($id = ''){
        if($id != ''){
            $this->query = "SELECT * FROM usuarios WHERE id = :id";

            //Cargamos los parámetros.
            $this->parametros['id'] = $id;

            //Ejecutamos consulta que devuelve registros
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows ?? null; 
    }

    public function edit($id = '', $campos = []){
        foreach ($campos as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "UPDATE usuarios SET nombre = :nombre,  email = :email, password = :password WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->parametros['nombre'] = $nombre;
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario modificado';
    }
    public function delete($id = "") {
        $this->query = "DELETE FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if($this->affected_rows <= 0){
            $this->mensaje = 'Usuario no eliminado';
            return false;
        }else{
            $this->mensaje = 'Usuario eliminado';
            return true;
        }
    }

    public function getAll(){
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows ?? null; 
    }

    public function getIdByEmail($email){
        $this->query = "SELECT id FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        return $this->rows[0]['id'] ?? null; 
    }

    public function login($email, $password){
        $this->query = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no escontrado';
        }
        return $this->rows[0] ?? null;
    }
}
?>