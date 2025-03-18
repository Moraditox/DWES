<?php
namespace App\Models;

class Sanciones extends DBAbstractModel
{
    private static $instancia;

    // Patron singleton, no puedo tener dos objetos de la clase mascotas
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
    private $tipo;
    private $importe;
    private $puntos;

    public function setId($id) {
        $this->id = $id;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
    }

    public function setPuntos($puntos) {
        $this->puntos = $puntos;
    }

    public function getMensaje(){
        return $this->mensaje;
    }


    // Para obtener todos los usuarios
    public function getAll(){
        $this->query = "SELECT * FROM tipo_sanciones";
        $this->get_results_from_query();
        return $this->rows;
    }

    // Para obtener multas por id
    public function get($id = ''){
        $this->query = "SELECT * FROM tipo_sanciones WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getTipo($id = ''){
        $this->query = "SELECT tipo FROM tipo_sanciones WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getAllTipos(){
        $this->query = "SELECT tipo FROM tipo_sanciones";
        $this->get_results_from_query();
        return $this->rows;
    }

    

    public function set() {
    }

    public function edit(){
    }

    public function delete($id=''){
    }


}