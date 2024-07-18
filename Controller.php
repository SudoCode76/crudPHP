<?php
require_once 'Model.php';

class Controller {
    private $model;

    public function __construct(){
        $this->model = new Model();
    }

    public function login($username, $password){
        return $this->model->login($username, $password);
    }
}
?>
