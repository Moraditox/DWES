<?php
/**
 * Explicación clases
 * @author javier
 */

// Clase Persona
class Persona {
    // Propiedades privadas
    private $_nombre;
    private $_apellido1;
    private $_apellido2;

    /**
     * Constructor con 3 parámetros
     * @param mixed $nombre
     * @param mixed $_apellido1
     * @param mixed $_apellido2
     */
    public function __construct($nombre, $_apellido1, $_apellido2){
        $this->_nombre = $nombre;
        $this->_apellido1 = $_apellido1;
        $this->_apellido2 = $_apellido2;
    }

    /**
     * devuelve un string con el nombre y sus apellidos
     * @return string
     */
    public function nombre(){
        return "$this->_nombre $this->_apellido1 $this->_apellido2";
    }

    /**
     * Devuelve hola mundo y no devuelve nada
     * @return void
     */
    public function saludo(){
        echo "Hola mundo";
    }
}
