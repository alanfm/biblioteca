<?php

class AutorModel extends Model {
  public function __construct() {
    parent::__construct(array('autor'));
  }

  public function search($data) {
    $cols = array('autor_id', 'autor_nome');

    $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
    $sql .= $data['autor_filter']." LIKE '%".$data['autor_search']."%';";

    $rows = array();

    foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }

  public function get_autor_by_id($id) {
    $cols = array('autor_id', 'autor_nome');
    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity)." WHERE autor_id = ".$id;

    $rows = array();
    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows['key'] = $row;
    }

    return $row;
  }
}