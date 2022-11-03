<?php

require "./models/PacientesModel.php";

class PacientesController
{
  public static function listPacientes()
  {
    $pacientes = new PacientesModel();
    if (isset($_REQUEST["txtid"])) {
      $_id = $_REQUEST["txtid"];
      $select = $pacientes->searchOne("id= " . $_id);
    }
    $datos = $pacientes->searchAll("is_active=true");
    require "./views/pages/PacientesView.php";
  }

  public static function createPaciente()
  {
    $_carnet = strtolower($_REQUEST["txtcarnet"]);
    $_name = strtolower($_REQUEST["txtname"]);
    $_email = strtolower($_REQUEST["txtemail"]);
    $_telefono = strtolower($_REQUEST["txttelefono"]);

    try {
      $paciente = new PacientesModel();
      $data = "'" . $_carnet . "','" . $_name . "','" . $_email . "','" . $_telefono . "'";
      $paciente->create($data);
      header("location:" . urlsite . "?page=pacientes");
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=pacientes&msg=No se pudo añadir");
    }
  }

  public static function updatePaciente()
  {
    $_id = strtolower($_REQUEST["txtid"]);
    $_carnet = strtolower($_REQUEST["txtcarnet"]);
    $_name = strtolower($_REQUEST["txtname"]);
    $_email = strtolower($_REQUEST["txtemail"]);
    $_telefono = strtolower($_REQUEST["txttelefono"]);

    try {
      $paciente = new PacientesModel();
      $data =
        "carnet='" . $_carnet . "', 
        name='" . $_name . "', 
        email='" . $_email . "',
        telefono='" . $_telefono . "'";
      $condicion = "id=" . $_id;
      $paciente->update($data, $condicion);
      header("location:" . urlsite . "?page=pacientes");
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=pacientes&msg=No se pudo actualizar los datos");
    }
  }

  public static function deletePaciente()
  {
    $_id = strtolower($_REQUEST["txtid"]);
    try {
      $paciente = new PacientesModel();
      $condicion = "id=" . $_id;
      // $paciente->delete($condicion);
      $paciente->update("is_active=false", $condicion);
      header("location:" . urlsite . "?page=pacientes");
    } catch (PDOException $err) {
      print_r($err);
    }
    // header("location:" . urlsite . "?page=pacientes");
  }
}
