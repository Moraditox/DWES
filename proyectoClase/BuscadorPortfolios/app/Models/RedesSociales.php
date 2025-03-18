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

class RedesSociales extends DBAbstractModel{
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
    private $redes_socialescol;
    private $url;
    private $create_at;
    private $updated_at;
    private $visible;
    private $usuarios_id;

    //Creo los setters
    public function setId($id) {
        $this->id = $id;
    }
    public function setRedSocial($redes_socialescol) {
        $this->redes_socialescol = $redes_socialescol;
    }
    public function setUrl($url) {
        $this->url = $url ;
    }
    public function setVisible($visible){
        $this->visible = $visible;
    }
    public function setUsuariosId($usuarios_id) {
        $this->usuarios_id = $usuarios_id ;
    }

    //Creo los getters
    public function getId() {
        return $this->id;
    }
    public function getRedesSociales() {
        return $this->redes_socialescol;
    }
    public function getUrl() {
        return $this->url;
    }
    public function getVisible(){
        return $this->visible;
    }
    public function getUsuariosId() {
        return $this->usuarios_id;
    }
    

    /*Método para insertar datos en la tabla usuarios*/
    public function set() {
        $this->query = "INSERT INTO redes_sociales(redes_socialescol, url, visible, usuarios_id) 
                VALUES (:redes_socialescol, :url, :visible, :usuarios_id)";

        $this->parametros["redes_socialescol"] = $this->redes_socialescol;
        $this->parametros["url"] = $this->url;
        $this->parametros["visible"] = $this->visible;
        $this->parametros["usuarios_id"] = $_SESSION["usuario"]["id"];

        $this->get_results_from_query();
        $this->mensaje = "Red Social añadida";
        return $this->mensaje;
    }

    //Para obtener un usuario por su nombre y contraseña
    public function get($id = ""){
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :usuarios_id";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Redes sociales encontradas';
        } else {
            $this->mensaje = 'No ahí ninguna red social';
        }
        return $this->rows ?? null;
    }

    //Para editar Usuarios
    public function edit(){
        $fecha = new \DateTime();
        $this->query = "UPDATE redes_sociales SET redes_socialescol = :redes_socialescol, url = :url, visible = :visible, updated_at = :update_at
                        WHERE id = :id"; 
        $this->parametros['redes_socialescol'] = $this->redes_socialescol;
        $this->parametros['url'] = $this->url;
        $this->parametros["visible"] = $this->visible;
        $this->parametros['update_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Red Social modificada';
    }

    //Para eliminar el ultimo perro creado
    public function delete(){
        $this->query = "DELETE FROM redes_sociales WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Red Social eliminada';
    }

    //Para obtener todos los trabajos
    public function getAll(){
        $this->query = "SELECT * FROM redes_sociales";
        $this->get_results_from_query();
        return $this->rows;
    }

    //Para obtener los proyectios del usuario indicado que tiene visibles
    public function getVisibles($id = ""){
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros["usuarios_id"] = $id;
        $this->get_results_from_query();
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Redes Sociales encontradas';
        } else {
            $this->mensaje = 'No ahí ninguna red social';
        }
        return $this->rows ?? null;
    }

    public function getRedSocialVisible() {
        $this->query = "SELECT * FROM redes_sociales WHERE id = :id AND visible = 1";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();

        if (count($this->rows) == 1) {
            $this->query = "UPDATE redes_sociales SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 0;
            $this->get_results_from_query();
        } else {
            $this->query = "UPDATE redes_sociales SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 1;
            $this->get_results_from_query();
        }
    }
}