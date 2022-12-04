<?php
require "./config.php";

$page = "index";

if (isset($_GET["page"])) {
  $page = $_GET["page"];
}
switch ($page) {
  case "login":
    require "./controllers/LoginController.php";
    if (isset($_GET["option"])) {
      $metodo = $_GET["option"];
      if (method_exists("LoginController", $metodo)) {
        LoginController::{$metodo}();
      }
    } else {
      LoginController::index();
    }
    break;

  case 'authlogin':
    require "./controllers/LoginController.php";
    LoginController::login();
    break;

  case 'logout':
    require "./controllers/LoginController.php";
    LoginController::logout();
    break;

  case 'categorias':
    require "./controllers/CategoriaController.php";
    if (isset($_GET["option"])) {
      $metodo = $_GET["option"];
      if (method_exists("CategoriaController", $metodo)) {
        CategoriaController::{$metodo}();
      }
    } else {
      CategoriaController::listCategoria();
    }
    break;

  case 'pacientes':
    require "./controllers/PacientesController.php";
    if (isset($_GET["option"])) {
      $metodo = $_GET["option"];
      if (method_exists("PacientesController", $metodo)) {
        PacientesController::{$metodo}();
      }
    } else {
      PacientesController::listPacientes();
    }
    break;

  case 'orden':
    if (isset($_GET["id"])) {
      require "./controllers/OrdenController.php";
      if (isset($_GET["option"])) {
        $metodo = $_GET["option"];
        if (method_exists("OrdenController", $metodo)) {
          OrdenController::{$metodo}();
        } else {
          print_r($_REQUEST);
        }
      } else {
        OrdenController::listOrdenes();
      }
    } else {
      print_r($_REQUEST);
    }
    break;

  case "examen":
    if (isset($_GET["idpaciente"])) {
      require "./controllers/ExamenController.php";
      ExamenController::listarExamenes();
    } else {
      print_r($_REQUEST);
    }
    break;

  case "admin":
    require "./controllers/AdminController.php";
    if (isset($_GET["option"])) {
      $metodo = $_GET["option"];
      if (method_exists("AdminController", $metodo)) {
        AdminController::{$metodo}();
      }
    } else {
      // print_r($_REQUEST);
      AdminController::indexAdmin();
    }
    break;

  default:
    require "./controllers/AdminController.php";
    AdminController::indexAdmin();
    break;
}
