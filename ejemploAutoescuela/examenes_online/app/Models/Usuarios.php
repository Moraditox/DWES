<?php

namespace App\Models;

require_once("DBAbstractModel.php");

class Usuarios extends DBAbstractModel
{


    private static $instancia;
    // Patron singleton, no puedo tener dos objetos de la clase usuario
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    // Atributos de la clase

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $token;
    private $foto;
    private $fecha_creacion_token;

    private $visible;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getFechaCreacionToken()
    {
        return $this->fecha_creacion_token;
    }

    public function setFechaCreacionToken($fecha_creacion_token)
    {
        $this->fecha_creacion_token = $fecha_creacion_token;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    // Función para obtener mensaje

    public function getMensaje()
    {
        return $this->mensaje;
    }

    // Función para insertar un nuevo usuario
    public function set()
    {
        // Realizar consulta
        $this->query = "INSERT INTO usuarios(nombre,apellidos,foto,email,password,token,fecha_creacion_token,visible) 
        VALUES(:nombre,:apellidos,:foto,:email,:password,:token,:fecha_creacion_token,:visible)";
        // Agregamos los parametros
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['email'] = $this->email;
        $this->parametros['password'] = $this->password;
        $this->parametros['token'] = $this->token;
        $this->parametros['fecha_creacion_token'] = $this->fecha_creacion_token;
        $this->parametros['visible'] = $this->visible;

        $this->get_results_from_query();
        $this->mensaje = 'Usuario agregado exitosamente';
    }

    // Función para obtener un usuario por id

    public function get($id = '')
    {
        // Si se pasa un id se realiza la consulta  
        $this->query = 'SELECT * FROM usuarios WHERE id = :id';
        // Agregamos el parámetro id
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        $usuario = $this->rows[0] ?? null;

        // Obtengo los datos del usuario

        // En un futuro obtendremos las notas del usuario

        return $usuario;
    }




    // Función para editar un usuario

    public function edit()
    {
        
        $this->query = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, foto = :foto, email = :email, password = :password WHERE id = :id";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['email'] = $this->email;
        $this->parametros['password'] = $this->password;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario modificado';
    }

    // Función para eliminar un usuario

    public function delete()
    {
        $this->query = 'DELETE FROM usuarios WHERE id = :id';
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario eliminado';
    }

    // Función para obtener todos los usuarios

    public function getAll()
    {
        // Si no hay sesión activa (es decir, el usuario no está logueado), solo mostrar usuarios visibles
        if (empty($_SESSION['perfil_usuario'])) {
            $this->query = 'SELECT * FROM usuarios WHERE visible = 1';
        } else {
            // Si hay sesión activa, obtener todos los usuarios
            $this->query = 'SELECT * FROM usuarios';
        }
    
        // Ejecutamos la consulta
        $this->get_results_from_query();
    
        // Retornamos los resultados obtenidos
        return $this->rows;
    }
    
    // Función para comprobar si un email que se le pasa ya se encuentra en la base de datos
    public function emailExists($email)
    {
        $this->query = "SELECT * FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return true;
        } else {
            return false;
        }
    }


    // Función parar comprobar que un email y una contraseña coinciden
    public function emailPasswordExists($email, $password)
    {
        $this->query = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Función para obtener el nombre usando el email
    public function getNameByEmail($email)
    {
        $this->query = "SELECT nombre FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows[0]['nombre'];
        } else {
            return null;
        }
    }

    // Función para obtener el apellido usando el email
    public function getLastNameByEmail($email)
    {
        $this->query = "SELECT apellidos FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows[0]['apellidos'];
        } else {
            return null;
        }
    }

    // Funcion para obtener el perfil del usuario

    public function getUserProfile($email)
    {
        $this->query = "SELECT id, nombre, apellidos, email, password, foto FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows[0];
        } else {
            return null;
        }
    }

    // Funcion para obtener el id de un usuario usando el email
    public function getIdByEmail($email)
    {
        $this->query = "SELECT id FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows[0]['id'];
        } else {
            return null;
        }
    }

    // Funcion para obtener la foto de un usuario usando el email
    public function getFotoByEmail($email)
    {
        $this->query = "SELECT foto FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            return $this->rows[0]['foto'];
        } else {
            return null;
        }
    }

    // Funcion para verificar el token de un usuario usando el email

    // Funcion para obtener el token de un usuario usando el email
    public function verificarToken($token = '')
    {
        $this->query = "SELECT * FROM usuarios WHERE token = :token";
        $this->parametros['token'] = $token;
        $this->get_results_from_query();
        // var_dump($token);die();
        if (count($this->rows) == 1) {
            // Comprobar si el token ha caducado
            $this->fecha_creacion_token = $this->rows[0]['fecha_creacion_token'];
            $fecha_actual = date('Y-m-d H:i:s');
            $diferencia = strtotime($fecha_actual) - strtotime($this->fecha_creacion_token);
            if ($diferencia < 86400) {
                $this->query = "UPDATE usuarios SET token = NULL, fecha_creacion_token = NULL, visible = 1 , cuenta_activa = 1 WHERE token = :token";
                $this->parametros['token'] = $token;
                $this->get_results_from_query();
                $this->mensaje = 'Usuario verificado';
            } else {
                $this->mensaje = 'El token ha caducado';
            }
        } else {
            $this->mensaje = 'Token no encontrado';
        }
    }

    // Funcion para actualizar la foto de un usuario
    public function updateFoto($id = '')
    {
        $this->query = "UPDATE usuarios SET foto = :foto WHERE id = :id";
        $this->parametros['foto'] = $this->foto;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Foto actualizada';
    }



}
