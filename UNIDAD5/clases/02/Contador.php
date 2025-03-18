<?php

/**
 * Clase Contador
*/

/**
 * Summary of Contador
 */
class Contador {
    private $contador;
    private static $instancia = 0;

    /**
     *  Creat objeto
     * @param mixed $count
     */
    public function __construct($count = 0){
        $this->contador = $count;
        self::$instancia++;
    }

    /**
     * Sumar contador
     * @return static
     */
    public function contar(){
        $this->contador++;
        return $this;
    }


    /**
     * Summary of nInstancias
     * @return mixed
     */
    public static function nInstancias(){
        return self::$instancia;
    }
    
    /**
     * 
     * toString
     * @return string
     */
    public function __toString(){
        return (string) $this->contador;
    }
}   