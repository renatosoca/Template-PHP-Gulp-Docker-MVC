<?php

class Connection {
  private ?PDO $connect;

  private string $db_host;
  private string $db_name;
  private string $db_charset;
  private string $db_user;
  private string $db_pass;

  public function __construct() {
    $this->db_host = $_ENV['DB_HOST'] ?? '';
    $this->db_name = $_ENV['DB_NAME'] ?? '';
    $this->db_charset = $_ENV['DB_CHARSET'] ?? '';
    $this->db_user = $_ENV['DB_USER'] ?? '';
    $this->db_pass = $_ENV['DB_PASS'] ?? '';

    $connectionString = "mysql:host=".$this->db_host.";dbname=".$this->db_name.";charset=".$this->db_charset."";
    try{
      $this->connect = new PDO($connectionString, $this->db_user, $this->db_pass);
      $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "conexión";
    }catch(PDOException $e){
      $this->connect = null;
      echo "ERROR: " . $e->getMessage();
    }
  }

  public function connect() {
    return $this->connect;
  }
}