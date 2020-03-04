<?php

//Simple routing

class Route
{
    static function start()
    {
        // by default
        $controller_name = 'Main';
        $method_name = 'index';
        $baseurl = $_SERVER['REQUEST_URI'];
        $gparams = [];
        if (strpos($baseurl,'?')>1) {
            $separator_pos = strpos($baseurl, '?');
            $base = substr($baseurl, 0,$separator_pos);
            $getparams = substr($baseurl, $separator_pos+1);
            $getparams = explode('&',$getparams);
            foreach ($getparams as $params){
                $params = explode('=', $params);
                $gparams[$params[0]] = $params[1];
            }
        } else {
            $base = $baseurl;
        }

        $routes = explode('/', $base);

        // get controller name
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        // get method name
        if (!empty($routes[2])) {
            $method_name = $routes[2];
        }

        // add prefixes
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $method_name = 'method_' . $method_name;

        // include model class file
        $model_file = strtolower($model_name) . '.php';
        $model_path = "app/models/" . $model_file;
        if (file_exists($model_path)) {
            include "app/models/" . $model_file;
        }

        // include controller class file
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "app/controllers/" . $controller_file;

        if (file_exists($controller_path)) {
            include "app/controllers/" . $controller_file;
        } else {
            // simply without exception
            Route::Error404();
        }

        // create controller
        $controller = new $controller_name;
        $method = $method_name;

        if (method_exists($controller, $method)) {
        // call method of controller
            $controller->$method($gparams);
        } else {
        // simply without exception
            Route::Error404();
        }

    }

    static function Error404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}