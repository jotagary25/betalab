<?php
require "./models/conection.php";
class LoginModel
{
  private $_db;
  public function __construct()
  {
    $this->_db = new Conexion();
  }

  public function login($email, $password)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM user WHERE email='" . $email . "' AND password='" . $password . "' ");
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetch(PDO::FETCH_OBJ);
  }

  public function searchUser($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM user WHERE is_active=true AND " . $condicion);
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetch(PDO::FETCH_OBJ);
  }

  public function changePassword($data, $condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "UPDATE user SET " . $data . " WHERE " . $condicion
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }
}
