<?php
class Tipo extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('TipoModel');
  }

  public function listar() {
    $this->view->set_content('tipo');
  }

  public function add() {
    if ($this->model->insert($_POST)) {
      echo 'Tipo cadastrado com sucesso!';
    } else {
      echo 'Erro ao cadastrar tipo!';
    }
  }

  public function edit() {
    $data['tipo_descricao'] = (string) $_POST['tipo_descricao'];

    if ($this->model->update(array('tipo_id'=>$_POST['tipo_id']), $data)){
      echo "Tipo alterado com sucesso!";
    } else {
      echo "Erro ao alterar o registro!";
    }
  }

  public function delete($id) {
    if ($this->model->delete('tipo_id', $id)) {
      echo "Registro apagado com sucesso!";
    } else {
      echo "Erro ao excluir o registro!";
    }
  }

  public function get() {    
    header('Content-Type: application/json');
    echo json_encode($this->model->selectCannom(array('tipo_id', 'tipo_descricao')));
  }

  public function get_tipo($id){
    header('Content-Type: application/json');
    $id = (integer) $id;
    echo json_encode($this->model->get_tipo_by_id($id));
  }

  public function search() {
    if (count($_POST)) {
      header('Content-Type: application/json');
      echo json_encode($this->model->search($_POST));
    }
  }
}