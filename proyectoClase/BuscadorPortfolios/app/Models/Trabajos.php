<?php
/**
 *
 * Archvio de la clase Usuarios
 *  
 * @autor Héctor Mora Sánchez
 * @date 2025-05-10
*/
namespace App\Models;
require_once "DBAbstractModel.php";

class Trabajos extends DBAbstractModel{
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
    private $titulo;
    private $descripcion;
    private $fecha_inicio;
    private $fecha_final;
    private $logros;
    private $visible;
    private $created_at;
    private $updated_at;
    private $usuarios_id;

    //Creo los setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion ;
    }
    public function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio ;
    }
    public function setFechaFinal($fecha_final) {
        $this->fecha_final = $fecha_final ;
    }
    public function setLogros($logros) {
        $this->logros = $logros ;
    }
    public function setVisible($visible) {
        $this->visible = $visible ;
    }
    public function setUsuariosId($usuarios_id) {
        $this->usuarios_id = $usuarios_id ;
    }

    //Creo los getters
    public function getId() {
        return $this->id;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function getFechaInicio() {
        return $this->fecha_inicio;
    }
    public function getFechaFinal() {
        return $this->fecha_final;
    }
    public function getLogros() {
        return $this->logros;
    }
    public function getVisible() {
        return $this->visible;
    }
    public function getUsuariosId() {
        return $this->usuarios_id;
    }
    

    /*Método para insertar datos en la tabla usuarios*/
    public function set() {
        $this->query = "INSERT INTO trabajos(titulo, descripcion, fecha_inicio, fecha_final, logros, visible, usuarios_id) 
                VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_final, :logros, :visible, :usuarios_id)";

        $this->parametros["titulo"] = $this->titulo;
        $this->parametros["descripcion"] = $this->descripcion;
        $this->parametros["fecha_inicio"] = $this->fecha_inicio;
        $this->parametros["fecha_final"] = $this->fecha_final;
        $this->parametros["logros"] = $this->logros;
        $this->parametros["visible"] = $this->visible;
        $this->parametros["usuarios_id"] = $_SESSION["usuario"]["id"];

        $this->get_results_from_query();
        $this->mensaje = "Trabajo añadido";
        return $this->mensaje;
    }

    //Para obtener un usuario por su nombre y contraseña
    public function get($id = ""){
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Trabajos encontrados';
        } else {
            $this->mensaje = 'No ahí ningun trabajo';
        }
        return $this->rows ?? null;
    }

    //Para editar Usuarios
    public function edit(){
        $fecha = new \DateTime();
        $this->query = "UPDATE trabajos 
                        SET titulo = :titulo, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_final = :fecha_final, 
                        logros = :logros, updated_at = :updated_at
                        WHERE id = :id";
        $this->parametros["titulo"] = $this->titulo;
        $this->parametros["descripcion"] = $this->descripcion;
        $this->parametros["fecha_inicio"] = $this->fecha_inicio;
        $this->parametros["fecha_final"] = $this->fecha_final;
        $this->parametros["logros"] = $this->logros;
        $this->parametros['updated_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Trabajo modificada';
    }

    //Para eliminar el ultimo perro creado
    public function delete(){
        $this->query = "DELETE FROM trabajos WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Trabajo eliminado';
    }

    //Para obtener todos los trabajos
    public function getAll(){
        $this->query = "SELECT * FROM trabajos";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getVisibles($id) {
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Trabajos encontrados';
        } else {
            $this->mensaje = 'No ahí ningun trabajo';
        }
        return $this->rows ?? null;
    }

    public function getJobVisible() {
        $this->query = "SELECT * FROM trabajos WHERE id = :id AND visible = 1";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();

        if (count($this->rows) == 1) {
            $this->query = "UPDATE trabajos SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 0;
            $this->get_results_from_query();
        } else {
            $this->query = "UPDATE trabajos SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 1;
            $this->get_results_from_query();
        }
    }
}