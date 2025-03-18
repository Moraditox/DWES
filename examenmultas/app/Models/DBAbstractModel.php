<?php
/**
 *
 * Archivo de la clase DBAbstractModel
 *  
 * @autor Nombre Autor 
 * @date Fecha de creacion 
*/
namespace APP\Models;

abstract class DBAbstractModel {
    private static $db_host = DBHOST;
    private static $db_user = DBUSER;
    private static $db_pass = DBPASS;
    private static $db_name = DBNAME;
    private static $db_port = DBPORT;
    protected $mensaje = '';
    protected $conn; // Manejador de la BD
    // Manejo básico para consultas.
    protected $query; // consulta
    protected $parametros = array(); // parámetros de entrada
    protected $rows = array(); // array con los datos de salida
    // Métodos abstractos para implementar en los diferentes módulos.
    abstract protected function get();
    abstract protected function set();
    abstract protected function edit();
    abstract protected function delete();
    // Crear conexión a la base de datos.
    protected function open_connection() {
        $dsn = 'mysql:host=' . self::$db_host . ';dbname=' . self::$db_name . ';port=' . self::$db_port;
        try {
            $this->conn = new \PDO($dsn, self::$db_user, self::$db_pass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $this->conn;
        } catch (\PDOException $e) {
            printf("Conexión fallida: %s\n", $e->getMessage());
            exit();
        }
    }
    // Método que devuelve el último id introducido.
    public function lastInsert() {
        return $this->conn->lastInsertId();
    }
    // Desconectar la base de datos.
    private function close_connection() {
        $this->conn = null;
    }
    // Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    // Consulta que no devuelve tuplas de la tabla
    protected function execute_single_query() {
        if ($_POST) {
            $this->open_connection();
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute($this->parametros);
            $this->close_connection();
        } else {
            $this->mensaje = 'Método no permitido';
        }
    }
    // Obtener resultados de una consulta
    protected function get_results_from_query() {
        $this->open_connection();
        $stmt = $this->conn->prepare($this->query);
        $stmt->execute($this->parametros);
        $this->rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->close_connection();
    }
}
?>
