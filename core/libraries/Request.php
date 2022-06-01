<?php

namespace Zero\libraries;

use stdClass;

class Request{
    public $post;
    public $get;

    function __construct($getData)
    {
        $this->post = (object) $_POST;
        $this->file = (object) $_POST;
        $this->get = $getData;
    }
}