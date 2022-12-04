<?php

require "./models/conection.php";
class AdminModel
{
  private $_db;

  public function __construct()
  {
    $this->_db = new Conexion();
  }

  public function searchUser($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM user WHERE is_active=true AND " . $condicion);
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetch(PDO::FETCH_OBJ);
  }

  public function updateUser($data, $condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "UPDATE user SET " . $data . " WHERE " . $condicion
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }
}
