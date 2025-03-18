<?php

namespace App\Controllers;

use App\Models\Notas;

class NotasController extends BaseController
{
    public function indexAction()
    {
        $notas = Notas::getInstancia()->getByUsuario($_SESSION['user_id']);
        $data['notas'] = $notas;
        $this->renderHTML('../app/views/notas_view.php', $data);
    }
}