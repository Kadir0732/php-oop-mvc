<?php
namespace Zero\libraries;

use dbConfig;
use PDOException;

class Model{
    public function db()
    {
        try{
            return new DB("mysql:host=".dbConfig::$DBConfig["host"].";dbname=".dbConfig::$DBConfig["dbname"].";charset=".dbConfig::$DBConfig["charset"].";",dbConfig::$DBConfig["username"],dbConfig::$DBConfig["password"]);
           }
           catch(PDOException $e){
                echo $e;
           }
    }
}