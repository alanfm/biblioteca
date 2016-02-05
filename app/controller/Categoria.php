<?php
class Categoria extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('CategoriaModel');
  }

  public function listar() {
    $this->view->set_content('categoria');
  }

  public function add() {
    if ($this->model->insert($_POST)) {
      echo 'Categoria cadastrada com sucesso!';
    } else {
      echo 'Erro ao cadastrar Categoria!';
    }
  }

  public function edit() {
    $data['categoria_descricao'] = (string) $_POST['categoria_descricao'];

    if ($this->model->update(array('categoria_id'=>$_POST['categoria_id']), $data)){
      echo "Categoria alterado com sucesso!";
    } else {
      echo "Erro ao alterar o registro!";
    }
  }

  public function delete($id) {
    if ($this->model->delete('categoria_id', $id)) {
      echo "Registro apagado com sucesso!";
    } else {
      echo "Erro ao excluir o registro!";
    }
  }

  public function get() {    
    header('Content-Type: application/json');
    echo json_encode($this->model->selectCannom(array('categoria_id', 'categoria_descricao')));
  }

  public function get_categoria($id){
    header('Content-Type: application/json');
    $id = (integer) $id;
    echo json_encode($this->model->get_categoria_by_id($id));
  }

  public function search() {
    if (count($_POST)) {
      header('Content-Type: application/json');
      echo json_encode($this->model->search($_POST));
    }
  }
}