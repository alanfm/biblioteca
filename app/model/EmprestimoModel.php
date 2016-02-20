<?php

class EmprestimoModel extends Model
{
    public function __construct()
    {
        parent::__construct(array('emprestimo'));
    }

    public function get_livro($emprestimo_id)
    {
        // Colunas que seram retornado os valores
        $cols = array('livro_codigo', 'livro_titulo', 'lista_livro_id');
        // Tabelas que serão usadas na consulta
        $entites = array('livro AS li', 'emprestimo AS em', 'lista_livros AS ll');
        // Condições da consulta
        $conds = array('ll.emprestimo_id = '.$emprestimo_id,
                       'll.livro_id = li.livro_id');

        // String com a query sql
        $sql = 'SELECT DISTINCT '.implode(', ', $cols).' FROM '.implode(', ', $entites).' WHERE '.implode(' AND ', $conds).';';

        // Armazena as linhas que seram retornadas na consulta
        $rows = array();

        // Percorre o resultado da consulta
        foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $rows[] = $row;
        }

        // Retorna o resultado
        return $rows;
    }

    public function get_emprestimos()
    {
        $sql = 'SELECT * FROM emprestimos_realizados';

        $rows = array();

        foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $row['emprestimo_data_fim'] = $row['emprestimo_data_fim'] > date('Y-m-d')? false: true;
            $rows[] = $row;
        }

        return $rows;
    }

    public function emprestimo_close($id)
    {
        $sql = 'UPDATE '.implode(', ', $this->entity).' SET emprestimo_status=\'0\' WHERE emprestimo_id = '.$id;

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute()? true: false;
    }

    public function emprestimo_renew($id, $date)
    {
        $sql = 'UPDATE '.implode(', ', $this->entity).' SET emprestimo_status=\'1\', emprestimo_data_fim=\''.$date.'\' WHERE emprestimo_id = '.$id;
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute()? true: false;
    }

    public function search($data)
    {
        $sql = 'SELECT * FROM emprestimos_realizados WHERE emprestimo_id=\''.$data['emprestimo_search'].'\'';
        $rows = array();
        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function report_by_id($id)
    {
        $cols    = array('em.emprestimo_id',
                         'em.emprestimo_data_inicio',
                         'em.emprestimo_data_fim',
                         'pe.pessoa_id',
                         'pe.pessoa_nome',
                         'll.lista_livro_id');

        $entites = array('lista_livros AS ll',
                         'pessoa AS pe',
                         'emprestimo AS em');

        $conds   = array('em.emprestimo_id = '.$id,
                         'll.emprestimo_id = em.emprestimo_id',
                         'em.pessoa_id = pe.pessoa_id');

        $sql = 'SELECT DISTINCT '.implode(', ', $cols).' FROM '.implode(', ', $entites).' WHERE '.implode(' AND ', $conds);

        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            return $row;
        }
    }

    public function lista_livro($id)
    {
        $cols = array('li.livro_titulo', 'li.livro_codigo');
        $entites = array('livro AS li', 'lista_livros AS ll', 'emprestimo AS em');
        $conds = array('ll.emprestimo_id='.$id, 'll.livro_id=li.livro_id');

        $sql = 'SELECT DISTINCT '.implode(', ', $cols).' FROM '.implode(', ', $entites).' WHERE '.implode(' AND ', $conds).';';

        $rows = array();

        foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $rows[] = $row;
        }

        return $rows;
    }
}