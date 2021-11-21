<?php
require_once "./sys/model/abstracts/ModelManager.php";
require_once "./config/db.php";
class Model implements ModelManager{
    public function db(){
       try{
        return new PDO("mysql:host=".dbConfig::$DBConfig["host"].";dbname=".dbConfig::$DBConfig["dbname"].";charset=".dbConfig::$DBConfig["charset"].";",dbConfig::$DBConfig["username"],dbConfig::$DBConfig["password"]);
       }
       catch(PDOException $e){
            echo $e;
       }
    }
}