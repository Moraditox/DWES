<?php

namespace App\Models;

require_once("DBAbstractModel.php");


class Usuarios extends DBAbstractModel
{


    private static $instancia;
    // Patron singleton, no puedo tener dos objetos de la clase usuario
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }


    // Atributos de la clase

    private $id;
    private $usuario;
    private $password;

    private $nombre;

    private $perfil;


    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    // Función para insertar un nuevo usuario
    public function set()
    {
        // Realizamos la consulta de inserción
        $this->query = "INSERT INTO usuarios (usuario, nombre, password, perfil) VALUES (:nombre, :usuario, :password, :perfil)";
        // Agregamos los parámetros para la consulta
        $this->parametros['usuario'] = $this->usuario;
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['password'] = $this->password;
        $this->parametros['perfil'] = $this->perfil;
        // Ejecutamos la consulta
        $this->get_results_from_query();
        // Retornamos el mensaje de éxito
        $this->mensaje = 'Usuario agregado exitosamente';
    }

    // Función para obtener un usuario por id

    public function get($id = '')
    {
        // Si se pasa un id se realiza la consulta  
        $this->query = 'SELECT * FROM usuarios WHERE id = :id';
        // Agregamos el parámetro id
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        $usuario = $this->rows[0] ?? null;
        return $usuario;
    }


    // Función para editar un usuario

    public function edit()
    {
        $this->query = "UPDATE usuarios SET usuario = :usuario, nombre = :nombre, password = :password, perfil = :perfil WHERE id = :id";
        $this->parametros['usuario'] = $this->usuario;
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['password'] = $this->password;
        $this->parametros['perfil'] = $this->perfil;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario actualizado exitosamente';
    }

    // Función para eliminar un usuario

    public function delete()
    {
        $this->query = 'DELETE FROM usuarios WHERE id = :id';
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario eliminado';
    }


    public function getAll()
    {
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getByUsuario($usuario)
    {
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $this->parametros['usuario'] = $usuario;
        $this->get_results_from_query();
        return $this->rows[0] ?? null;
    }
    public function getConductoresPorNombre($nombre)
    {
        $this->query = "SELECT * FROM usuarios WHERE perfil = 'conductor' AND nombre LIKE :nombre";
        $this->parametros['nombre'] = '%' . $nombre . '%';
    
        // Depurar la consulta y el parámetro
        var_dump($this->parametros['nombre']); // Verificar qué valor está recibiendo
        $this->get_results_from_query();
        return $this->rows;
    }
    
}
