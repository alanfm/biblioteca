<?php
class Serie extends Controller {
  public function __construct(){
    parent::__construct();
    Security::validate_login();
    $this->setModel('SerieModel');
  }

  public function listar() {
    $this->view->set_content('serie');
  }

  public function add() {
    if ($this->model->insert($_POST)) {
      echo 'serie cadastrado com sucesso!';
    } else {
      echo 'Erro ao cadastrar serie!';
    }
  }

  public function editar() {
    $data['serie_ano'] = $_POST['serie_ano'];
    $data['serie_turma'] = $_POST['serie_turma'];
    $data['serie_turno'] = $_POST['serie_turno'];
    if ($this->model->update(array('serie_id' => $_POST['serie_id']), $data)){
      echo "serie alterado com sucesso!";
    } else {
      echo "Erro ao alterar o registro!";
    }
  }


  public function delete($id) {
    if ($this->model->delete('serie_id', $id)) {
      echo "Registro apagado com sucesso!";
    } else {
      echo "Erro ao excluir o registro!";
    }
  }

  public function get() {    
    header('Content-Type: application/json');
    echo json_encode($this->model->selectCannom(array('serie_id', 'serie_ano', 'serie_turma', 'serie_turno')));
  }

  public function get_serie($id){
    $id = (integer) $id;
    header('Content-Type: application/json');
    echo json_encode($this->model->get_serie($id));
  }
  
  public function search() {
    if (count($_POST)) {
      header('Content-Type: application/json');
      echo json_encode($this->model->search($_POST));
    }
  }
}