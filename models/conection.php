<?php

class Conexion
{
  public $conexion;
  public function conectar()
  {
    try {
      $dbs = "mysql:host=localhost;dbname=" . DB_NAME;
      $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $this->conexion = new PDO($dbs, DB_USER, DB_PASSWORD, $opciones);
      return $this->conexion;
    } catch (PDOException $err) {
      echo $err->getMessage();
    }
  }
  public function desconectar()
  {
    $this->conexion = null;
  }
}
