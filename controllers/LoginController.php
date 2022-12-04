<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/Exception.php";
require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";

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
      $_SESSION["login"] = $_result->id;
      header("location:" . urlsite . "?page=admin");
      // print_r($_result);
    } else {
      header("location:" . urlsite . "?page=login&msgerror= No coinciden las credenciales");
      // print_r("result resulto negativo");
    }
  }

  public static function logout()
  {
    if (!isset($_SESSION['login'])) {
      header('location:' . urlsite . "?page=login");
    }
    unset($_SESSION['login']);
    session_destroy();
    header('location:' . urlsite . "?page=login");
  }

  public static function sendPassword()
  {
    // Variable para usar los métodos de envio de email
    $mail = new PHPMailer();
    // funcion para generar contraseña
    function generateString($length)
    {
      $key = "";
      $pattern = "1234567890abcdefghijklmnopqrstuvwxyz,.-+{}[]></()#$%&=";
      $max = strlen($pattern) - 1;
      for ($i = 0; $i < $length; $i++) {
        $key .= substr($pattern, mt_rand(0, $max), 1);
      }
      return $key;
    }
    // $_email = "garyfernandez@hashtrust.co";
    $_email = $_REQUEST["email"];
    $_newPassword = generateString(50);

    $logins = new LoginModel();
    $consult = $logins->searchUser("email='" . $_email . "'");
    if ($consult) {
      try {
        // actualizando la contraseña
        $data = "password='" . $_newPassword . "'";
        $condicion = "email='" . $_email . "'";
        $logins->changePassword($data, $condicion);

        // enviando contraseña por email
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = SENDING_EMAIL;
        $mail->Password   = KEY_EMAIL;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        // seteando email que envia
        $mail->setFrom(SENDING_EMAIL, 'ADMINISTRADOR');
        // $mail->addAddress('garyfernandez@hashtrust.co');
        $mail->addAddress($_email);
        // content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Betalab: Recuperación de contraseña';
        $mail->Body =
          "<div>
            <p>Su nueva contraseña para la cuenta con email: " . $_email . " es:</p>
            <p><strong>" . $_newPassword . "</strong></p>
          <p>Atte. El equipo de administración de sistema</p>
        </div>
        ";
        $response = $mail->send();
        if ($response) {
          header("location:" . urlsite . "?page=login&msgsuccess=Se envio la nueva contraseña a su email");
        } else {
          header("location:" . urlsite . "?page=login&msgsuccess=No se pudo enviar el email");
        }
      } catch (PDOException $err) {
        header("location:" . urlsite . "?page=login&msgsuccess=No se pudo cambiar la contraseña");
      }
    } else {
      header("location:" . urlsite . "?page=login&msgerror=Email no registrado");
    }
  }
}
