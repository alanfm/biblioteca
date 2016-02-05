<?php

class Estado extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('EstadoModel');
  }

  public function get_estado(){
    header('Content-Type: application/json');
    echo json_encode($this->model->get_estado());
  }
}