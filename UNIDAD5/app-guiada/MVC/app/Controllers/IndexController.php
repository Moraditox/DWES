<?php
namespace App\Controllers;

// Definimos la clase que extiende de base controller
class IndexController extends BaseController{
    public function IndexAction()
    {
        $data = array('message' => 'Hola Mundo');
        $this->renderHTML('..\app\views\index_view.php', $data);
    }

    public function SaludoAction($request)
    {
        $frase = explode("/", $request);
        $nombre = end($frase);
        $data = array('message' => $nombre);
        $this->renderHTML('..\app\views\saludo_view.php', $data);
    }

    public function NumerosAction()
    {
        $this->renderHTML('..\app\views\numeros_view.php');
    }

    public function ParesAction($request)
    {
        $data = array('message' => $request);
        $this->renderHTML('..\app\views\pares_view.php', $data);
    }
}

?>