<?php
require_once "./sys/controller/abstracts/ControlerManager.php";
class Controler implements ControllerManager{
    public $get = [];
    public function __construct($pathData)
    {
         $this->get = $pathData;
    }
    public function view($view,$viewData = []){
        $viewFile = "./app/views/$view.php";
        if(file_exists($viewFile)){
            extract($viewData);
            require_once $viewFile;
        }
        else{
            echo "Not Find View File!";
        }
    }
    public function model($model){
        $modelFile = "./app/models/$model.php";
        if(file_exists($modelFile)){
            require_once $modelFile;
            if(class_exists($model)){
                return new $model();
            }
            else{
                echo "Not Find Model Class Name!";
            }
        }
        else{
            echo "Not Find Model File!";
        }
    }
}