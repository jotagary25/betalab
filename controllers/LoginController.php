<?php

session_start();
require "models/LoginModel.php";

class LoginController
{
  public static function index()
  {
    if (isset($_SESSION["login"])) {
      header('location:' . urlsite);
    }
    require "views/pages/LoginView.php";
  }

  public static function login()
  {
    $_model = new LoginModel();
    $_email = trim($_POST["txtemail"]);
    // $_password = md5(trim($_POST["txtpassword"]));
    $_password = trim($_POST["txtpassword"]); // pass sin hash

    $_result = $_model->login($_email, $_password);

    if ($_result) {
      $_SESSION["login"] = $_email;
      header("location:" . urlsite . "?page=pacientes");
    } else {
      header("location:" . urlsite . "?page=login&msg= No coinciden las credenciales");
    }
  }

  public static function logout()
  {
    if (!isset($_SESSION['login'])) {
      header('locaton:' . urlsite);
    }
    unset($_SESSION['login']);
    session_destroy();
    header('location:' . urlsite);
  }
}
