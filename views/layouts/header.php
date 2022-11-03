<!doctype html>
<html lang="es">

<head>
  <title>betalab</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="navId" role="tablist">
      <li class="nav-item">
        <a href="<?php echo urlsite ?>?page=pacientes" class="nav-link active">Pacientes</a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="<?php echo urlsite ?>?page=ordenes" class="nav-link">Ordenes</a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="<?php echo urlsite ?>?page=examenes" class="nav-link">Examenes</a>
      </li>
      <li class="nav-item">
        <a href="<?php echo urlsite ?>?page=admin" class="nav-link">Administración</a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="<?php echo urlsite ?>?page=logout" class="nav-link">Cerrar Sesión</a>
      </li>
    </ul>

    <script>
      var triggerEl = document.querySelector('#navId a')
      bootstrap.Tab.getInstance(triggerEl).show() // Select tab by name
    </script>

  </header>
  <div class="container">