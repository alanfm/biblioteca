<?php

class Cidade extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('CidadeModel');
  }

  public function get_cidade_by_estado($id){
    header('Content-Type: application/json');
    $id = (integer) $id;
    echo json_encode($this->model->get_cidade_by_estado($id));
  }
}