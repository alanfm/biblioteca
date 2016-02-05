<?php

class CategoriaModel extends Model {
  public function __construct() {
    parent::__construct(array('categoria'));
  }

  public function search($data) {
    $cols = array('categoria_id', 'categoria_descricao');

    $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
    $sql .= $data['categoria_filter']." LIKE '%".$data['categoria_search']."%';";

    $rows = array();

    foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }

  public function get_categoria_by_id($id) {
    $cols = array('categoria_id', 'categoria_descricao');
    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity)." WHERE categoria_id = ".$id;

    $rows = array();
    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows['key'] = $row;
    }

    return $row;
  }
}