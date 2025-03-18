<?php

namespace App\Core;

class Router
{
    private $routers = array();
    public function add($route){
        $this->routers[] = $route;
    }

    public function match (string $request) {
         $matches = array();
         foreach ($this->routers as $route) {
            $patron=$route['path'];
            if (preg_match($patron, $request)) {
                $matches = $route;
                // Comprobar si el usuario está verificado
                if (isset($_SESSION['usuario']['verificado']) && !$_SESSION['usuario']['verificado'] && $route['name'] !== 'verificar') {
                    // Mostrar un mensaje y detener la ejecución si el usuario no está verificado
                    echo "Tu cuenta no está verificada. Revisa tu correo electrónico para activarla.";
                    exit();
                }
            }
        }
        return $matches; 
    }
}

?>