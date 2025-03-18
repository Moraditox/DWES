<?
/** Array de configuracion */

$examenes = 
    array(
        "examen1" =>
            array(
                "Pregunta1" => array(
                    "tipo" => "checkbox",
                    "pregunta" => "¿Cuales de los siguientes países están en America del Sur?",
                    "respuestas" => array("Brasil", "México", "Argentina", "España"),
                    "solucion" => array("Brasil", "Argentina")
                ),
                "Pregunta2" => array(
                    "tipo" => "checkbox",
                    "pregunta" => "¿Que oceanos rodean al continente africano?",
                    "respuestas" => array("Atlantico", "Indico", "Pacifico", "Artico"),
                    "solucion" => array("Atlantico", "Indico")
                ),
            
                "Pregunta3" => array(
                    "tipo" => "checkbox",
                    "pregunta" => "¿Cuales de las siguientes montañas o sistemas montañosos?",
                    "respuestas" => array("Himalaya", "Amazonas", "Andes", "Rion Nilo"),
                    "solucion" => array("Himalaya", "Andes")
                ),
            
                "Pregunta4" => array(
                    "tipo" => "checkbox",
                    "pregunta" => "¿Que continentes cruzan la linea de ecuador?",
                    "respuestas" => array("Africa", "Asia", "Oceania", "España"),
                    "solucion" => array("Africa", "Oceania")
                ),
            
                "Pregunta5" => array(
                        "tipo" => "radio",
                        "pregunta" => "El desierto del sahara es el mas grande del mundo",
                        "respuestas" => array("true", "false"),
                        "solucion" => "false"
                )
            )
        )
    ;
