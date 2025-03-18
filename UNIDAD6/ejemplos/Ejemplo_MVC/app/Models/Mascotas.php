<?php
# Importar modelo de abstracción de base de datos
require_once('DBAbstractModel.php');
class Perros extends DBAbstractModel{
    /*CONSTSTRUCCION DEL MODELO SINGLETON*/
    private static $instancia;
    public static function getinstancia(){
        if(!isset(self::$instancia)){
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone(){
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    private $id;
    private $nombre;
    private $peso;
    private $raza;
    private $created_at;
    private $updated_at;

    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }
    public function setPeso($peso){
        $this -> peso = $peso;
    }
    public function setRaza($raza){
        $this -> raza = $raza;
    }

    public function getMensaje(){
        return $this -> mensaje;
    }

    /*Método para ver la implementacion utilizando 
    el mecanismo de cargar los datos en la entidad 
    y luego persistirlos */
    public function set() {
        $this -> query = "INSERT INTO perros(nombre, peso, raza) VALUES(:nombre, :peso, :raza)";
        
        //$this->parametros['id']= $id;
        $this -> parametros['nombre'] = $this->nombre;
        $this -> parametros['peso'] = $this->peso;
        $this -> parametros['raza'] = $this->raza;
        $this -> get_results_from_query();
        //$this->execute_single_query();
        $this -> mensaje = 'Perro añadido.';
    }

    public function get($id = ''){
        if($id != ''){
            $this -> query = "SELECT * FROM perros WHERE id = :id";
            $this -> parametros['id'] = $id;
            $this -> get_results_from_query();
            $this -> mensaje = $id;
            if(count($this -> rows) == 1){
                foreach ($this -> rows[0] as $propiedad => $valor){
                    $this -> $propiedad = $valor;
                }
                $this -> mensaje = 'Perro encontrado';
            }else{
                $this -> mensaje = 'Perro no encontrado';
            }
            return $this -> rows[0]??null;
        }
    }
    public function edit(){}
    public function delete(){}
}
    