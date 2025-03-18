<?php
namespace App\Models;

class Reservas extends DBAbstractModel {
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
    public function set($id_usuario = '', $user_data=[]){
        //para borrarlo en postman hay que añadir en: body, raw, {"nombre":"quino", etc}
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "INSERT INTO reservas (solicitante, telefono, email, instalacion_id, id_usuario, fecha_inicio, fecha_fin, estado) 
                        VALUES (:solicitante, :telefono, :email, :instalacion_id, :id_usuario, :fecha_inicio, :fecha_fin, :estado)";
        $this->parametros['solicitante'] = $solicitante;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->parametros['instalacion_id'] = $instalacion_id;
        $this->parametros['id_usuario'] = $id_usuario;
        $this->parametros['fecha_inicio'] = $fecha_inicio;
        $this->parametros['fecha_fin'] = $fecha_fin;
        $this->parametros['estado'] = $estado;
        $this->get_results_from_query();

        //$this->execute_single_query();
        $this->mensaje = 'Reserva creada';
    }

    public function get($id = ''){
        if($id != ''){
            $this->query = "SELECT * FROM reservas WHERE id = :id";

            //Cargamos los parámetros.
            $this->parametros['id'] = $id;

            //Ejecutamos consulta que devuelve registros
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            $this->mensaje = 'Reserva encontrada';
        } else {
            $this->mensaje = 'Reserva no escontrada';
        }
        return $this->rows; 
    }

    public function getByIdUser($id_user = ''){
        if($id_user != ''){
            $this->query = "SELECT * FROM reservas WHERE id_usuario = :id_usuario";

            //Cargamos los parámetros.
            $this->parametros['id_usuario'] = $id_user;

            //Ejecutamos consulta que devuelve registros
            $this->get_results_from_query();
        }
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Reserva encontrada';
        } else {
            $this->mensaje = 'Reserva no escontrada';
        }
        return $this->rows; 
    }

    public function edit(){}
    public function delete($id = "") {
        $this->query = "DELETE FROM reservas WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if($this->affected_rows <= 0){
            $this->mensaje = 'Reserva no eliminada';
            return false;
        }else{
            $this->mensaje = 'Reserva eliminada';
            return true;
        }
    }
}
?>