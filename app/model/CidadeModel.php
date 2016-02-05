<?php

class CidadeModel extends Model
{
  public function __construct()
  {
    parent::__construct(array('cidade'));
  }

  public function get_cidade_by_estado($id)
  {
    $cols = array('cidade_id', 'cidade_nome');

    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity)." WHERE estado_id = ".$id;

    $rows = array();

    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }
}