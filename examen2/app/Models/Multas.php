<?php
/**
 *
 * Archvio de la clase Usuarios
 *  
 * @autor Héctor Mora Sánchez
 * @date 2025-03-06
 */

namespace App\Models;

use App\Models\DBAbstractModel;

class Multas extends DBAbstractModel {
    private static $instancia;
    //Patron singleton, no puedo tener dos objetos de la clase mascotas
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    private $id;
    private $id_agente;
    private $id_conductor;
    private $matricula;
    private $id_tipo_sancion;
    private $descripcion;
    private $fecha;
    private $importe;
    private $descuento;
    private $estado;

    //Creamos los setters y getters
    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    public function setIdAgente($id_agente){
        $this->id_agente = $id_agente;
    }
    public function getIdAgente(){
        return $this->id_agente;
    }
    public function setIdConductor($id_conductor){
        $this->id_conductor = $id_conductor;
    }
    public function getIdConductor(){
        return $this->id_conductor;
    }
    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }
    public function getMatricula(){
        return $this->matricula;
    }
    public function setIdTipoSancion($id_tipo_sancion){
        $this->id_tipo_sancion = $id_tipo_sancion;
    }
    public function getIdTipoSancion(){
        return $this->id_tipo_sancion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function setImporte($importe){
        $this->importe = $importe;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function setDescuento($descuento){
        $this->descuento = $descuento;
    }
    public function getDescuento(){
        return $this->descuento;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    public function getEstado(){
        return $this->estado;
    }


    public function set(){

    }
    public function get(){
        $this->query = "SELECT * FROM multas WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Multa encontrada';
        } else {
            $this->mensaje = 'Multa no encontrada';
        }
        return $this->rows[0] ?? null;
    }
    public function edit(){
        
    }
    public function delete(){
        $this->query = "DELETE FROM multas WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario eliminado';
    }

    public function getMultasIdConductor($id){
        $this->query = "SELECT * FROM multas WHERE id_conductor = :id_conductor";
        $this->parametros['id_conductor'] = $id;

        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Multa/s encontrada/s';
        } else {
            $this->mensaje = 'Multa/s no encontrada/s';
        }
        return $this->rows ?? null;
    }

    public function getMultasIdAgente($id){
        $this->query = "SELECT * FROM multas WHERE id_agente = :id_agente";
        $this->parametros['id_agente'] = $id;

        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Multa/s encontrada/s';
        } else {
            $this->mensaje = 'Multa/s no encontrada/s';
        }
        return $this->rows ?? null;
    }
}