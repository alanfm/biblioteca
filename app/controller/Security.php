<?php

class Security  extends Controller{
  private $usuario_model;

  public function __construct() {
    parent::__construct();

    if (isset($_SESSION['token'])){
      App::redirect('home');
    }

    $this->usuario_model = new UsuarioModel();
    $this->view->set_content('security_login');
  }

  public function login() {
    $data = $this->usuario_model->get_usuario_by_pass_login(addslashes($_POST['usuario_login']), addslashes($_POST['usuario_senha']));
    
    if (count($data) > 0) {
      $_SESSION['login'] = $data[0]['usuario_login'];
      $_SESSION['email'] = $data[0]['usuario_email'];
      $_SESSION['id'] = $data[0]['usuario_id'];
      $_SESSION['token'] = md5($data[0]['usuario_login']);
      App::redirect('home');
    } else {
      App::redirect('security');
    }
  }

  public function logout() {
    session_unset();
    session_destroy();
    App::redirect('security');
  }

  public static function validate_login(){
    if (empty($_SESSION['token'])) {
      App::redirect('security');
    }
  }
}