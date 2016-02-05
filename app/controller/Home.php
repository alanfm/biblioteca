<?php

class Home extends Controller {
  public function __construct() {
    parent::__construct();

    Security::validate_login();
    
    $this->view->set_content('home');
  }
}