<?php
namespace App\Models;

class Comment_old extends DBAbstractModel{
    private static $instancia;

    public static function getInstancia(){
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone() {
        trigger_error("La clonacion no es permitida!.", E_USER_ERROR);
    }

    private $id;
    private $blog_id;
    private $user;
    private $comment;
    private $approved;
    private $created_at;
    private $updated_at;

    public function setBlog($blog_id) {
        $this->blog_id = $blog_id;
    }
    public function setUser($user) {
        $this->user = $user;
    }
    public function setComment($comment) {
        $this->comment = $comment;
    }
    public function setApproved($approved) {
        $this->approved = $approved;
    }
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }
    public function setId($id) {
        $this->id = $id;
    }

    //Creame los getters
    public function getId() {
        return $this->id;
    }
    public function getBlogId() {
        return $this->blog_id;
    }
    public function getUser() {
        return $this->user;
    }
    public function getComment() {
        return $this->comment;
    }
    public function getApproved() {
        return $this->approved;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function set(){
        $this->query = "INSERT INTO comment(blog_id, user, comment, approved) 
                VALUES (:blog_id, :user, :comment, :approved)";

        $this->parametros["blog_id"] = $this->blog_id;
        $this->parametros["user"] = $this->user;
        $this->parametros["comment"] = $this->comment;
        $this->parametros["approved"] = $this->approved ?? 0;

        $this->get_results_from_query();
        $this->mensaje = "Comentario añadido";
        return $this->mensaje;
    }
    public function get(){}
    public function edit(){}
    public function delete() {}
}
?>