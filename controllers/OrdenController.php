<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("location:" . urlsite . "?page=login");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/Exception.php";
require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";

require "./models/OrdenModel.php";

class OrdenController
{
  // ACCIONES PARA ORDENES
  public static function listOrdenes()
  {
    $ordenes = new OrdenModel();
    $allEstados = array("pendiente", "listo", "enviado");

    // Traemos al paciente
    $idPaciente = $_REQUEST["id"];
    $paciente = $ordenes->OnePaciente($idPaciente);

    // Traemos todas las ordenes del paciente
    $allOrdenes = $ordenes->searchAll("paciente_id=" . $idPaciente . " AND is_active=true");

    // Traemos el orden seleccionado
    if (isset($_REQUEST["txtid"])) {
      $idOrden = $_REQUEST["txtid"];
      $oneOrden = $ordenes->searchOne("paciente_id=" . $idPaciente . " AND id=" . $idOrden . " AND is_active=true");
      $allExamen = $ordenes->listarExamenes("orden_id=" . $idOrden . " AND is_active=true");
    }
    require "./views/pages/OrdenView.php";
  }
  public static function createOrden()
  {
    $idPaciente = $_REQUEST["id"];
    $fecha = $_REQUEST["newfecha"];

    try {
      $ordenes = new OrdenModel();
      $data = "'" . $fecha . "', 'pendiente', " . $idPaciente;
      $ordenes->createOrden($data);
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente);
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . $msg = "No se pudo crear la orden");
    }
  }
  public static function editDateOrden()
  {
    $idPaciente = $_REQUEST["id"];
    $idOrden = $_REQUEST["txtid"];
    $fecha = $_REQUEST["txtfecha"];

    try {
      $ordenes = new OrdenModel();
      $data = "fecha='" . $fecha . "'";
      $condicion = "id=" . $idOrden;
      $ordenes->updateOrden($data, $condicion);
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden);
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "&msg=No se pudo actualizar la fecha");
    }
  }
  public static function deleteOrden()
  {
    $idPaciente = $_REQUEST["id"];
    $idOrden = $_REQUEST["txtid"];

    try {
      $ordenes = new OrdenModel();
      $data = "is_active=false";
      $condicion = "id=" . $idOrden;
      $ordenes->updateOrden($data, $condicion);
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden);
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "msg=No se pudo Eliminar la Orden");
    }
  }

  // ACCIONES SWITCH PARA ACTIVAR Y ENVIAR EXAMENES
  public static function readyOrden()
  {
    // print_r($_REQUEST);
    $idPaciente = $_REQUEST["id"];
    $idOrden = $_REQUEST["txtid"];

    try {
      $ordenes = new OrdenModel();
      $data = "estado='listo'";
      $condicion = "id=" . $idOrden;
      $ordenes->updateOrden($data, $condicion);
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden);
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "&msg=No se pudo actualizar la orden");
    }
  }
  public static function sendExamenes()
  {
    $idPaciente = $_REQUEST["id"];
    $idOrden = $_REQUEST["txtid"];
    $mailPaciente = $_REQUEST["mailpaciente"];
    $namePaciente = $_REQUEST["namepaciente"];

    $mail = new PHPMailer();

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = SENDING_EMAIL;
      $mail->Password   = KEY_EMAIL;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port       = 465;
      // recipients
      $mail->setFrom(SENDING_EMAIL, 'ADMINISTRADOR');
      $mail->addAddress($mailPaciente);
      // content
      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';
      $mail->Subject = 'Betalab: resultados de sus examenes';
      $mail->Body =
        "<div>
          <h2>Buenas tardes Sr. " . $namePaciente . "</h2>
          <p>Agradecemos su confianza en nuestro laboratorio <strong>BETALAB</strong>, En el siguiente enlace</p>
          <p>podrá descargar los exámenes clinicos a la orden Nro " . $idOrden . "</p>

          <a href='" . urlsite . "?page=examen&idpaciente=" . $idPaciente . "&idorden=" . $idOrden . "' target='_blank'>
            <strong>Ver examenes</strong>
          </a>

          <p>Atte. El equipo de administración de sistema</p>
        </div>
        ";
      $response = $mail->send();
      // print_r($response);
      if ($response) {
        $ordenes = new OrdenModel();
        $data = "estado='enviado'";
        $condicion = "id=" . $idOrden;
        $ordenes->updateOrden($data, $condicion);
        header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden);
      } else {
        header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "&msg=No se pudo enviar los examenes");
      }
    } catch (Exception $err) {
      // print_r($err);
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "&msg=No se pudo enviar los examenes");
    }
  }

  // ACCIONES PARA EXAMENES
  public static function saveExamen()
  {
    function generateString($length)
    {
      $key = "";
      $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
      $max = strlen($pattern) - 1;
      for ($i = 0; $i < $length; $i++) {
        $key .= substr($pattern, mt_rand(0, $max), 1);
      }
      return $key;
    }

    $idPaciente = $_REQUEST["id"];
    $idOrden = $_REQUEST["txtid"];
    $archivo = $_FILES["filepdf"];
    $nameArchivo = generateString(6) . $archivo["name"];
    // cagando el fichero en la carpeta de subidas
    try {
      if (move_uploaded_file($archivo["tmp_name"], "./public/examenes/" . $nameArchivo)) {
        $data = "'" . $nameArchivo . "', " . $idOrden;
        $ordenes = new OrdenModel();
        $ordenes->createExamen($data);
        header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden);
      } else {
        header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "&msg=No se pudo añadir el archivo");
      }
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "&msg=No se pudo añadir el archivo");
    }
  }

  public static function deleteExamen()
  {
    $idPaciente = $_REQUEST["id"];
    $idOrden = $_REQUEST["txtid"];
    $idExamen = $_REQUEST["idexamen"];
    $nameExamen = $_REQUEST["nameexamen"];

    try {
      unlink("./public/examenes/" . $nameExamen);
      $ordenes = new OrdenModel();
      $data = "id=" . $idExamen;
      $ordenes->deleteExamen($data);
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden);
    } catch (\Throwable $th) {
      header("location:" . urlsite . "?page=orden&id=" . $idPaciente . "&txtid=" . $idOrden . "&msg=No se pudo eliminar el archivo");
    }
  }
}
