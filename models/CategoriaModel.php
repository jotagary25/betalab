<?php

require "./models/conection.php";

class CategoriaModel
{
  private $_db;

  public function __construct()
  {
    $this->_db = new Conexion();
  }

  public function searchOne($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM categoria WHERE " . $condicion);
    $consult->execute();
    return $consult->fetch(PDO::FETCH_OBJ);
  }

  public function searchAll($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM categoria WHERE " . $condicion);
    $consult->execute();
    return $consult->fetchAll(PDO::FETCH_OBJ);
  }

  public function create($data)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "INSERT categoria (nombre, descuento) VALUES (" . $data . ")"
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }

  public function update($data, $condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "UPDATE categoria SET " . $data . " WHERE " . $condicion
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }

  public function delete($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "DELETE FROM categoria WHERE " . $condicion
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }
}
