<?php
namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\Trabajos;
use App\Models\Proyectos;
use App\Models\RedesSociales;
use App\Models\Skills;

// Definimos la clase que extiende de base controller
class IndexController extends BaseController{
    public function IndexAction()
    {
        $this->renderHTML('/var/www/html/DWES-main/proyectoClase/BuscadorPortfolios/app/Views/index_view.php');
    }

    public function Perfil()
    {
        $this->renderHTML('../app/Views/perfil_view.php');
    }

    public function CierreSesion()
    {
        $this->renderHTML('../app/Models/cierre_sesion.php');
    }

    public function buscarAction()
    {
        $data['usuarios'] = [];
        // Obtener la consulta desde GET
        $query = isset($_GET['q']) ? trim(htmlspecialchars($_GET['q'])) : '';
    
        if (!empty($query)) {
            $claseUsuario = Usuarios::getInstancia();
            $usuarios = $claseUsuario->buscarUsuarios($query) ?? [];
    
            if (!is_array($usuarios)) {
                $usuarios = [];
            }
    
            $data['usuarios'] = $usuarios;
    
            $this->renderHTML('..\app\Views\index_view.php', $data);
        } else {
            header('Location: /');
            exit;
        }
    }
}

?>