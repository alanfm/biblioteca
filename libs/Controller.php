<?php

class Controller {
  protected $view;
  protected $model;

  public function __construct() {
    $this->view = new View();
  }

  public function show() {
    $this->view->show();
  }

  public function setModel($model) {
    $this->model = new $model;
  }
}