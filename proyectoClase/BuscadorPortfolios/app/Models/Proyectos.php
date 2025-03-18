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

class Proyectos extends DBAbstractModel{
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
    private $logo;
    private $tecnologias;
    private $visible;
    private $create_at;
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
        $this->descripcion = $descripcion;
    }
    public function setLogo($logo) {
        $this->logo = $logo;
    }
    public function setTecnologias($tecnologias) {
        $this->tecnologias = $tecnologias;
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
    public function getLogo() {
        return $this->logo;
    }
    public function getTecnologias() {
        return $this->tecnologias;
    }
    public function getVisible() {
        return $this->visible;
    }
    public function getUsuariosId() {
        return $this->usuarios_id;
    }
    

    /*Método para insertar datos en la tabla usuarios*/
    public function set() {
        $this->query = "INSERT INTO proyectos(titulo, descripcion, logo, tecnologias, visible, usuarios_id) 
                VALUES (:titulo, :descripcion, :logo, :tecnologias, :visible, :usuarios_id)";

        $this->parametros["titulo"] = $this->titulo;
        $this->parametros["descripcion"] = $this->descripcion;
        $this->parametros["logo"] = $this->logo;
        $this->parametros["tecnologias"] = $this->tecnologias;
        $this->parametros["visible"] = $this->visible;
        $this->parametros["usuarios_id"] = $this->usuarios_id;

        $this->get_results_from_query();
        $this->mensaje = "Proyecto añadido";
        return $this->mensaje;
    }

    //Para obtener un usuario por su nombre y contraseña
    public function get($id = ""){
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :usuarios_id";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Proyectos encontrados';
        } else {
            $this->mensaje = 'No ahí ningun proyecto';
        }
        return $this->rows ?? null;
    }

    //Para editar Usuarios
    public function edit(){
        $fecha = new \DateTime();
        $this->query = "UPDATE proyectos 
                        SET titulo = :titulo, descripcion = :descripcion, logo = :logo, tecnologias = :tecnologias, updated_at = :update_at
                        WHERE id = :id";
        $this->parametros["titulo"] = $this->titulo;
        $this->parametros["descripcion"] = $this->descripcion;
        $this->parametros["logo"] = $this->logo;
        $this->parametros["tecnologias"] = $this->tecnologias;
        $this->parametros['update_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Mascota modificada';
    }

    //Para eliminar el proyecto que queramos
    public function delete(){
        $this->query = "DELETE FROM proyectos WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Proyecto eliminado';
    }

    //Para obtener todos los trabajos
    public function getAll(){
        $this->query = "SELECT * FROM proyectos";
        $this->get_results_from_query();
        return $this->rows;
    }

    //Para obtener los proyectios del usuario indicado que tiene visibles
    public function getVisibles($id = ""){
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Proyectos encontrados';
        } else {
            $this->mensaje = 'No ahí ningun proyecto';
        }
        return $this->rows ?? null;
    }

    public function getProyectsVisible() {
        $this->query = "SELECT * FROM proyectos WHERE id = :id AND visible = 1";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();

        if (count($this->rows) == 1) {
            $this->query = "UPDATE proyectos SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 0;
            $this->get_results_from_query();
        } else {
            $this->query = "UPDATE proyectos SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 1;
            $this->get_results_from_query();
        }
    }
}