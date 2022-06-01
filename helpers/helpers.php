<?php

use Zero\libraries\OverEngine;

function BaseUrl()
{
    return appConfig::$baseUrl;
}

 function view($view,$viewData = []){
    $viewFile = "./app/views/".$view.".php";
    if(file_exists($viewFile)){
        $overEngine = new OverEngine();

        $overEngine->view($view,$viewData);
    }
    else{
        echo "Not Find View File!";
        die();
    }
}
 function model($model){
    $modelFile = "./app/models/$model.php";
    
    if(file_exists($modelFile)){
        require_once $modelFile;
        if(class_exists($model)){
            return new $model();
        }
        else{
            echo "Not Find model Class Name!";
            die();
        }
    }
    else{
        echo "Not Find model File!";
        die();
    }
}
