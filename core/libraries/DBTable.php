<?php
namespace Zero\libraries;
use PDO;

class DBTable
{
    protected $tableName;
    protected $db;

    public function __construct($tableName = "", PDO $db)
    {
        $this->tableName = $tableName;
        $this->db = $db;
    }

    public function select()
    {
        $select = $this->db->prepare("SELECT * FROM " . $this->tableName);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_OBJ);
    }
    public function insert($objData)
    {
        $data = (array) $objData;
        $keys = "";
        $value = [];
        $i = 0;
        $endWord = "";
        foreach (array_keys($data) as $result) {
            $i++;
            if (count(array_keys($data)) == $i) {
                $endWord = "";
            } else {
                $endWord = ",";
            }
            $keys = $keys . $result . "=:" . $result . $endWord;
        }
        foreach ($data as $result => $key) {
            $value[$result] = $key;
        }
        $insert = $this->db->prepare("INSERT INTO " . $this->tableName . " SET " . $keys);
        return $insert->execute($value);
    }
    public function update($id = [], $objData)
    {
        $data = (array) $objData;
        $keys = "";
        $scrpt = [];
        $value = [];
        $i = 0;
        $j = 0;
        $endWord = "";
        foreach (array_keys($data) as $result) {
            $i++;
            if (count(array_keys($data)) == $i) {
                $endWord = "";
            } else {
                $endWord = ",";
            }
            $keys = $keys . $result . "=:" . $result . $endWord;
        }
        foreach ($data as $result => $key) {
            $value[$result] = $key;
        }
        $update = $this->db->prepare("UPDATE " . $this->tableName . " SET " . $keys . " WHERE " . $id["key"] . "=:id");
        $value[$id["key"]] = $id["value"];
        foreach ($value as $row => $key) {
           
            $scrpt[":".$row] = $key;
        }
        array_pop($scrpt);
        $scrpt[":id"]=$id["value"];

        return $update->execute($scrpt);
  
    }
    public function delete($id)
    {
        $delete = $this->db->prepare("DELETE FROM " . $this->tableName . " WHERE " . $id["key"] . "=:id");
        return $delete->execute([
            ":id" => $id["value"]
        ]);
    }
    public function find($id,$mode="fetch_All")
    {
        $find = $this->db->prepare("SELECT * FROM " . $this->tableName . " WHERE " . $id["key"] . "=:id");
        $find->execute([
            ":id" => $id["value"]
        ]);
        if($mode == "fetch_All"){
            return $find->fetchAll(PDO::FETCH_OBJ);
        }
        else if($mode == "fetch"){
        return $find->fetch(PDO::FETCH_OBJ);
        }
        else{
            return "err! fetch mode unknown";
        }
    }
}
