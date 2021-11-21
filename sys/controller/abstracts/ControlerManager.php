<?php
interface ControllerManager{
    public function view($view,$viewData);
    public function model($model);
}