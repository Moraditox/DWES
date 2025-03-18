<?php
/**
 *
 * Archvio de la clase UsuariosController
 *  
 * @autor Héctor Mora Sánchez
 * @date 2025-05-10
*/
namespace App\Controllers;

require_once "../app/Lib/function.php";
use App\Models\Multas;

class MultasController extends BaseController {
    public function DeleteMulta() {
        $lprocesaFormulario = false;
        $data = array();
        $data['idMulta'] = "";
        if (isset($_POST["pagar"])) {
            $data["idMulta"] = clearData($_POST["idMulta"]);
            $lprocesaFormulario = true;
            if (empty($data['idMulta'])) {
                $lprocesaFormulario = false;
                $mesajeError = "Todos los campos son obligatorios";
                $_SESSION["mensaje"] = ["texto" => $mesajeError];
                header('Location: /multas');
            }
        }
        if ($lprocesaFormulario) {
            $objMulta = Multas::getInstancia();
            $objMulta->setId($data['idMulta']);
            $objMulta->delete();
            header('Location: /multas');
        }
    }
}