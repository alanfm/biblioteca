<?php
class Pessoa extends Controller
{
  
    public function __construct()
    {
        parent::__construct();
        Security::validate_login();
        $this->setModel('PessoaModel');
    }

    public function listar()
    {
        $this->view->set_content('pessoa');
    }

    public function add()
    {
        // Pega os campos referentes ao endereço
        $data_endereco['cidade_id']            = (string) $_POST['cidade_id'];
        $data_endereco['endereco_logradouro']  = (string) $_POST['endereco_logradouro'];
        $data_endereco['endereco_numero']      = (string) $_POST['endereco_numero'];
        $data_endereco['endereco_complemento'] = (string) $_POST['endereco_complemento'];
        $data_endereco['endereco_cep']         = (string) $_POST['endereco_cep'];
        $data_endereco['endereco_bairro']      = (string) $_POST['endereco_bairro'];

        // Seta o modelo do endereço
        $this->setModel('EnderecoModel');

            // Insere o endereço e pega o id
            // Verifica se a inserção deu certo
            if ($data_pessoa['endereco_id'] = $this->model->insert($data_endereco)) {
            // Pega os campos referentes a pessoa
            $data_pessoa['pessoa_nome']     = $_POST['pessoa_nome'];
            $data_pessoa['pessoa_pai']      = $_POST['pessoa_pai'];
            $data_pessoa['pessoa_mae']      = $_POST['pessoa_mae'];
            $data_pessoa['pessoa_data']     = $_POST['pessoa_data'];
            $data_pessoa['pessoa_cpf']      = $_POST['pessoa_cpf'];
            $data_pessoa['pessoa_rg']       = $_POST['pessoa_rg'];
            $data_pessoa['pessoa_telefone'] = $_POST['pessoa_telefone'];
            $data_pessoa['pessoa_email']    = $_POST['pessoa_email'];
            $data_pessoa['pessoa_status']   = $_POST['pessoa_status'];
            $data_pessoa['serie_id']        = $_POST['serie_id'];
            $data_pessoa['vinculo_id']      = $_POST['vinculo_id'];

            // Seta o modelo de pessoa
            $this->setModel('PessoaModel');

            // Insere os dados na tabela pessoa
            // Verifica se a inserção deu certo
            if ($this->model->insert($data_pessoa)) {
                // Imprime a mensagens de sucesso
                echo 'Pessoa cadastrada com sucesso!';
            } else {
                // Imprime a mensagem de erro
                echo 'Erro ao cadastrar pessoa!';
            }
        } else {
            // Imprime a mensagem de erro
            echo 'Erro ao cadastrar pessoa!';
        }
    }

    public function edit()
    {
        $data_end['cidade_id']            = (string) $_POST['cidade_id'];
        $data_end['endereco_logradouro']  = (string) $_POST['endereco_logradouro'];
        $data_end['endereco_numero']      = (string) $_POST['endereco_numero'];
        $data_end['endereco_complemento'] = (string) $_POST['endereco_complemento'];
        $data_end['endereco_cep']         = (string) $_POST['endereco_cep'];
        $data_end['endereco_bairro']      = (string) $_POST['endereco_bairro'];

        $this->setModel('EnderecoModel');

        if ($this->model->update(array('endereco_id'=>$_POST['endereco_id']), $data_end)) {
            $data['pessoa_nome']     = (string) $_POST['pessoa_nome'];
            $data['pessoa_pai']      = (string) $_POST['pessoa_pai'];
            $data['pessoa_mae']      = (string) $_POST['pessoa_mae'];
            $data['pessoa_data']     = (string) $_POST['pessoa_data'];
            $data['pessoa_cpf']      = (string) $_POST['pessoa_cpf'];
            $data['pessoa_rg']       = (integer) $_POST['pessoa_rg'];
            $data['pessoa_telefone'] = (string) $_POST['pessoa_telefone'];
            $data['pessoa_email']    = (string) $_POST['pessoa_email'];
            $data['pessoa_status']   = (integer) $_POST['pessoa_status'];
            $data['serie_id']        = (integer) $_POST['serie_id'];
            $data['vinculo_id']      = (integer) $_POST['vinculo_id'];

            $this->setModel('PessoaModel');

            if ($this->model->update(array('pessoa_id'=>$_POST['pessoa_id']), $data)){
                echo "Pessoa alterado com sucesso!";
            } else {
                echo "Erro ao alterar o registro!";
            }
        } else {
            echo "Erro ao alterar o registro!";
        }
    }

    public function delete($id)
    {
        // Pega a coluna endereco_id do registro
        $endereco_id = $this->model->get_endereco_id($id);

        // Verifica se o registro foi excluido
        if ($this->model->delete('pessoa_id', $id)) {
            // Seta para o modelo do endereço
            $this->setModel('EnderecoModel');
            // Verifica se o endereco do registro pessoa foi excluido
            if ($this->model->delete('endereco_id', $endereco_id)) {
                // Imprime a mensagem de sucesso
                echo "Registro apagado com sucesso!";
            }
        // Caso tenha dado erro
        } else {
            // Imprime a mensagem de erro
            echo "Erro ao excluir o registro!";
        }
    }

    public function get()
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->selectCannom(array('pessoa_id', 'pessoa_nome', 'pessoa_status')));
    }

    public function get_pessoa($id)
    {
        header('Content-Type: application/json');
        $id = (integer) $id;
        echo json_encode($this->model->get_pessoa($id));
    }

    public function get_endereco($id)
    {
        header('Content-Type: application/json');
        $id = (integer) $id;
        $this->setModel('EnderecoModel');
        echo json_encode($this->model->get_endereco($id));
    }

    public function search()
    {
        if (count($_POST)) {
            header('Content-Type: application/json');
            echo json_encode($this->model->search($_POST));
        }
    }

    public function get_cidade()
    {
        $this->setModel('CidadeModel');

        header('Content-Type: application/json');
        echo json_encode($this->model->selectCannom(array('cidade_id', 'cidade_nome')));
    }

    public function detalhes($id)
    {
        header('Content-Type: application/json');
        $id = (integer) $id;
        echo json_encode($this->model->detalhes($id));
    }
}