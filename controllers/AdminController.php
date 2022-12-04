<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("location:" . urlsite . "?page=login");
}

require "./models/AdminModel.php";

class AdminController
{
  public static function indexAdmin()
  {
    $_idAdmin = $_SESSION["login"];
    $admins = new AdminModel();
    $admin = $admins->searchUser("id=" . $_idAdmin);
    require "./views/pages/AdminView.php";
  }

  public static function changeEmail()
  {
    $_newEmail = $_REQUEST["txtemail"];
    $_idAdmin = $_SESSION["login"];

    try {
      $admins = new AdminModel();
      $data = "email='" . $_newEmail . "'";
      $condicion = "id=" . $_idAdmin;
      $admins->updateUser($data, $condicion);
      header("location:" . urlsite . "?page=admin&success=Email cambiado exitosamente");
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=admin&msg=No se pudo cambiar el email");
    }
  }

  public static function changePassword()
  {
    $_idAdmin = $_SESSION["login"];
    $_actualpass = strtolower($_REQUEST["actualpass"]);
    $_newpass1 = strtolower($_REQUEST["newpass1"]);
    $_newpass2 = strtolower($_REQUEST["newpass2"]);

    $admins = new AdminModel();
    $informacion = "id=" . $_idAdmin . " AND password='" . $_actualpass . "'";
    $actualAdmin = $admins->searchUser($informacion);

    if ($actualAdmin) {
      if ($_newpass1 === $_newpass2) {
        try {
          $data = "password='" . $_newpass1 . "'";
          $condicion = "id=" . $_idAdmin;
          $admins->updateUser($data, $condicion);
          header("location:" . urlsite . "?page=admin&success=Contraseña actualizada correctamente");
        } catch (PDOException $err) {
          header("location:" . urlsite . "?page=admin&msg=No se pudo cambiar las contraseñas");
        }
      } else {
        header("location:" . urlsite . "?page=admin&msg=Contraseñas nuevas no son iguales");
      }
    } else {
      header("location:" . urlsite . "?page=admin&msg=Contraseña actual no es igual");
    }
  }
}
