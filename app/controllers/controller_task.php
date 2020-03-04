<?php

class Controller_task extends Controller{

    function __construct(){
        $this->model = new Model_task();
        $this->view = new View();
    }

    function method_index(array $params=null){
        $data = $this->model->get_data($params);
        $this->view->render('task_view.php', 'layout_view.php', $data);
    }

    function method_create(){
        $this->view->render('createtask_view.php', 'layout_view.php');
    }

    function method_store(){
        $data = $this->model->set_data();
        if ($data) {
            //inserted
            $_SESSION['sucsess'] = 'Task added';
            $_SESSION['notsucsess'] = null;
        } else {
            //error
            $_SESSION['notsucsess'] = 'Error adding task';
            $_SESSION['sucsess'] = null;
        }
        header("Location: http://".$_SERVER['HTTP_HOST']."/task");
    }

    function method_update(){
        $data = $this->model->update_data();
        if ($data) {
            //inserted
            $_SESSION['sucsess'] = 'Task edited';
            $_SESSION['notsucsess'] = null;
        } else {
            //error
            $_SESSION['notsucsess'] = 'Error edit task';
            $_SESSION['sucsess'] = null;
        }
        header("Location: http://".$_SERVER['HTTP_HOST']."/task");
    }

    function method_login(){
        $this->view->render('logintask_view.php', 'layout_view.php');
    }

    function method_logout(){
        $_SESSION['isadmin'] = false;
        $_SESSION['sucsess'] = 'You are logged out';
        $_SESSION['notsucsess'] = null;
        header("Location: http://".$_SERVER['HTTP_HOST']."/task");
    }

    function method_checkuser(){
        if (isset($_POST['name']) && $_POST['name'] == 'admin') {
            if (isset($_POST['password']) && md5($_POST['password']) == '202cb962ac59075b964b07152d234b70') {
                $_SESSION['isadmin'] = true;
                $_SESSION['sucsess'] = 'You are logged in';
                $_SESSION['notsucsess'] = null;
            } else {
                $_SESSION['isadmin'] = false;
                $_SESSION['notsucsess'] = 'Bad user name or login';
                $_SESSION['sucsess'] = null;
            }
        } else {
            $_SESSION['isadmin'] = false;
            $_SESSION['notsucsess'] = 'Bad user name or login';
            $_SESSION['sucsess'] = null;
        }
        header("Location: http://".$_SERVER['HTTP_HOST']."/task");
    }

    function method_edit(){
        $this->view->render('edittask_view.php', 'layout_view.php');
    }

    function method_delete(){
        $data = false;

        if (isset($_POST['id']) && is_int((int)$_POST['id'])) {
            $data = $this->model->delete_data($_POST['id']);
        }

        if ($data) {
            //inserted
            $_SESSION['sucsess'] = 'Task deleted';
            $_SESSION['notsucsess'] = null;
        } else {
            //error
            $_SESSION['notsucsess'] = 'Error delete task';
            $_SESSION['sucsess'] = null;
        }
        header("Location: http://".$_SERVER['HTTP_HOST']."/task");
    }

}