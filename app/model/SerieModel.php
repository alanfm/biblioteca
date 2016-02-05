<?php

class SerieModel extends Model {
  public function __construct() {
    parent::__construct(array('serie'));
  }

  public function search($data) {
    $cols = array('serie_id', 'serie_ano', 'serie_turma', 'serie_turno');

    $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
    $sql .= $data['serie_filter']." LIKE '%".$data['serie_search']."%';";

    $rows = array();

    foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }

  public function get_serie($id) {
    $cols = array('serie_id', 'serie_ano', 'serie_turma', 'serie_turno');
    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity)." WHERE serie_id=".$id.";";

    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $row = $row;
    }

    return $row;
  }
}