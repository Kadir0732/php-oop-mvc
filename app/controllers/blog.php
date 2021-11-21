<?php
class blog extends Controler{
    public function writers(){
        echo $this->get["user"]."<br>";
        $users = $this->model("user")->getAllUsers();
      $this->view("blog",[
          "users"=>$users
      ]);
    }
}