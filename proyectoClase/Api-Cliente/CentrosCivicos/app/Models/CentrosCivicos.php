<?php
namespace App\Models;

class CentrosCivicos extends DBAbstractModel {
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
    public function set(){}

    public function get($id = ''){
        if($id != ''){
            $this->query = "SELECT * FROM centros_civicos WHERE id = :id";

            //Cargamos los parámetros.
            $this->parametros['id'] = $id;

            //Ejecutamos consulta que devuelve registros
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no escontrado';
        }
        return $this->rows[0]; 
    }

    public function getAll(){
        $this->query = "SELECT * FROM centros_civicos";
        //Ejecutamos consulta que devuelve registros
        $this->get_results_from_query();
        return $this->rows; 
    }

    public function edit(){}
    public function delete() {}
}
?>