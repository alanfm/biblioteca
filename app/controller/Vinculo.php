<?php
class Vinculo extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Security::validate_login();
        $this->setModel('VinculoModel');
    }

    public function listar()
    {
        $this->view->set_content('vinculo');
    }

    public function add()
    {
        if ($this->model->insert($_POST)) {
            echo 'Vinculo cadastrado com sucesso!';
        } else {
            echo 'Erro ao cadastrar vinculo!';
        }
    }

    public function edit()
    {
        $data['vinculo_descricao'] = (string) $_POST['vinculo_descricao'];

        if ($this->model->update(array('vinculo_id'=>$_POST['vinculo_id']), $data)){
            echo "Vinculo alterado com sucesso!";
        } else {
            echo "Erro ao alterar o registro!";
        }
    }

    public function delete($id)
    {
        if ($this->model->delete('vinculo_id', $id)) {
            echo "Registro apagado com sucesso!";
        } else {
            echo "Erro ao excluir o registro!";
        }
    }

    public function get()
    {    
        header('Content-Type: application/json');
        echo json_encode($this->model->selectCannom(array('vinculo_id', 'vinculo_descricao')));
    }

    public function get_by_id($id)
    {
        header('Content-Type: application/json');
        $id = (integer) $id;
        echo json_encode($this->model->get_by_id($id));
    }

    public function search()
    {
        if (count($_POST)) {
            header('Content-Type: application/json');
            echo json_encode($this->model->search($_POST));
        }
    }
}