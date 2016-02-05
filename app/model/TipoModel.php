<?php

class TipoModel extends Model {
  public function __construct() {
    parent::__construct(array('tipo'));
  }

  public function search($data) {
    $cols = array('tipo_id', 'tipo_descricao');

    $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
    $sql .= $data['tipo_filter']." LIKE '%".$data['tipo_search']."%';";

    $rows = array();

    foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }

  public function get_tipo_by_id($id) {
    $cols = array('tipo_id', 'tipo_descricao');
    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity)." WHERE tipo_id = ".$id;

    $rows = array();
    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows['key'] = $row;
    }

    return $row;
  }
}