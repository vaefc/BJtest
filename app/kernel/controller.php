<?php
// Base controller class

class Controller {

    public $model;
    public $view;

    function __construct(){
        $this->view = new View();
    }

    function method_index(){
    }

}