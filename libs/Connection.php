<?php

class Connection
{
  private $host;
  private $dbname;
  private $user;
  private $password;

  private static $instance = null;

  private function __construct()
  {
    try {
      self::$instance = new PDO('mysql:host=localhost;port=3306;dbname=biblioteca;charset=utf8', 'root', 'qwe123');
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Erro no banco de dados: " . $e->getMessage());
    }
  }

  public static function getInstance()
  {
    if (self::$instance == null) {
      new Connection();
    }
    return self::$instance;
  }
}