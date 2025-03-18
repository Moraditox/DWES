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

class CategoriaSkill extends DBAbstractModel{
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
    private $categoria;

    //Creo los setters
    public function setCatrgoria($categoria) {
        $this->categoria = $categoria;
    }

    //Creo los getters
    public function getCategoria() {
        return $this->categoria;
    }
    

    /*Método para insertar datos en la tabla usuarios*/
    public function set() {}

    //Para obtener una skill por el usuario que las tiene
    public function get(){
        $this->query = "SELECT * FROM categorias_skills";
        $this->get_results_from_query();
        return $this->rows;
    }

    //Para editar Usuarios
    public function edit(){}

    //Para eliminar el ultimo perro creado
    public function delete(){}
}