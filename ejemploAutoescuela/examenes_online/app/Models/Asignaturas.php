<?php

namespace App\Models;

require_once("DBAbstractModel.php");

class Asignaturas extends DBAbstractModel
{
    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    private $id;
    private $nombre;
    private $descripcion;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getAll()
    {
        $this->query = 'SELECT * FROM asignaturas';
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO asignaturas (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->get_results_from_query();
    }

    public function edit()
    {
        $this->query = "UPDATE asignaturas SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function delete()
    {
        $this->query = "DELETE FROM asignaturas WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function get($id = "")
    {
        if ($id != "") {
            $this->query = "SELECT * FROM asignaturas WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Asignatura encontrada';
        } else {
            $this->mensaje = 'Asignatura no encontrada';
        }
        return $this->rows;
    }

    public function getRandom()
    {
        $this->query = "SELECT * FROM asignaturas ORDER BY RAND() LIMIT 1";
        $this->get_results_from_query();
        return $this->rows ? $this->rows[0] : null;
    }
    
}