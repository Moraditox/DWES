<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\Multas;
use App\Models\Sanciones;

class AdminController extends BaseController
{
    // Acción para mostrar la búsqueda de conductores
    public function BuscarConductoresAction()
{
    $usuarios = Usuarios::getInstancia();
    $data = [];

    // Verifica si el usuario es un administrador
    if ($_SESSION['perfil_usuario'] != 'admin') {
        header('Location: /');
        exit();
    }

    if (isset($_POST['query'])) {
        $busqueda = $_POST['query'];
        $data['conductores'] = $usuarios->getConductoresPorNombre($busqueda);

        // Para cada conductor, obtenemos los puntos y el número de sanciones
        foreach ($data['conductores'] as &$conductor) {
            $multas = Multas::getInstancia();
            $multasDelConductor = $multas->getMultasByConductor($conductor['id']);
            $conductor['puntos'] = count($multasDelConductor);
            $conductor['num_sanciones'] = count($multasDelConductor);
        }
    }

    $this->renderHTML('../app/views/index_view.php', $data);
}
    
}
