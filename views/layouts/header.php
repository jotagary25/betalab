<!doctype html>
<html lang="es">

<head>
  <title>betalab</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column justify-content-between" style="height: 100vh;">
  <header>
    <img src="../../public/assets/banner.png" class="imageBetalab border border-dark" alt="banner of betalab laboratory">
    <!-- NAVEGACION -->
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <a href="<?php echo urlsite ?>?page=admin" class="nav-link active fs-5">Administración</a>

        <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item px-1 mx-3 fs-5 border-bottom border-dark border-opacity-50">
              <a href="<?php echo urlsite ?>?page=categorias" class="nav-link">Categorias</a>
            </li>
            <li class="nav-item px-1 mx-3 fs-5 border-bottom border-dark border-opacity-50">
              <a href="<?php echo urlsite ?>?page=pacientes" class="nav-link">Pacientes</a>
            </li>
            <li class="nav-item px-1 mx-3 fs-5 border-bottom border-dark border-opacity-50">
              <a href="<?php echo urlsite ?>?page=logout" class="nav-link">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container">