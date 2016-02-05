<?php
class Autor extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('AutorModel');
  }

  public function listar() {
    $this->view->set_content('autor');
  }

  public function add() {
    if ($this->model->insert($_POST)) {
      echo 'Autor cadastrada com sucesso!';
    } else {
      echo 'Erro ao cadastrar autor!';
    }
  }

  public function edit() {
    $data['autor_nome'] = (string) $_POST['autor_nome'];

    if ($this->model->update(array('autor_id'=>$_POST['autor_id']), $data)){
      echo "Autor alterado com sucesso!";
    } else {
      echo "Erro ao alterar o registro!";
    }
  }

  public function delete($id) {
    if ($this->model->delete('autor_id', $id)) {
      echo "Registro apagado com sucesso!";
    } else {
      echo "Erro ao excluir o registro!";
    }
  }

  public function get() {    
    header('Content-Type: application/json');
    echo json_encode($this->model->selectCannom(array('autor_id', 'autor_nome')));
  }

  public function get_autor($id){
    header('Content-Type: application/json');
    $id = (integer) $id;
    echo json_encode($this->model->get_autor_by_id($id));
  }

  public function search() {
    if (count($_POST)) {
      header('Content-Type: application/json');
      echo json_encode($this->model->search($_POST));
    }
  }
}