<?php

namespace App\Models;

use App\Models\Asignaturas;
require_once("DBAbstractModel.php");

class Examenes extends DBAbstractModel
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
    private $id_asignatura;
    private $titulo;
    private $fecha;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdAsignatura()
    {
        return $this->id_asignatura;
    }

    public function setIdAsignatura($id_asignatura)
    {
        $this->id_asignatura = $id_asignatura;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getAll()
    {
        $this->query = 'SELECT * FROM examenes';
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO examenes (id_asignatura, titulo, fecha) VALUES (:id_asignatura, :titulo, :fecha)";
        $this->parametros['id_asignatura'] = $this->id_asignatura;
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['fecha'] = $this->fecha;
        $this->get_results_from_query();
    }

    public function edit()
    {
        $this->query = "UPDATE examenes SET id_asignatura = :id_asignatura, titulo = :titulo, fecha = :fecha WHERE id = :id";
        $this->parametros['id_asignatura'] = $this->id_asignatura;
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['fecha'] = $this->fecha;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function delete()
    {
        $this->query = "DELETE FROM examenes WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function get($id = '')
    {
        // Si se pasa un id se realiza la consulta  
        $this->query = 'SELECT * FROM examenes WHERE id = :id';
        // Agregamos el parámetro id
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Examen encontrado';
        } else {
            $this->mensaje = 'Examen no encontrado';
        }
        $examen = $this->rows[0] ?? null;

        // Obtengo los datos del examen

        // En un futuro obtendremos más detalles del examen

        return $examen;
    }

    

    public function getRandomByAsignatura()
    {
        // Crear la instancia de Asignaturas y obtener una asignatura aleatoria
        $asignatura = Asignaturas::getInstancia()->getRandom();
        
        if (!$asignatura) {
            return null; // Si no se encontró ninguna asignatura, retornamos null
        }
    
        // Obtener un examen aleatorio de esta asignatura
        $this->query = "SELECT * FROM examenes WHERE id_asignatura = :id_asignatura ORDER BY RAND() LIMIT 1";
        $this->parametros['id_asignatura'] = $asignatura['id'];
        $this->get_results_from_query();
    
        return $this->rows ? $this->rows[0] : null;
    }
    
}