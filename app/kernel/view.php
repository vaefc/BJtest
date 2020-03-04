<?php
// Base view class

class View{
    function render($content, $template, $data = null, $is_admin = 0){
        include 'app/views/'.$template;
    }
}