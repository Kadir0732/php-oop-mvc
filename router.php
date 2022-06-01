<?php
use Zero\libraries\Router;
// Router::Get("/blog/{user}/yazilar/{yazi}","blog:writers");
// Router::Get("/blog/{user}/{yazi}","blog:writers");
Router::Get("/","home:index");
Router::Get("/blog","blog:index");
// Router::Get("/kullanici/{user}/{deneme}","deneme:index");


// Router::Get("/{id}/{name}",function($id,$name){
// echo $id." ".$name;
// });
// Router::Get("/blog","blog:index");
// Router::Get("/blog/{id}","blog:find");
Router::notFindPage("notFindPage");
