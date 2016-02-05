<?php

class EnderecoModel extends Model {
  public function __construct()
  {
    parent::__construct(array('endereco'));
  }

  public function get_endereco($id)
  {
    foreach($this->conn->query('SELECT * FROM ' . implode(',', $this->entity) . ' WHERE endereco_id = ' . $id, PDO::FETCH_ASSOC) as $row) {
        $row = $row;
    }
    return $row;
  }
}