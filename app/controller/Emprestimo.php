<?php
class Emprestimo extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Security::validate_login();
        $this->setModel('EmprestimoModel');
    }

    public function listar()
    {
        $data['date_init'] = date("Y-m-d");
        $data['date_end']  = date('Y-m-d', strtotime("+15 days"));
        $this->view->set_content('emprestimo', $data);
    }

    public function emprestimo_add()
    {
        $data['emprestimo_data_inicio'] = (string) $_POST['emprestimo_data_inicio'];
        $data['emprestimo_data_fim']    = (string) $_POST['emprestimo_data_fim'];
        $data['pessoa_id']              = (integer) $_POST['pessoa_id'];

        header('Content-Type: application/json');

        if ($id = $this->model->insert($data)) {
            echo json_encode(array('emprestimo_id'=>$id, 'msg'=>'Registro cadastrado com sucesso!'));
        } else {
            echo json_encode(array('emprestimo_id'=>NULL, 'msg'=>'Erro ao cadastrar o emprestimo!'));
        }
    }

    public function add_livro()
    {
        $data['livro_id']      = (integer) $_POST['livro_id'];
        $data['emprestimo_id'] = (integer) $_POST['emprestimo_id'];
        $this->setModel('ListaLivrosModel');
        header('Content-Type: application/json');
        
        if ($this->model->insert($data))
            echo json_encode(array('msg'=>'Cadastrado com sucesso!'));
        else
            echo json_encode(array('msg'=>'Erro ao cadastrar!'));
    }

    public function get_livro($emprestimo_id)
    {
        header('Content-Type: application/json');
        $emprestimo_id = (integer) $emprestimo_id;
        echo json_encode($this->model->get_livro($emprestimo_id));
    }

    public function delete_lista_livro($id)
    {
        $id = (integer) $id;

        header('Content-Type: application/json');

        $this->setModel('ListaLivrosModel');

        if ($this->model->delete('lista_livro_id', $id)) {
            echo 'Registro excluido com sucesso!';
        } else {
            echo 'Erro ao excluir registro!';
        }
    }

    public function get_emprestimos()
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->get_emprestimos());
    }

    public function emprestimo_close($id)
    {
        $id = (integer) $id;
        header('Content-Type: application/json');

        if ($this->model->emprestimo_close($id)) {
            echo 'Emprestimo encerrado com sucesso!';
        } else {
            echo 'Erro ao encerrar o emprestimo!';
        }
    }

    public function emprestimo_renew($id)
    {
        $id = (integer) $id;
        $date  = date('Y-m-d', strtotime("+15 days"));
        header('Content-Type: application/json');

        if ($this->model->emprestimo_renew($id, $date)) {
            echo 'Emprestimo renovado com sucesso!';
        } else {
            echo 'Erro ao renovar o emprestimo';
        }
    }

    public function search()
    {
        if (count($_POST)) {
            header('Content-Type: application/json');
            $data['emprestimo_search'] = (string) $_POST['emprestimo_search'];
            $data['emprestimo_filter'] = (integer) $_POST['emprestimo_filter'];
            echo json_encode($this->model->search($data));
        }
    }

    public function report($id)
    {
        $id = (integer) $id;
        $data = $this->model->report_by_id($id);
        $data['livro'] = $this->model->lista_livro($id);
        $this->view->set_content('emprestimo_report', $data);
    }
}