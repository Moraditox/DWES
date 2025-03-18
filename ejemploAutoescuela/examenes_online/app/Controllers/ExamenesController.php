<?php

namespace App\Controllers;

use App\Models\Asignaturas;
use App\Models\Examenes;
use App\Models\Preguntas;
use App\Models\Notas;

class ExamenesController extends BaseController
{
    public function realizarExamenAction()
    {
        // Obtener una asignatura aleatoria
        $asignatura = Asignaturas::getInstancia()->getRandom();

        // Obtener un examen aleatorio de la asignatura
        $examen = Examenes::getInstancia()->getRandomByAsignatura($asignatura['id']);

        // Obtener preguntas aleatorias del examen
        $preguntas = Preguntas::getInstancia()->getRandomByExamen($examen['id']);

        $data['preguntas'] = $preguntas;
        $data['examen_id'] = $examen['id'];
        $this->renderHTML('../app/views/realizar_examen_view.php', $data);
    }

    public function submitExamenAction()
    {
        if (!isset($_POST['respuesta']) || empty($_POST['respuesta'])) {
            die("Error: No se recibieron respuestas.");
        }
    
        $respuestas = $_POST['respuesta']; // Respuestas del usuario
        $nota = 0;
        $totalPreguntas = count($respuestas); // Total de preguntas respondidas
    
        foreach ($respuestas as $idPregunta => $respuestaSeleccionada) {
            $pregunta = Preguntas::getInstancia()->get($idPregunta);
    
            if (!$pregunta) {
                continue; // Si la pregunta no existe, la saltamos
            }
    
            // Verificar si la respuesta seleccionada es correcta
            if (trim(strval($pregunta['respuesta_correcta'])) === trim(strval($respuestaSeleccionada))) {
                $nota++; // Sumamos un punto por respuesta correcta
            }
        }
    
        // Calcular la nota final en base a 10 puntos
        $notaFinal = ($nota / $totalPreguntas) * 10;
    
        // Guardar la nota en la base de datos
        $notaModel = Notas::getInstancia();
        $notaModel->setIdUsuario($_SESSION['user_id']);
        $notaModel->setIdExamen($_POST['examen_id']);
        $notaModel->setNota($notaFinal);
        $notaModel->setFechaRealizacion(date('Y-m-d H:i:s'));
        $notaModel->set();
    
        // Redirigir a la página de notas
        header('Location: /notas');
        exit();
    }
    
}