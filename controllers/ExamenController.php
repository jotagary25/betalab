<?php

require "./models/OrdenModel.php";

class ExamenController
{
  // Listar ordenes
  public static function listarExamenes()
  {
    $ordenes = new OrdenModel();
    // Traemos al paciente
    $idPaciente = $_REQUEST["idpaciente"];
    $paciente = $ordenes->OnePaciente($idPaciente);
    // Traemos los examens
    $idOrden = $_REQUEST["idorden"];
    $allExamen = $ordenes->listarExamenes("orden_id=" . $idOrden . " AND is_active=true");

    require "./views/pages/ExamenView.php";
  }
}
