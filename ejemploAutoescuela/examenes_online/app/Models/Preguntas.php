<?php

namespace App\Models;

require_once("DBAbstractModel.php");

class Preguntas extends DBAbstractModel
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
    private $id_examen;
    private $enunciado;
    private $opcion_a;
    private $opcion_b;
    private $opcion_c;
    private $opcion_d;
    private $respuesta_correcta;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdExamen()
    {
        return $this->id_examen;
    }

    public function setIdExamen($id_examen)
    {
        $this->id_examen = $id_examen;
    }

    public function getEnunciado()
    {
        return $this->enunciado;
    }

    public function setEnunciado($enunciado)
    {
        $this->enunciado = $enunciado;
    }

    public function getOpcionA()
    {
        return $this->opcion_a;
    }

    public function setOpcionA($opcion_a)
    {
        $this->opcion_a = $opcion_a;
    }

    public function getOpcionB()
    {
        return $this->opcion_b;
    }

    public function setOpcionB($opcion_b)
    {
        $this->opcion_b = $opcion_b;
    }

    public function getOpcionC()
    {
        return $this->opcion_c;
    }

    public function setOpcionC($opcion_c)
    {
        $this->opcion_c = $opcion_c;
    }

    public function getOpcionD()
    {
        return $this->opcion_d;
    }

    public function setOpcionD($opcion_d)
    {
        $this->opcion_d = $opcion_d;
    }

    public function getRespuestaCorrecta()
    {
        return $this->respuesta_correcta;
    }

    public function setRespuestaCorrecta($respuesta_correcta)
    {
        $this->respuesta_correcta = $respuesta_correcta;
    }

    public function getAll()
    {
        $this->query = 'SELECT * FROM preguntas';
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO preguntas (id_examen, enunciado, opcion_a, opcion_b, opcion_c, opcion_d, respuesta_correcta) VALUES (:id_examen, :enunciado, :opcion_a, :opcion_b, :opcion_c, :opcion_d, :respuesta_correcta)";
        $this->parametros['id_examen'] = $this->id_examen;
        $this->parametros['enunciado'] = $this->enunciado;
        $this->parametros['opcion_a'] = $this->opcion_a;
        $this->parametros['opcion_b'] = $this->opcion_b;
        $this->parametros['opcion_c'] = $this->opcion_c;
        $this->parametros['opcion_d'] = $this->opcion_d;
        $this->parametros['respuesta_correcta'] = $this->respuesta_correcta;
        $this->get_results_from_query();
    }

    public function edit()
    {
        $this->query = "UPDATE preguntas SET id_examen = :id_examen, enunciado = :enunciado, opcion_a = :opcion_a, opcion_b = :opcion_b, opcion_c = :opcion_c, opcion_d = :opcion_d, respuesta_correcta = :respuesta_correcta WHERE id = :id";
        $this->parametros['id_examen'] = $this->id_examen;
        $this->parametros['enunciado'] = $this->enunciado;
        $this->parametros['opcion_a'] = $this->opcion_a;
        $this->parametros['opcion_b'] = $this->opcion_b;
        $this->parametros['opcion_c'] = $this->opcion_c;
        $this->parametros['opcion_d'] = $this->opcion_d;
        $this->parametros['respuesta_correcta'] = $this->respuesta_correcta;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function delete()
    {
        $this->query = "DELETE FROM preguntas WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function get($id = '')
    {
        $this->query = 'SELECT * FROM preguntas WHERE id = :id';
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Pregunta encontrada';
        } else {
            $this->mensaje = 'Pregunta no encontrada';
        }
        return $this->rows[0] ?? null;
    }

    public function getRandomByExamen($examenId)
    {
        $this->query = "SELECT * FROM preguntas WHERE id_examen = :id_examen ORDER BY RAND()";
        $this->parametros['id_examen'] = $examenId;
        $this->get_results_from_query();
        return $this->rows;
    }
    
}