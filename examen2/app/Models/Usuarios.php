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
use App\Models\Multas;

class Usuarios extends DBAbstractModel {
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
    private $usuario;
    private $password;
    private $nombre;
    private $perfil;

    private $multas = [];

    //Ahora vamos a hacer los setters y getters
    public function setId($id){
        $this->id = $id;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    public function getId(){
        return $this->id;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getPerfil(){
        return $this->perfil;
    }

    public function set(){

    }

    public function get(){
        $this->query = "SELECT * FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        foreach ($this->rows as &$usuario) {
           
        }
        if (count($this->rows) == 1) {

            $this->mensaje = 'Sesion iniciada';
        } else {
            $this->mensaje = 'Fallo al iniciar sesion';
        }
        return $this->rows[0] ?? null;
    }

    public function getUsuarioByUser(){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
        $this->parametros['usuario'] = $this->usuario;
        $this->parametros['password'] = $this->password;
        $this->get_results_from_query();
        
        if (count($this->rows) == 1) {
            $this->mensaje = 'Sesion iniciada';
        } else {
            $this->mensaje = 'Fallo al iniciar sesion';
        }
        return $this->rows[0] ?? null;
    }

    public function edit(){
        
    }

    public function delete(){
        
    }
}
?>