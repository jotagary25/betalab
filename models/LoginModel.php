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
    if ($consult->fetch(PDO::FETCH_OBJ)) {
      return true;
    } else {
      return false;
    }
  }
}
