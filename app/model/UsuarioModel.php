<?php

class UsuarioModel extends Model {
  public function __construct() {
    parent::__construct(array('usuario'));
  }

  public function buscar($data) {
    $cols = array('usuario_id', 'usuario_login', 'usuario_email');

    $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
    $sql .= $data['usuario_filter']." LIKE '%".$data['usuario_search']."%';";

    $rows = array();

    foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows[] = $row;
    }

    return $rows;
  }

  public function get_usuario_by_id($id) {
    $cols = array('usuario_id', 'usuario_login', 'usuario_email');
    $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity)." WHERE usuario_id = ".$id;

    $rows = array();
    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      $rows['key'] = $row;
    }

    return $row;
  }

  public function get_usuario_by_pass_login($login, $password) {
    $sql = 'SELECT * FROM '.implode(',', $this->entity).
           " WHERE usuario_login = '".$login."';";

    $rows = array();

    foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
      if (password_verify($password, $row['usuario_senha'])) {
        $row['usuario_senha'] = true;
        $rows[] = $row;
      }
    }

    return $rows;
  }
}