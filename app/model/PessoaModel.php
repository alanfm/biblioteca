<?php

class PessoaModel extends Model {
  public function __construct() {
    parent::__construct(array('pessoa'));
  }

  public function search($data) {
    $cols = array('pessoa_id', 'pessoa_nome');

    $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
    $sql .= $data['pessoa_filter']." LIKE '%".$data['pessoa_search']."%';";

    $rows = array();

    foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }

  public function get_pessoa_by_id($id) {
    $cols = array('*');
    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',', $this->entity)." WHERE pessoa_id = ".$id;

    $rows = array();
    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows['key'] = $row;
    }

    return $row;
  }

  public function get_endereco_id($id)
  {
    foreach($this->conn->query('SELECT endereco_id FROM '.implode(',', $this->entity).' WHERE pessoa_id = '.$id, PDO::FETCH_ASSOC) as $row) {
      return $row['endereco_id'];
    }
  }

  public function get_pessoa($id)
  {
    $sql = "SELECT DISTINCT pessoa_id, pessoa_nome, pessoa_pai, pessoa_mae, pessoa_data, pessoa_rg, pessoa_cpf, pessoa_telefone, pessoa_email, pessoa_status, p.endereco_id, e.endereco_logradouro,e.endereco_numero, e.endereco_complemento, e.endereco_cep, e.endereco_bairro, e.cidade_id, c.estado_id, serie_id, vinculo_id ".
           "FROM pessoa AS p, endereco AS e, cidade AS c, estado AS es ".
           "WHERE p.endereco_id = e.endereco_id AND e.cidade_id = c.cidade_id AND c.estado_id AND es.estado_id AND pessoa_id = '$id';";
  
    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      return $row;
    }
  }

  public function detalhes($id)
  {
    $sql = "SELECT DISTINCT pessoa_nome, pessoa_pai, pessoa_mae, pessoa_data, pessoa_rg, pessoa_cpf, pessoa_telefone, pessoa_email, pessoa_status, vinculo_descricao, serie_ano, serie_turma, serie_turno, endereco_logradouro, endereco_numero, endereco_complemento, endereco_cep, endereco_bairro, cidade_nome, estado_nome".
           " FROM pessoa, vinculo, serie, endereco, cidade, estado".
           " WHERE pessoa.endereco_id = endereco.endereco_id AND pessoa.vinculo_id = vinculo.vinculo_id AND pessoa.serie_id = serie.serie_id AND endereco.cidade_id = cidade.cidade_id AND cidade.estado_id = estado.estado_id AND pessoa_id=".$id;

    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      return $row;
    }
  }
}