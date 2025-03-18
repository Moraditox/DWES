<?php
namespace App\Models;
 
class Actividades extends DBAbstractModel {
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

    public function get($centro_id = ''){
        if($centro_id != ''){
            $this->query = "SELECT * FROM actividades WHERE centro_id = :centro_id";

            //Cargamos los parámetros.
            $this->parametros['centro_id'] = $centro_id;

            //Ejecutamos consulta que devuelve registros
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no escontrado';
        }
        return $this->rows; 
    }

    public function getFiltro($filtro = []){
        foreach ($filtro as $campo => $valor) {

            if($campo == "nombre"){
                $this->query = "SELECT * FROM actividades WHERE nombre LIKE :nombre";
                $this->parametros['nombre'] = "%$valor%";
            }else if($campo == "descripcion"){
                $this->query = "SELECT * FROM actividades WHERE descripcion LIKE :descripcion";
                $this->parametros['descripcion'] = "%$valor%";
            }else{
                $this->query = "SELECT * FROM actividades WHERE fecha_inicio = :fecha_inicio";
                $this->parametros['fecha_inicio'] = $valor;
            }
        }
        //Ejecutamos consulta que devuelve registros
        $this->get_results_from_query();
        return $this->rows; 
    }

    public function edit(){}
    public function delete() {}
}
?>