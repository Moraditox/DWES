<?

/**
*  Funcion para limpar los datos de entrada en un formulario
 * @param mixed $data
 * @return string
 */
function clearData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return$data;
}