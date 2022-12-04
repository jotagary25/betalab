<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("location:" . urlsite . "?page=login");
}

require "./models/CategoriaModel.php";

class CategoriaController
{
  public static function listCategoria()
  {
    $categoriaModel = new CategoriaModel();
    if (isset($_REQUEST["txtid"])) {
      $_id = $_REQUEST["txtid"];
      $oneCategoria = $categoriaModel->searchOne("id=" . $_id);
    }
    $allCategorias = $categoriaModel->searchAll("is_active=true");
    require "./views/pages/CategoriaView.php";
  }

  public static function createCategoria()
  {
    $_nombre = strtolower($_REQUEST["txtnombre"]);
    $_descuento = strtolower($_REQUEST["txtdescuento"]);

    try {
      $categoriaModel = new CategoriaModel();
      $data = "'" . $_nombre . "','" . $_descuento . "'";
      $categoriaModel->create($data);
      header("location:" . urlsite . "?page=categorias");
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=categorias&msg=No se pudo añadir");
    }
  }

  public static function updateCategoria()
  {
    $_id = strtolower($_REQUEST["txtid"]);
    $_nombre = strtolower($_REQUEST["txtnombre"]);
    $_descuento = strtolower($_REQUEST["txtdescuento"]);

    try {
      $categoriaModel = new CategoriaModel();
      $data =
        "nombre='" . $_nombre . "', 
        descuento=" . $_descuento;
      $condicion = "id=" . $_id;
      $categoriaModel->update($data, $condicion);
      header("location:" . urlsite . "?page=categorias");
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=categorias&msg=No se pudo actualizar");
    }
  }

  public static function deleteCategoria()
  {
    $_id = strtolower($_REQUEST["txtid"]);

    try {
      $categoriaModel = new CategoriaModel();
      $condicion = "id=" . $_id;
      $categoriaModel->delete($condicion);
      header("location:" . urlsite . "?page=categorias");
    } catch (PDOException $err) {
      header("location:" . urlsite . "?page=categorias&msg=No se pudo Eliminar");
    }
  }
}
