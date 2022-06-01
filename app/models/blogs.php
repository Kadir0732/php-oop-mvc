<?php

use Zero\libraries\Model;

class blogs extends Model{
    public function getAllBlog()
    {
        return $this->db()->table("blog")->select();
    }
    public function setBlog($blog)
    {
        return $this->db()->table("blog")->insert($blog);
    }
}