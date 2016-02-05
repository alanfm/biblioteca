<?php
class Editora extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('EditoraModel');
  }

  public function listar() {
    $this->view->set_content('editora');
  }

  public function add() {
    if ($this->model->insert($_POST)) {
      echo 'Editora cadastrada com sucesso!';
    } else {
      echo 'Erro ao cadastrar editora!';
    }
  }

  public function edit() {
    $data['editora_nome'] = (string) $_POST['editora_nome'];

    if ($this->model->update(array('editora_id'=>$_POST['editora_id']), $data)){
      echo "Editora alterado com sucesso!";
    } else {
      echo "Erro ao alterar o registro!";
    }
  }

  public function delete($id) {
    if ($this->model->delete('editora_id', $id)) {
      echo "Registro apagado com sucesso!";
    } else {
      echo "Erro ao excluir o registro!";
    }
  }

  public function get() {    
    header('Content-Type: application/json');
    echo json_encode($this->model->selectCannom(array('editora_id', 'editora_nome')));
  }

  public function get_editora($id){
    header('Content-Type: application/json');
    $id = (integer) $id;
    echo json_encode($this->model->get_editora_by_id($id));
  }

  public function search() {
    if (count($_POST)) {
      header('Content-Type: application/json');
      echo json_encode($this->model->search($_POST));
    }
  }
}