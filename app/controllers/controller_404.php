<?php

class Controller_404 extends Controller{

    function method_index()
    {
        $this->view->render('404_view.php', 'layout_view.php');
    }

}
