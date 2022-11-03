<?php

require "./models/conection.php";

class PacientesModel
{
  private $_db;
  // private $list;

  public function __construct()
  {
    $this->_db = new Conexion();
  }

  public function searchOne($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM  paciente WHERE " . $condicion);
    $consult->execute();
    return $consult->fetch(PDO::FETCH_OBJ);
  }

  public function searchAll($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM  paciente WHERE " . $condicion);
    $consult->execute();
    return $consult->fetchAll(PDO::FETCH_OBJ);
  }

  public function create($data)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "INSERT paciente ( carnet, name, email, telefono) 
      VALUES (" . $data . ")"
    );
    $this->_db->desconectar();
    if ($consult) {
      return true;
    } else {
      return false;
    }
  }

  public function  update($data, $condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query("UPDATE paciente SET " . $data . " WHERE " . $condicion);
    if ($consult) {
      return true;
    } else {
      return false;
    }
  }

  public function delete($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query("DELETE FROM paciente WHERE " . $condicion);
    $this->_db->desconectar();
    if ($consult) {
      return true;
    } else {
      return false;
    }
  }
}
