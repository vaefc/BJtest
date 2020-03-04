<?php

class Model_task extends Model{

    public $pdo;

    public function __construct(){
        $settings = $this->getPDOSettings();
        $this->pdo = new PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
    }

    protected function getPDOSettings(){
        $config = include ROOTPATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'db.php';
        $result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];
        return $result;
    }

    public function get_data(array $params=null){
        if (!isset($params['dir'])){
            $params['dir'] = 'ASC';
        }
        $dir = ($params['dir']==='ASC')?'ASC':'DESC';
        if (!in_array($params['field'], ['uname', 'email', 'completed'])){
            $params['field'] = 'uname';
        }

        $query = "SELECT COUNT(*) FROM tasks";
        $total = $this->pdo->query($query)->fetchColumn();

        if (is_int((int)$params['page']) && $params['page'] > 0 && $params['page'] <= ceil($total/3)) {
            $page = $params['page']-1;
        } else {
            $page = 0;
        }

        $cur_rec = $page*3;

        $field = $params['field'];
        $query="SELECT * FROM tasks ORDER BY $field $dir LIMIT $cur_rec,3";
        $stmt = $this->pdo->query($query);



        return ['data' => $stmt->fetchAll(), 'order_field' => $field, 'order_dir' => $dir, 'total' => $total, 'page' => $page];
    }

    public function set_data(){
        $query = "INSERT INTO tasks (uname, email, task) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $_POST['uname'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(3, $_POST['task'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update_data(){
        if ($_SESSION['isadmin']) {
            if ($_POST['old_task'] != $_POST['task']) {
                $_POST['edited'] = 1;
            } else {
                if ($_POST['oldedited'] != '1') {
                    $_POST['edited'] = 0;
                }
            }
            if (!isset($_POST['completed']) || $_POST['completed']!='1') {
                $_POST['completed'] = 0;
            }
            $query = "UPDATE tasks SET uname=?, email=?, task=?, edited=?, completed=? WHERE id=?";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $_POST['uname'], PDO::PARAM_STR);
            $stmt->bindParam(2, $_POST['email'], PDO::PARAM_STR);
            $stmt->bindParam(3, $_POST['task'], PDO::PARAM_STR);
            $stmt->bindParam(4, $_POST['edited'], PDO::PARAM_INT);
            $stmt->bindParam(5, $_POST['completed'], PDO::PARAM_INT);
            $stmt->bindParam(6, $_POST['id'], PDO::PARAM_INT);

            return $stmt->execute();

        } else {
            return false;
        }
    }

    public function delete_data($id){
        if ($_SESSION['isadmin']) {
            $query = "DELETE FROM tasks WHERE id=?";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            return false;
        }
    }
}