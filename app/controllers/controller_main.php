<?php
// Main controller

class Controller_main extends Controller{

    function method_index(){
        $this->view->render('main_view.php', 'layout_view.php');
    }

}