<?php

namespace App\Controllers;

use App\Models\Asignaturas;

class AsignaturasController extends BaseController
{
    public function indexAction()
    {
        $asignaturas = Asignaturas::getInstancia();
        $data['asignaturas'] = $asignaturas->getAll();
        $this->renderHTML('../app/views/asignaturas_view.php', $data);
    }
}