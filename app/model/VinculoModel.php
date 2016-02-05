<?php

class VinculoModel extends Model
{
    public function __construct() 
    {
        parent::__construct(array('vinculo'));
    }

    public function search($data) 
    {
        $cols = array('vinculo_id', 'vinculo_descricao');

        $sql = 'SELECT '.implode(',', $cols).' FROM '.implode(',', $this->entity).' WHERE ';
        $sql .= $data['vinculo_filter']." LIKE '%".$data['vinculo_search']."%';";

        $rows = array();

        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function get() 
    {
        $cols = array('vinculo_id', 'vinculo_descricao');
        $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity);

        $rows = array();

        foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function get_by_id($id)
    {
        $cols = array('vinculo_id', 'vinculo_descricao');
        $sql = "SELECT ".implode(',',$cols)." FROM ".implode(',',$this->entity).' WHERE vinculo_id='.$id;

        foreach($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $row = $row;
        }

        return $row;
    }
}