<?php
namespace App\Models;

class Contactos extends DBAbstractModel {
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
    public function set($contacto_data=[]){
        //para borrarlo en postman hay que añadir en: body, raw, {"nombre":"quino", etc}
        foreach ($contacto_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->get_results_from_query();

        //$this->execute_single_query();
        $this->mensaje = 'Contacto añadido';
    }

    public function get($id = ''){
        if($id != ''){
            $this->query = "SELECT * FROM contactos WHERE id = :id";

            //Cargamos los parámetros.
            $this->parametros['id'] = $id;

            //Ejecutamos consulta que devuelve registros
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            $this->mensaje = 'Contacto encontrado';
        } else {
            $this->mensaje = 'Contacto no escontrado';
        }
        return $this->rows[0] ?? null; 
    }

    public function edit($id = '', $campos = []){
        foreach ($campos as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "UPDATE contactos SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->parametros['nombre'] = $nombre;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        $this->mensaje = 'Contacto modificado';
    }
    public function delete($id = "") {
        $this->query = "DELETE FROM contactos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Contacto eliminado';
    }
}
?>