<?php

use Zero\libraries\Controller;

class home extends Controller{
    public function index($request){
       view("anasayfa",[
           "title"=>"anasayfa başlık"
       ]);
    }
}