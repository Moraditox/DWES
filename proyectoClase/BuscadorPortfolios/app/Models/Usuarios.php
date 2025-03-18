<?php

/**
 *
 * Archvio de la clase Usuarios
 *  
 * @autor Héctor Mora Sánchez
 * @date 2025-05-10
 */

namespace App\Models;

use App\Models\DBAbstractModel;
use App\Models\Trabajos;
use App\Models\Skills;
use App\Models\Proyectos;
use App\Models\RedesSociales;
use App\Models\CategoriaSkill;
use App\Core\EmailConfig;
use Symfony\Component\Mime\Email;


class Usuarios extends DBAbstractModel
{
    private static $instancia;
    //Patron singleton, no puedo tener dos objetos de la clase mascotas
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
    private $id;
    private $nombre;
    private $apellidos;
    private $foto;
    private $categoria_profesional;
    private $email;
    private $resumen_perfil;
    private $password;
    private $visible;
    private $create_at;
    private $updated_at;
    private $token;
    private $fecha_creacion_token;
    private $cuenta_activa;

    //Variables de todas las tablas del usuario
    private $trabajo = [];
    private $skill = [];
    private $proyecto = [];
    private $redes_sociales = [];

    //Creo los setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setCategoriaProfesional($categoria_profesional)
    {
        $this->categoria_profesional = $categoria_profesional;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setResumenPerfil($resumen_perfil)
    {
        $this->resumen_perfil = $resumen_perfil;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setFechaCreacionToken($fecha_creacion_token)
    {
        $this->fecha_creacion_token = $fecha_creacion_token;
    }

    public function setCuentaActiva($cuenta_activa)
    {
        $this->cuenta_activa = $cuenta_activa;
    }

    //Crero los getters
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getCategoriaProfesional()
    {
        return $this->categoria_profesional;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getResumenPerfil()
    {
        return $this->resumen_perfil;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getFechaCreacionToken()
    {
        return $this->fecha_creacion_token;
    }

    public function getCuentaActiva()
    {
        return $this->cuenta_activa;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    /*Método para insertar datos en la tabla usuarios*/
    public function set()
    {
        $this->query = "INSERT INTO usuarios(nombre, apellidos, foto, categoria_profesional, email, password, visible, token, fecha_creacion_token, cuenta_activa) 
                VALUES (:nombre, :apellidos, :foto, :categoria_profesional, :email, :password, 1, :token, :fecha_creacion_token, 0)";

        $this->parametros["nombre"] = $this->nombre;
        $this->parametros["apellidos"] = $this->apellidos;
        $this->parametros["foto"] = $this->foto;
        $this->parametros["categoria_profesional"] = $this->categoria_profesional;
        $this->parametros["email"] = $this->email;
        $this->parametros["token"] = $this->token;
        $this->parametros["fecha_creacion_token"] = $this->fecha_creacion_token;
        $this->parametros["password"] = $this->password;

        $this->get_results_from_query();
        $this->mensaje = 'Usuario creado';
        return $this->mensaje;
    }

    //Para obtener un usuario por su nombre y contraseña
    public function get()
    {
        $this->query = "SELECT * FROM usuarios WHERE email = :email AND password = :password AND visible = 1 AND cuenta_activa = 1";
        $this->parametros['email'] = $this->email;
        $this->parametros['password'] = $this->password;
        $this->get_results_from_query();
        foreach ($this->rows as &$usuario) {
            $usuario['trabajos'] = Trabajos::getInstancia()->get($usuario['id']);
            $usuario['skills'] = Skills::getInstancia()->get($usuario['id']);
            $usuario['proyectos'] = Proyectos::getInstancia()->get($usuario['id']);
            $usuario['redes'] = RedesSociales::getInstancia()->get($usuario['id']);
            $usuario['categoria_skill'] = CategoriaSkill::getInstancia()->get();
            $usuario['trabajosV'] = Trabajos::getInstancia()->getVisible($usuario['id']);
            $usuario['skillsV'] = Skills::getInstancia()->getVisible($usuario['id']);
            $usuario['proyectosV'] = Proyectos::getInstancia()->getVisible($usuario['id']);
            $usuario['redesV'] = RedesSociales::getInstancia()->getVisible($usuario['id']);
        }
        if (count($this->rows) == 1) {

            $this->mensaje = 'Sesion iniciada';
        } else {
            $this->mensaje = 'Fallo al iniciar sesion';
        }
        return $this->rows[0] ?? null;
    }

    //Para obtener todos los usuarios
    public function getAll()
    {
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        foreach ($this->rows as &$usuario) {
            $usuario['trabajos'] = Trabajos::getInstancia()->get($usuario['id']);
            $usuario['skills'] = Skills::getInstancia()->get($usuario['id']);
            $usuario['proyectos'] = Proyectos::getInstancia()->get($usuario['id']);
            $usuario['redes'] = RedesSociales::getInstancia()->get($usuario['id']);
            $usuario['categoria_skill'] = CategoriaSkill::getInstancia()->get();
            $usuario['trabajosV'] = Trabajos::getInstancia()->getVisibles($usuario['id']);
            $usuario['skillsV'] = Skills::getInstancia()->getVisibles($usuario['id']);
            $usuario['proyectosV'] = Proyectos::getInstancia()->getVisibles($usuario['id']);
            $usuario['redesV'] = RedesSociales::getInstancia()->getVisibles($usuario['id']);
        }
        return $this->rows;
    }

    //Para obtener todos los usuarios visibles
    public function getVisibles()
    {
        $this->query = "SELECT * FROM usuarios WHERE visible = 1";
        $this->get_results_from_query();
        foreach ($this->rows as &$usuario) {
            $usuario['trabajos'] = Trabajos::getInstancia()->get($usuario['id']);
            $usuario['skills'] = Skills::getInstancia()->get($usuario['id']);
            $usuario['proyectos'] = Proyectos::getInstancia()->get($usuario['id']);
            $usuario['redes'] = RedesSociales::getInstancia()->get($usuario['id']);
            $usuario['categoria_skill'] = CategoriaSkill::getInstancia()->get();
            $usuario['trabajosV'] = Trabajos::getInstancia()->getVisible($usuario['id']);
            $usuario['skillsV'] = Skills::getInstancia()->getVisible($usuario['id']);
            $usuario['proyectosV'] = Proyectos::getInstancia()->getVisible($usuario['id']);
            $usuario['redesV'] = RedesSociales::getInstancia()->getVisible($usuario['id']);
        }
        if (count($this->rows) == 1) {

            $this->mensaje = 'Sesion iniciada';
        } else {
            $this->mensaje = 'Fallo al iniciar sesion';
        }
        return $this->rows ?? null;
    }

    //Para editar Usuarios
    public function edit()
    {
        $fecha = new \DateTime();
        $this->query = "UPDATE usuarios 
                        SET nombre = :nombre, apellidos = :apellidos, foto = :foto, categoria_profesional = :categoria_profesional, email = :email, updated_at = :update_at
                        WHERE id = :id";
        $this->parametros["nombre"] = $this->nombre;
        $this->parametros["apellidos"] = $this->apellidos;
        $this->parametros["foto"] = $this->foto;
        $this->parametros["categoria_profesional"] = $this->categoria_profesional;
        $this->parametros["email"] = $this->email;
        $this->parametros['update_at'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Mascota modificada';
    }

    //Para eliminar el ultimo perro creado
    public function delete()
    {
        $this->query = "DELETE FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario eliminado';
    }

    //Método para verificar un token de activación
    public function verificarToken()
    {
        if(isset($_GET['token'])) {
            $token = $_GET['token'];
            $token = str_replace(' ', '+', $token);

            // Verificar si el token existe en la base de datos
            $this->query = "SELECT id, fecha_creacion_token FROM usuarios WHERE token = :token";
            $this->parametros = [':token' => $token];
            $this->get_results_from_query();

            if (empty($this->rows)) {
                $mesajeError = "El token no es válido o ya fue usado";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                return false;
            }

            $usuario_id = $this->rows[0]['id'];
            $fecha_creacion = $this->rows[0]['fecha_creacion_token'];

            // Verificar si el token ha expirado (válido por 24 horas)
            if (strtotime($fecha_creacion) < strtotime('-1 day')) {
                $mesajeError = "El token ha expirado. Solicita un nuevo correo de activación";
                $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
                return false;
            }

            // Activar la cuenta y eliminar el token
            $this->query = "UPDATE usuarios SET cuenta_activa = 1 WHERE id = :id";
            $this->parametros = [':id' => $usuario_id];
            $this->get_results_from_query(); // Usar esta función para UPDATE

            $mesajeError = "Cuenta activada correctamente. Ya puedes iniciar sesión";
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => $mesajeError];
            return true;
        } else {
            $mesajeError = "No se ha recibido un token de activación";
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => $mesajeError];
            return false;

        }
    }

    //Método para enviar un correo de activación
    public function enviarCorreoActivacion()
    {
        $mailer = EmailConfig::getMailer();

        // Validar si el email está definido y es válido
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            error_log("Error: Email no válido o no definido para activación.");
            return;
        }

        // Verificar si el usuario tiene un token
        $this->query = "SELECT token FROM usuarios WHERE email = :email";
        $this->parametros = ['email' => $this->email];
        $this->get_results_from_query();

        if (empty($this->rows[0]['token'])) {
            error_log("Error: No se pudo obtener el token de activación para el usuario {$this->email}.");
            return;
        }

        $token = $this->rows[0]['token'];
        $asunto = "Activa tu cuenta en Portfolio";
        $mensaje = "
            <h2>Bienvenido {$this->nombre}!</h2>
            <p>Para activar tu cuenta, haz clic en el siguiente enlace:</p>
            <a href='http://www.buscador-portfolios.local/verificar?token=$token'>Activar cuenta</a>
            <p>Si no creaste esta cuenta, ignora este correo.</p>
        ";

        $email = (new Email())
            ->from('noreply@portfolio.local')
            ->to($this->email)
            ->subject($asunto)
            ->html($mensaje);

        try {
            $mailer->send($email);
            error_log("Correo de activación enviado correctamente a {$this->email}");
        } catch (\Exception $e) {
            error_log("Error al enviar el correo: " . $e->getMessage());
        }
    }

    public function buscarUsuarios($query)
    {
        if (empty($query)) {return [];}

        $this->query = "SELECT * FROM usuarios 
                        WHERE nombre LIKE :query 
                           OR apellidos LIKE :query 
                           OR email LIKE :query";
        $this->parametros['query'] = '%' . $query . '%';
        $this->get_results_from_query();

        return $this->rows;
    }

    public function getUserVisible() {
        $this->query = "SELECT * FROM usuarios WHERE id = :id AND visible = 1";
        $this->parametros["id"] = $this->id;
        $this->get_results_from_query();

        if (count($this->rows) == 1) {
            $this->query = "UPDATE usuarios SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 0;
            $this->get_results_from_query();
        } else {
            $this->query = "UPDATE usuarios SET visible = :visible WHERE id = :id";
            $this->parametros["visible"] = 1;
            $this->get_results_from_query();
        }
    }
}
