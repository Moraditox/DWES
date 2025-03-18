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

class Skills extends DBAbstractModel{
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
    private $habilidades;
    private $visible;
    private $create_at;
    private $updated_at;
    private $categorias_skills_categoria;
    private $usuarios_id;

    //Creo los setters
    public function setId($id) {
        $this->id = $id;
    }
    public function setHabilidades($habilidades) {
        $this->habilidades = $habilidades;
    }
    public function setVisibles($visible) {
        $this->visible = $visible ;
    }
    public function setCategorias($categorias_skills_categoria) {
        $this->categorias_skills_categoria = $categorias_skills_categoria ;
    }
    public function setUsuariosId($usuarios_id) {
        $this->usuarios_id = $usuarios_id ;
    }

    //Creo los getters
    public function getId() {
        return $this->id;
    }
    public function getHabilidades() {
        return $this->habilidades;
    }
    public function getvisible() {
        return $this->visible;
    }
    public function getCategoriasSkills() {
        return $this->categorias_skills_categoria;
    }
    public function getUsuariosId() {
        return $this->usuarios_id;
    }
    

    /*Método para insertar datos en la tabla usuarios*/
    public function set() {
        $this->query = "INSERT INTO skills(habilidades, categorias_skills_categoria, visible, usuarios_id) 
                VALUES (:habilidades, :categorias_skills_categoria, :visible, :usuarios_id)";

        $this->parametros["habilidades"] = $this->habilidades;
        $this->parametros["categorias_skills_categoria"] = $this->categorias_skills_categoria;
        $this->parametros["visible"] = $this->visible;
        $this->parametros["usuarios_id"] = $this->usuarios_id;

        $this->get_results_from_query();
        $this->mensaje = "Skill añadido";
        return $this->mensaje;
    }

    //Para obtener una skill por el usuario que las tiene
    public function get($id = ""){
        $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        $this->mensaje = (count($this->rows) >= 1) ? 'Skills encontrados' : 'No hay ninguna skill';
        return $this->rows ?? null;
    }

    //Para editar Usuarios
    public function edit(){
        $fecha = new \DateTime();
        $this->query = "UPDATE skills 
                        SET habilidades = :habilidades, categorias_skills_categoria = :categorias_skills_categoria, updated_at = :update_at
                        WHERE id = :id";
        $this->parametros['habilidades'] = $this->habilidades;
        $this->parametros['categorias_skills_categoria'] = $this->categorias_skills_categoria;
        $this->parametros['update_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Skill modificada';
    }

    //Para eliminar el ultimo perro creado
    public function delete(){
        $this->query = "DELETE FROM skills WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Skill eliminada';
    }

    //Para obtener todos los trabajos
    public function getAll(){
        $this->query = "SELECT * FROM skills";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getVisibles($id = ""){
        $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        $this->mensaje = (count($this->rows) >= 1) ? 'Skills encontrados' : 'No hay ninguna skill';
        return $this->rows ?? null;
    }

    public function getSkillVisible() {
        $this->query = "SELECT * FROM skills WHERE id = :id AND visible = 1";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();

        if (count($this->rows) == 1) {
            $this->query = "UPDATE skills SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 0;
            $this->get_results_from_query();
        } else {
            $this->query = "UPDATE skills SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 1;
            $this->get_results_from_query();
        }
    }
}