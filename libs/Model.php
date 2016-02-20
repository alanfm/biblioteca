<?php

class Model
{
    protected $entity;
    protected $conn;

    public function __construct($entity = array())
    {
        $this->conn = Connection::getInstance();
        $this->entity = $entity;
    }

    public function insert($data)
    {
        $sql = "INSERT INTO " . implode(", ", $this->entity) . " (" . implode(", ", array_keys($data)) . ")" . " VALUES (";
        $values = "";

        foreach ($data as $k => $v) {
            $values .= ":{$k}, ";
        }

        $sql .= substr($values, 0, -2) . ");";

        $stmt = $this->conn->prepare($sql);
        $i = 1;

        foreach ($data as $k => $v) {
            $stmt->bindValue(":$k", $v, self::getTypePDO($v));
        }

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    public function delete($key, $value)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . implode(", ", $this->entity) . " WHERE $key = $value;");
        /*
        $stmt->bindValue(":key", $key, self::getType($key));
        $stmt->bindValue(":value", $value, self::getType($value));
        */
        return $stmt->execute()? true: false;
    }

    public function update($param, $data)
    {
        $sql = 'UPDATE ' . implode(',', $this->entity) . ' SET ';

        foreach ($data as $k=>$v) {
            $sql .= $k . " = '$v', ";
        }

        $sql = substr($sql, 0, -2) . ' WHERE ';

        foreach($param as $k => $v) {
            $sql .= "$k = $v;";
        }

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute()? true: false;
    }

    public function selectCannom($cols = array('*'))
    {
        $sql = 'SELECT '.implode(", ", $cols).' FROM '.implode(',', $this->entity).';';

        $rows = array();

        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $rows[] = $row;
        }

        return $rows;
    }

    public static function getTypePDO($data)
    {
        switch($data) {
            case is_bool($data):
                return PDO::PARAM_BOOL;
            case is_null($data):
                return PDO::PARAM_NULL;
            case is_int($data):
                return PDO::PARAM_INT;
            case is_string($data):
                return PDO::PARAM_STR;
            default:
                return PDO::PARAM_STR;
        }
    }
}