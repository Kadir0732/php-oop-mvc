<?php 
namespace Zero\libraries;
use PDO;

class DB{

    protected $db;
    public function __construct($cdn, $userName, $password)
    {
         $this->db = new PDO($cdn, $userName, $password);
    }
    public function table($tableName)
    {
        return new DBTable($tableName,$this->db);
    }
    public function defaultDB(){
        return $this->db;
    }
}