<?php

namespace App\Models;

require_once("DBAbstractModel.php");

class Notas extends DBAbstractModel
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
    private $id_usuario;
    private $id_examen;
    private $nota;
    private $fecha_realizacion;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getIdExamen()
    {
        return $this->id_examen;
    }

    public function setIdExamen($id_examen)
    {
        $this->id_examen = $id_examen;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    public function getFechaRealizacion()
    {
        return $this->fecha_realizacion;
    }

    public function setFechaRealizacion($fecha_realizacion)
    {
        $this->fecha_realizacion = $fecha_realizacion;
    }

    public function getAll()
    {
        $this->query = 'SELECT * FROM notas';
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO notas (id_usuario, id_examen, nota, fecha_realizacion) VALUES (:id_usuario, :id_examen, :nota, :fecha_realizacion)";
        $this->parametros['id_usuario'] = $this->id_usuario;
        $this->parametros['id_examen'] = $this->id_examen;
        $this->parametros['nota'] = $this->nota;
        $this->parametros['fecha_realizacion'] = $this->fecha_realizacion;
        $this->get_results_from_query();
    }

    public function edit()
    {
        $this->query = "UPDATE notas SET id_usuario = :id_usuario, id_examen = :id_examen, nota = :nota, fecha_realizacion = :fecha_realizacion WHERE id = :id";
        $this->parametros['id_usuario'] = $this->id_usuario;
        $this->parametros['id_examen'] = $this->id_examen;
        $this->parametros['nota'] = $this->nota;
        $this->parametros['fecha_realizacion'] = $this->fecha_realizacion;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function delete()
    {
        $this->query = "DELETE FROM notas WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function get($id = '')
    {
        // Si se pasa un id se realiza la consulta  
        $this->query = 'SELECT * FROM notas WHERE id = :id';
        // Agregamos el parámetro id
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Nota encontrada';
        } else {
            $this->mensaje = 'Nota no encontrada';
        }
        return $this->rows[0] ?? null;
    }

    public function getByUsuario($id_usuario)
    {
        $this->query = "SELECT n.*, e.titulo AS titulo_examen 
                        FROM notas n 
                        JOIN examenes e ON n.id_examen = e.id 
                        WHERE n.id_usuario = :id_usuario";
        $this->parametros['id_usuario'] = $id_usuario;
        $this->get_results_from_query();
        return $this->rows;
    }
}