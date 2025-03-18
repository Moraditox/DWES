<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\Multas;
use App\Models\Sanciones;

class MultasController extends BaseController
{
   
    public function MultasAction()
    {
        $data = [];

        $multas = Multas::getInstancia();
        $sancion = Sanciones::getInstancia();

        $idMulta = explode('/', $_SERVER['REQUEST_URI'])[3];

        $data['multa'] = $multas->getMulta($idMulta);

        if ($data['multa'][0]['id_conductor'] != $_SESSION['user_id']) {
            header('Location: /');
            exit();
        }

        $data['sancion'] = $sancion->getTipo($data['multa'][0]['id_tipo_sanciones']);
       
        if (isset($_POST['enviar'])) {
            $multas->pagarMulta($idMulta);

            header('Location: /');
        } else {
            $this->renderHTML('../app/views/pagar_view.php', $data);
        }
    }

    public function NuevaMultaAction(){
        $data = [];
        $lProcesaFormulario = false;

        $data['matricula'] = $data['descripcion'] = $data['fecha'] = $data['importe'] = $data['descuento'] = $data['estado'] = '';
        $data['msjErrorMatricula'] = $data['msjErrorDescripcion'] = $data['msjErrorFecha'] = $data['msjErrorImporte'] = $data['msjErrorDescuento'] = $data['msjErrorEstado'] = $data['msjErrorTipo'] = '';

        $multas = Multas::getInstancia();
        $sancion = Sanciones::getInstancia();
        $usuarios = Usuarios::getInstancia();

        $data['usuarios'] = $usuarios->getAll();

        $data['sancion'] = $sancion->getAll();

        if(isset($_POST['enviar'])){
            $lProcesaFormulario = true;

            $_POST['tipo'] = $_POST['tipo'] ?? '';

            $data['matricula'] = $_POST['matricula'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['fecha'] = $_POST['fecha'];
            $data['importe'] = $_POST['importe'];
            $data['descuento'] = $_POST['descuento'];
            $data['estado'] = 'pendiente';
            $data['tipo'] = $_POST['tipo'];
            $data['usuario'] = $_POST['usuario'];


            if($data['matricula'] == ''){
                $lProcesaFormulario = false;
                $data['msjErrorMatricula'] = 'Debes rellenar la matricula';
            }

            if($data['descripcion'] == ''){
                $lProcesaFormulario = false;
                $data['msjErrorDescripcion'] = 'Debes rellenar la descripcion';
            }

            if($data['fecha'] == ''){
                $lProcesaFormulario = false;
                $data['msjErrorFecha'] = 'Debes rellenar la fecha';
            }

            if($data['importe'] == ''){
                $lProcesaFormulario = false;
                $data['msjErrorImporte'] = 'Debes rellenar el importe';
            }

            if($data['descuento'] == ''){
                $lProcesaFormulario = false;
                $data['msjErrorDescuento'] = 'Debes rellenar el descuento';
            }

            if($data['tipo'] == ''){
                $lProcesaFormulario = false;
                $data['msjErrorTipo'] = 'Debes seleccionar un tipo de sancion';
            }

            if($lProcesaFormulario){
                $multas->setMatricula($data['matricula']);
                $multas->setDescripcion($data['descripcion']);
                $multas->setFecha($data['fecha']);
                $multas->setImporte($data['importe']);
                $multas->setDescuento($data['descuento']);
                $multas->setEstado($data['estado']);
                $multas->setIdAgente($_SESSION['user_id']);
                $multas->setIdConductor($data['usuario']);
                $multas->setIdTipoSanciones($data['tipo']);

                $multas->set();

                // var_dump($multas->set()); die();

                header('Location: /');
            }


        }

        $this->renderHTML('../app/views/nueva_multa_view.php', $data);
    }

}
?>