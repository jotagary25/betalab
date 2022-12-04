<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("location:" . urlsite . "?page=login");
}

require "./models/PacientesModel.php";

class PacientesController
{
  public static function listPacientes()
  {
    $pacientes = new PacientesModel();

    if (isset($_REQUEST["txtid"])) {
      $_id = $_REQUEST["txtid"];
      $onePaciente = $pacientes->searchOne("id= " . $_id);
    }
    $allPacientes = $pacientes->searchAll("paciente.is_active=true");
    $allCategorias = $pacientes->listCategorias();
    require "./views/pages/PacientesView.php";
  }

  public static function createPaciente()
  {
    // print_r($_REQUEST);

    $_carnet = strtolower($_REQUEST["txtcarnet"]);
    $_nombre = strtolower($_REQUEST["txtnombre"]);
    $_correo = strtolower($_REQUEST["txtcorreo"]);
    $_telefono = strtolower($_REQUEST["txttelefono"]);
    $_idcategoria = $_REQUEST["txtidcategoria"];

    try {
      $paciente = new PacientesModel();
      $data = "'" . $_carnet . "','" . $_nombre . "','" . $_correo . "','" . $_telefono . "', " . $_idcategoria;
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
    $_name = strtolower($_REQUEST["txtnombre"]);
    $_email = strtolower($_REQUEST["txtcorreo"]);
    $_telefono = strtolower($_REQUEST["txttelefono"]);
    $_idcategoria = $_REQUEST["txtidcategoria"];

    try {
      $paciente = new PacientesModel();
      $data =
        "carnet='" . $_carnet . "', 
        nombre='" . $_name . "', 
        correo='" . $_email . "',
        telefono='" . $_telefono . "',
        categoria_id=" . $_idcategoria;
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
      header("location:" . urlsite . "?page=pacientes");
    }
  }
}
