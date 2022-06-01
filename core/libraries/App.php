<?php 
namespace Zero\libraries;

class App{
public function Run($use = false)
{
// // $authControl = new AuthControl();
// // echo $authControl->isAuth("users","kadir","");
// if($use)
//     $use();
require_once realpath(".")."/helpers/helpers.php";
require_once realpath(".")."/config/app.php";
require_once realpath(".")."/config/db.php";
require_once realpath(".")."/router.php";

}
}
