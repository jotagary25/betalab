<?php

require "./models/conection.php";

class PacientesModel
{
  private $_db;

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
    $consult = $this->_db->conexion->prepare("
      SELECT paciente.id, paciente.carnet, paciente.nombre, paciente.correo, paciente.telefono, categoria.nombre as categoria
      FROM paciente, categoria 
      WHERE paciente.categoria_id = categoria.id and " . $condicion);
    $consult->execute();
    return $consult->fetchAll(PDO::FETCH_OBJ);
  }

  public function listCategorias()
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM categoria WHERE is_active=true");
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetchAll(PDO::FETCH_OBJ);
  }

  public function create($data)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "INSERT paciente (carnet, nombre, correo, telefono, categoria_id) 
      VALUES (" . $data . ")"
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }

  public function update($data, $condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query("UPDATE paciente SET " . $data . " WHERE " . $condicion);
    $this->_db->desconectar();
    return $consult ? true : false;
  }

  public function delete($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query("DELETE FROM paciente WHERE " . $condicion);
    $this->_db->desconectar();
    return $consult ? true : false;
  }
}
