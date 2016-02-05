<?php

class EditoraModel extends Model {
  public function __construct() {
    parent::__construct(array('editora'));
  }

  public function search($data) {
    $cols = array('editora_id', 'editora_nome');

    $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
    $sql .= $data['editora_filter']." LIKE '%".$data['editora_search']."%';";

    $rows = array();

    foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }

  public function get_editora_by_id($id) {
    $cols = array('editora_id', 'editora_nome');
    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity)." WHERE editora_id = ".$id;

    $rows = array();
    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows['key'] = $row;
    }

    return $row;
  }
}