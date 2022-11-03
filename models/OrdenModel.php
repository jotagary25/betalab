<?php

require "./models/conection.php";

class OrdenModel
{
  private $_db;

  public function __construct()
  {
    $this->_db = new Conexion();
  }
}
