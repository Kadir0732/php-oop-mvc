<?php

namespace Zero\libraries;

use PDO;

class AuthControl
{
    public function __construct()
    {
        ob_start();
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        if(empty($_SESSION)){
        $_SESSION["_auth"] = [];
        }
    }
    public function setAuth(String $userName, String $password)
    {
        $_SESSION["_auth"] = [
            "userName" => $userName,
            "password" => $password
        ];
    }
    public function getAuth()
    {
        if ($_SESSION["_auth"] == []) {
            return false;
        } else {
            return (object) $_SESSION["_auth"];
        }
    }
    public function removeAuth()
    {
        session_unset();
    }
    public function isAuth($userName, $password,$tableName = "users")
    {
        $dataAccsess = new Model();
        $user = $dataAccsess->db()->defaultDB()->prepare("SELECT * FROM " . $tableName . " WHERE name = :userName && password = :password");
        $user->execute([
            "userName" => $userName,
            "password" => $password,
        ]);

        if (0 !=  $user->rowCount()) {
            $_SESSION["_authID"]=$user->fetch(PDO::FETCH_OBJ)->userId;
            return true;
        } else {
            return false;
        }
    }
}
