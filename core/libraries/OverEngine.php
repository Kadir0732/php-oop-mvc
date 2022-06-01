<?php

namespace Zero\libraries;


class OverEngine extends overEngineParse{
    public function view($view,$data){

        $pageContent = file_get_contents(realpath(".")."/app/views/".$view.".php");
        
        $this->render($view,$pageContent,$data);
    }
}