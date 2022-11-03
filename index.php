<?php
require "./config.php";

$page = "index";

if (isset($_GET["page"])) {
  $page = $_GET["page"];
}
switch ($page) {
  case "login":
    require "./controllers/LoginController.php";
    LoginController::index();
    break;
  case 'authlogin':
    require "./controllers/LoginController.php";
    LoginController::login();
    break;
  case 'logout':
    require "./controllers/LoginController.php";
    LoginController::logout();
    break;
  case 'pacientes':
    require "./controllers/PacientesController.php";
    if (isset($_GET["option"])) {
      $metodo = $_GET["option"];
      if (method_exists("PacientesController", $metodo)) {
        PacientesController::{$metodo}();
      }
    } else if (isset($_GET["subpage"])) {
      $subpage = $_GET["subpage"];
      switch ($subpage) {
        case 'orden':
          require "./controllers/OrdenController.php";
          print_r($_REQUEST);
          break;
        default:
          print_r($_REQUEST);
          break;
      }
    } else {
      PacientesController::listPacientes();
    }
    break;
  case 'admin':
    require "./views/pages/AdminView.php";
    break;
  default:
    require "./views/pages/TestView.php";
    break;
}
