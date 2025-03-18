import os
import json
import subprocess

def create_project():
    project_name = input("Introduce el nombre del proyecto: ")
    db_user = input("Introduce el nombre de usuario de la base de datos: ")
    db_pass = input("Introduce la contraseña de la base de datos: ")
    server_name = input("Introduce el nombre del host para el Virtual Host: ")

    # Crear carpeta del proyecto
    os.makedirs(project_name, exist_ok=True)
    os.chmod(project_name, 0o777)
    
    # Crear carpetas necesarias antes de escribir archivos
    folders = [
        f"{project_name}/app/Config",
        f"{project_name}/app/Controllers",
        f"{project_name}/app/Core",
        f"{project_name}/app/lib",
        f"{project_name}/app/Models",
        f"{project_name}/app/Views",
        f"{project_name}/public/css",
        f"{project_name}/public/uploads"
    ]
    
    for folder in folders:
        os.makedirs(folder, exist_ok=True)
    
    public_path = os.path.abspath(f"{project_name}/public")

    # Crear archivos en la carpeta del proyecto
    env_content = fr"""DBHOST="localhost"
DBNAME="{db_user}"
DBUSER="root"
DBPASS="{db_pass}"
DBPORT="3306"
"""
    
    env_example_content = r"""DBHOST="localhost"
DBNAME="nombreUsuario"
DBUSER="root"
DBPASS="passwordBBDD"
DBPORT="3306"
"""
    
    gitignore_content = r"""vendor
.env
.htaccess
composer.lock
"""
    
    bootstrap_content = r"""<?php 
require "vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('DBHOST', $_ENV['DBHOST']);
define('DBUSER', $_ENV['DBUSER']);
define('DBPASS', $_ENV['DBPASS']);
define('DBNAME', $_ENV['DBNAME']);
define('DBPORT', $_ENV['DBPORT']);

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
?>
"""
    
    composer_json = {
        "autoload": {
            "psr-4": {
                "App\\": "app/"
            }
        },
        "require": {
            "vlucas/phpdotenv": "^5.6"
        }
    }
    
    htaccess_content = r"""RewriteEngine On

# No redirigir las solicitudes a carpetas de recursos estáticos (CSS, JS, imágenes, etc.)
RewriteCond %{REQUEST_URI} ^/(styles|css|script|imagenes) [NC]
RewriteRule .* - [L]

# Redirige todo lo demás a index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# Para manejar la autorización (opcional, si es necesario)
RewriteCond %{HTTP:Authorization} ^(.+)$
RewriteRule .* - [E=HTTP_AUTHORIZATION:%1]
"""
    
    index_php_content = r"""<?php
    echo "¡Proyecto funcionando!";
?>
"""
    
    db_abstract_model_content = r"""<?php
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
"""

    base_controller_content = r"""<?php
/**Definir espacio de nombres */

namespace App\Controllers;

class BaseController
{
    public function renderHTML($fileName, $data=[])
    {
        include ($fileName);
    }
};

?>
"""

    router_content = r"""<?php
namespace App\Core;

class Router
{
    private $routers = array();
    public function add($route){
        $this->routers[] = $route;
    }

    public function match (string $request) {
         $matches = array();
         foreach ($this->routers as $route) {
            $patron=$route['path'];
            if (preg_match($patron, $request)) {
                $matches = $route;
            }
        }
        return $matches; 
    }
}

?>
"""

    function_content = r"""<?php
/**
 * 
 * FUNCION PARA CONECTARSE A LA BASE DE DATOS
 * 
 * @author Héctor Mora Sánchez
 */

function clearData($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
"""
    
    files = {
        f"{project_name}/.env": env_content,
        f"{project_name}/.envExample": env_example_content,
        f"{project_name}/.gitignore": gitignore_content,
        f"{project_name}/bootstrap.php": bootstrap_content,
        f"{project_name}/composer.json": json.dumps(composer_json, indent=4),
        f"{project_name}/public/.htaccess": htaccess_content,
        f"{project_name}/public/index.php": index_php_content,
        f"{project_name}/app/Models/DBAbstractModel.php": db_abstract_model_content,
        f"{project_name}/app/Controllers/BaseController.php": base_controller_content,
        f"{project_name}/app/Core/Router.php": router_content,
        f"{project_name}/app/lib/function.php": function_content
    }
    
    for path, content in files.items():
        with open(path, "w") as file:
            file.write(content)
    
    # Ejecutar composer install
    os.system(f"cd {project_name} && composer install")

        # Agregar Virtual Host al archivo de configuración de Apache
    vhost_path = "C:\\xampp\\apache\\conf\\extra\\httpd-vhosts.conf"
    vhost_content = f"""
<VirtualHost 127.0.0.1:80>
    DocumentRoot "{public_path}"
    ServerName {server_name}.local

    <Directory "{public_path}">
        Require all granted
        AllowOverride All
        Options Indexes FollowSymLinks
    </Directory>
</VirtualHost>
"""
    
    with open(vhost_path, "a") as vhost_file:
        vhost_file.write(vhost_content)

    # Agregar la entrada al archivo hosts
    add_host_entry(server_name)

    # Reiniciar Apache
    restart_apache()

def add_host_entry(server_name):
    # Ruta al archivo hosts de Windows
    hosts_path = r"C:\Windows\System32\drivers\etc\hosts"
    
    # La línea que queremos agregar
    new_line = f"127.0.0.1 {server_name}.local\n"
    
    # Verificar si la entrada ya existe
    try:
        with open(hosts_path, "r") as file:
            lines = file.readlines()
            
        # Si la línea ya existe, no hacer nada
        if any(new_line.strip() in line for line in lines):
            print(f"La entrada {new_line.strip()} ya está en el archivo hosts.")
            return
        
        # Si la entrada no existe, agregarla
        with open(hosts_path, "a") as file:
            file.write(new_line)
        print(f"Entrada '{new_line.strip()}' agregada correctamente al archivo hosts.")
    
    except PermissionError:
        print("¡Error! Se requieren privilegios de administrador para modificar el archivo hosts.")
        # Ejecutar el script con privilegios de administrador (si no se tiene acceso)
        subprocess.run("runas /user:Administrator \"python script.py\"", shell=True)

def restart_apache():
    try:
        # Detener Apache
        subprocess.run(["C:\\xampp\\xampp-control.exe", "stop", "apache"], check=True)
        # Iniciar Apache nuevamente
        subprocess.run(["C:\\xampp\\xampp-control.exe", "start", "apache"], check=True)
        print("Apache reiniciado con éxito.")
    except subprocess.CalledProcessError as e:
        print(f"Error al reiniciar Apache: {e}")

if __name__ == "__main__":
    create_project()
    print("Proyecto creado con éxito.")