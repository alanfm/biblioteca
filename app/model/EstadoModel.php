<?php

class EstadoModel extends Model {
  public function __construct() {
    parent::__construct(array('estado'));
  }

  public function get_estado() {
    $cols = array('estado_id', 'estado_nome');

    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity).';';

    $rows = array();

    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }
}