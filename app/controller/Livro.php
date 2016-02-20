<?php
class Livro extends Controller
{
	public function __construct()
	{
		parent::__construct();
		Security::validate_login();
		$this->setModel('LivroModel');
	}

	public function listar()
	{
		$this->view->set_content('livro');
	}

	public function add()
	{
		if ($this->model->insert($_POST)) {
			echo 'Livro cadastrado com sucesso!';
		} else {
			echo 'Erro ao cadastrar o livro!';
		}
	}

	public function edit()
	{
		$data['livro_codigo']     = (string) $_POST['livro_codigo'];
		$data['livro_titulo']     = (string) $_POST['livro_titulo'];
		$data['livro_edicao']     = (string) $_POST['livro_edicao'];
		$data['livro_resumo']     = (string) $_POST['livro_resumo'];
		$data['livro_publicacao'] = (string) $_POST['livro_publicacao'];
		$data['livro_status']     = (string) $_POST['livro_status'];
		$data['categoria_id']     = (string) $_POST['categoria_id'];
		$data['tipo_id']          = (string) $_POST['tipo_id'];
		$data['editora_id']       = (string) $_POST['editora_id'];
		$data['autor_id']         = (string) $_POST['autor_id'];

		if ($this->model->update(array('livro_id'=>$_POST['livro_id']), $data)){
			echo "Registro alterado com sucesso!";
		} else {
			echo "Erro ao alterar o registro!";
		}
	}

	public function delete($id)
	{
		if ($this->model->delete('livro_id', $id)) {
			echo "Registro apagado com sucesso!";
		} else {
			echo "Erro ao excluir o registro!";
		}
	}

	public function get()
	{    
		header('Content-Type: application/json');
		echo json_encode($this->model->selectCannom(array('livro_id', 'livro_codigo', 'livro_titulo', 'livro_status')));
	}

	public function get_livro($id)
	{
		header('Content-Type: application/json');
		$id = (integer) $id;
		echo json_encode($this->model->get_livro($id));
	}

	public function search()
	{
		if (count($_POST)) {
			header('Content-Type: application/json');
			$data['livro_search'] = (string) $_POST['livro_search'];
			$data['livro_filter'] = (string) $_POST['livro_filter'];
			echo json_encode($this->model->search($data));
		}
	}

	public function detalhes($id = null)
	{
		$id = (integer) $id;
		header('Content-Type: application/json');
		echo json_encode($this->model->detalhes($id));
	}
}