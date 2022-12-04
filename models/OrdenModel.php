<?php

require "./models/conection.php";

class OrdenModel
{
  private $_db;

  public function __construct()
  {
    $this->_db = new Conexion();
  }

  public function searchOne($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM orden WHERE " . $condicion);
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetch(PDO::FETCH_OBJ);
  }

  public function searchAll($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM orden WHERE " . $condicion);
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetchAll(PDO::FETCH_OBJ);
  }

  public function OnePaciente($idPaciente)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM paciente WHERE is_active=true AND id=" . $idPaciente);
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetch(PDO::FETCH_OBJ);
  }
  // FUNCIONES PARA INTERACTUAR CON LAS ORDENES
  public function createOrden($data)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "INSERT orden (fecha, estado, paciente_id)
      VALUES (" . $data . ")"
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }
  public function updateOrden($data, $condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "UPDATE orden SET " . $data . " WHERE " . $condicion
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }

  // FUNCIONES PARA INTERACTUAR CON LOS EXAMENES
  public function createExamen($data)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query(
      "INSERT examen (archivo, orden_id)
      VALUES (" . $data . ")"
    );
    $this->_db->desconectar();
    return $consult ? true : false;
  }
  public function listarExamenes($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->prepare("SELECT * FROM examen WHERE " . $condicion);
    $consult->execute();
    $this->_db->desconectar();
    return $consult->fetchAll(PDO::FETCH_OBJ);
  }
  public function deleteExamen($condicion)
  {
    $this->_db->conectar();
    $consult = $this->_db->conexion->query("DELETE FROM examen WHERE " . $condicion);
    $this->_db->desconectar();
    return $consult ? true : false;
  }
}
