<?php
namespace App\Models;

use App\Models\Comment;

class Blog_old extends DBAbstractModel{
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
    private $title;
    private $author;
    private $blog;
    private $image;
    private $tags;
    private $created_at;
    private $updated_at;

    private $comments = [];

    //Creame los setters
    public function setId($id) {
        $this->id = $id;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function setBlog($blog) {
        $this->blog = $blog;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    public function setTags($tags) {
        $this->tags = $tags;
    }
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    //Creame los getters
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getBlog() {
        return $this->blog;
    }
    public function getImage() {
        return $this->image;
    }
    public function getTags() {
        return $this->tags;
    }
    public function getComments() {
        return $this->comments;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getUpdatedAt() {
        return $this->updated_at;
    }
    

    public function addComment($comentario){
        $this->comments[] = $comentario;
    }

    public function set(){
        $this->query = "INSERT INTO blog(title, author, blog, image, tags) 
                VALUES (:title, :author, :blog, :image, :tags)";

        $this->parametros["title"] = $this->title;
        $this->parametros["author"] = $this->author;
        $this->parametros["blog"] = $this->blog;
        $this->parametros["image"] = $this->image;
        $this->parametros["tags"] = $this->tags;

        $this->get_results_from_query();
        $this->id = $this->lastInsert();
        $this->mensaje = "Blog añadido";

        $comment = Comment_old::getInstancia();
        foreach($this->comments as $comentario){
            $comentario->setBlog($this->id);
            $comentario->set();
        }
        return $this->mensaje;
    }
    public function get(){}
    public function edit(){}
    public function delete() {}
}
?>