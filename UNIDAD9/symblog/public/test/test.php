<?php
use App\Models\Blog;
 
$comments = Blog::find(1)->comments;
 
foreach ($comments as $comment) {
    echo $comment->content;
}
?>