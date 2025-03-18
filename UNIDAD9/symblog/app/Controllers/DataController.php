<?php
namespace App\Controllers;

use App\Models\{Blog, Comment};

class DataController {
    public function ActionBlog(){
        require '../app/Config/datos.php';

        foreach($blogs as $blog){
            $blog->set();
        }
    }
}
?>