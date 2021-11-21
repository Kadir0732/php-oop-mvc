<?php
class user extends Model{
    public function getAllUsers(){
      return $this->db()->query("select * from users",PDO::FETCH_OBJ);
    }
}