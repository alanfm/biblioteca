<?php

class Usuario extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('UsuarioModel');
  }

  public function cadastrados(){
    $this->view->set_content('usuario_cadastrados');
  }

  public function add() {
    // Criptografa a senha
    if (isset($_POST['usuario_senha'])) {
      $_POST['usuario_senha'] = password_hash($_POST['usuario_senha'], PASSWORD_DEFAULT);
    }
    // Insere os valores no banco de dados
    if ($this->model->insert($_POST)) {
      echo 'Usuário cadastrado com sucesso!';
    } else {
      echo 'Erro ao cadastrar usuário!';
    }
  }

  public function listar() {
    header('Content-Type: application/json');
    echo json_encode($this->model->selectCannom(array('usuario_id', 'usuario_login', 'usuario_email')));
  }

  public function buscar() {    
    header('Content-Type: application/json');
    echo json_encode($this->model->buscar($_POST));
  }

  public function excluir($id) {
    if ($this->model->delete('usuario_id', $id)) {
      echo "Registro apagado com sucesso!";
    } else {
      echo "Erro ao excluir o registro!";
    }
  }

  public function editar() {
    $data['usuario_login'] = $_POST['usuario_login'];
    $data['usuario_email'] = $_POST['usuario_email'];

    if (isset($_POST['usuario_senha'])) {
      $data['usuario_senha'] = password_hash($_POST['usuario_senha'], PASSWORD_DEFAULT);
    }

    if ($this->model->update(array('usuario_id'=>$_POST['usuario_id']), $data)){
      echo "Usuario alterado com sucesso!";
    } else {
      echo "Erro ao alterar o registro!";
    }
  }

  public function get_usuario($id) {
    header('Content-Type: application/json');
    $id = (integer) $id;
    echo json_encode($this->model->get_usuario_by_id($id));
  }
}