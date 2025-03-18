<?php

/**
 * Herencia
 */

require_once "01-clase.php";

class Alumno extends Persona {
    private $_nie;

    public function saluda(){
        echo parent::saludo();
        echo "Soy un alumno";
    }

}