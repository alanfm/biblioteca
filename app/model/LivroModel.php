<?php

class LivroModel extends Model
{
    public function __construct()
    {
        parent::__construct(array('livro'));
    }

    public function get_livro($id)
    {
        $sql = 'SELECT * FROM '.implode(',', $this->entity).' WHERE livro_id = '.$id;

        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            return $row;
        }
    }
    
    public function search($data)
    {
        $cols = array('livro_id','livro_codigo', 'livro_titulo', 'livro_status');

        $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
        $sql .= $data['livro_filter']." LIKE '%".$data['livro_search']."%';";

        $rows = array();

        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function detalhes($id)
    {
        // As colunas que serão retornadas
        $cols = array('livro_id', 'livro_codigo', 'livro_titulo', 'livro_edicao', 'livro_publicacao', 'livro_resumo', 'livro_status', 'categoria_descricao', 'tipo_descricao', 'editora_nome', 'autor_nome');
        // As tabelas que estão os dados
        $entity = array('livro', 'categoria', 'tipo', 'editora', 'autor');
        // As condições de retorno
        $conds = array('livro_id = '.$id,
                       'livro.categoria_id = categoria.categoria_id',
                       'livro.tipo_id = tipo.tipo_id',
                       'livro.editora_id = editora.editora_id',
                       'livro.autor_id = autor.autor_id');

        $sql = 'SELECT DISTINCT '.implode(', ', $cols).' FROM '.implode(', ', $entity).' WHERE '.implode(' AND ', $conds).';';

        foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            return $row;
        }
    }
}