<?php require "./views/layouts/header.php" ?>

<!-- INFORMACIÓN DEL PACIENTE QUE SE ESTA TRATANDO -->
<div class="card mt-2">
  <div class="row card-body">
    <h4 class="card-title"><?php echo $paciente->nombre ?></h4>
    <div class="col-md-4">Email: <?php echo $paciente->correo ?></div>
    <div class="col-md-4">Telf.: <?php echo $paciente->telefono ?></div>
    <div class="col-md-4">C.I.: <?php echo $paciente->carnet ?></div>
  </div>
</div>

<!-- MENSAJE DE ERROR DE CUALQUIER TRANSACCION A REALIZAR -->
<p class="text-danger">
  <?php echo (isset($_GET["msg"])) ? $_GET["msg"] : "" ?>
</p>

<!-- CONTENIDO DE TRANSACCIONES A REALIZAR -->
<div class="row justify-content-center mt-4">
  <!-- COLUMNA IZQUIERDA-->
  <div class="col-md-6">

    <!-- NUEVA ORDEN -->
    <form class="card p-2 mb-2" action="<?php echo urlsite ?>?page=orden&id=<?php echo $paciente->id ?>&option=createOrden" method="post">
      <label for="newfecha" class="form-label fw-bold">CREAR ORDEN</label>
      <div class="input-group input-group-md">
        <input type="date" class="form-control" name="newfecha" id="newfecha" required>
        <button type="submit" class="btn btn-success">Crear</button>
      </div>
    </form>

    <!-- CRUD DE ORDEN SELECCIONADO -->
    <form class="card p-2 mb-2" action="<?php echo urlsite ?>?page=orden&id=<?php echo $paciente->id ?>&option=createOrden" method="post" style="display: <?php echo $oneOrden ? "block" : "none" ?>;">

      <div class="input-group input-group-md mb-2">
        <span for="txtid" class="input-group-text fw-bold">ORDEN -></span>
        <input type="hidden" class="form-control fw-bold" name="txtid" id="txtid" value="<?php echo $oneOrden ? $oneOrden->id : "" ?>">
        <input type="text" class="form-control" value="<?php echo $oneOrden ? $oneOrden->id : "" ?>" disabled>
        <!-- Eliminar una ORDEN -->
        <button type="submit" formaction="<?php echo urlsite ?>?page=orden&id=<?php echo $paciente->id ?>&option=deleteOrden" class="btn btn-danger">Eliminar</button>
      </div>

      <div class="mb-2">
        <label for="txtfecha" class="form-label">Fecha de orden:</label>
        <div class="input-group input-group-md">
          <input type="date" class="form-control" name="txtfecha" id="txtfecha" value="<?php echo $oneOrden ? $oneOrden->fecha : "" ?>" placeholder="" required>
          <!-- Actualizar fecha de una ORDEN-->
          <button type="submit" formaction="<?php echo urlsite ?>?page=orden&id=<?php echo $paciente->id ?>&option=editDateOrden" class="btn btn-warning">Actualizar</button>
        </div>
      </div>

      <div class="mb-2">
        <label for="txtestado" class="form-label">Estado:</label>
        <div class="input-group input-group-md">
          <input type="text" class="form-control" name="txtestado" id="txtestado" value="<?php echo $oneOrden ? $oneOrden->estado : "pendiente" ?>" disabled>
          <!-- poner en LISTO el estado de una orden -->
          <button type="submit" formaction="<?php urlsite ?>?page=orden&id=<?php echo $paciente->id ?>&option=readyOrden" class="btn btn-primary" <?php echo $oneOrden->estado !== 'pendiente' ? "disabled" : "" ?>>Activar</button>
        </div>
      </div>
    </form>

    <!-- TRANSACCIONES PARA EXAMEN -->
    <div class="card p-2" style="display: <?php echo $oneOrden ? "block" : "none" ?>;">
      <label class="form-label fw-bold">EXAMENES:</label>
      <!-- CARGAN UN EXAMEN PARA UN ORDEN -->
      <form class="mb-2 input-group input-group-md" enctype="multipart/form-data" action="?page=orden&id=<?php echo $paciente->id ?>&txtid=<?php echo $oneOrden ? $oneOrden->id : "" ?>&option=saveExamen" method="post">
        <input type="file" required accept=".pdf" class="form-control" name="filepdf" id="filepdf">
        <input type="submit" class="btn btn-primary" value="Subir" />
      </form>
      <!-- LISTAR EXAMENES DE UNA ORDEN -->
      <div class="table-responsive-md" style="display: <?php echo $allExamen ? "block" : "none" ?>;">
        <table class="table table-light table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">ARCHIVO</th>
              <th scope="col">ACCION</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allExamen as $examen) : ?>
              <tr class="">
                <td scope="row">
                  <a title="descargar archivo" href="./public/examenes/<?php echo $examen->archivo ?>" target="_blank"><?php echo $examen->archivo ?></a>
                </td>
                <td>
                  <form action="?page=orden&id=<?php echo $paciente->id ?>&txtid=<?php echo $oneOrden ? $oneOrden->id : "" ?>&option=deleteExamen&idexamen=<?php echo $examen->id ?>&nameexamen=<?php echo $examen->archivo ?>" method="post">
                    <input type="submit" class="btn btn-danger" value="Eliminar" />
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <!-- Boton para enviar examenes al correo -->
        <form action="<?php urlsite ?>?page=orden&id=<?php echo $paciente->id ?>&option=sendExamenes" method="post" style="display: <?php echo $oneOrden->estado !== 'pendiente' ? "block" : "none" ?>;">
          <input type="hidden" name="txtid" value="<?php echo $oneOrden->id ?>">
          <input type="hidden" name="mailpaciente" value="<?php echo $paciente->correo ?>">
          <input type="hidden" name="namepaciente" value="<?php echo $paciente->nombre ?>">
          <button type="submit" class="btn btn-primary w-100">Enviar Correo</button>
        </form>
        <!-- EXAMENES LLENOS O VACIOS -->
        <label class="form-label"> <?php echo $allExamen ? "" : "No existen examenes cargados" ?> </label>
      </div>
      <?php print_r($allExamen ? "lleno" : "vacio") ?>
    </div>
  </div>

  <!-- COLUMNA DERECHA -->
  <div class="col-md-6">
    <!-- LISTAR ORDENES -->
    <div class="table-responsive">
      <table class="table table-light table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">FECHA</th>
            <th scope="col">ESTADO</th>
            <th scope="col">SELECT</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($allOrdenes as $orden) : ?>
            <tr class="">
              <td scope="row"><?php echo $orden->id ?></td>
              <td><?php echo $orden->fecha ?></td>
              <td><?php echo $orden->estado ?></td>
              <td>
                <!-- SELECCIONAR UNA ORDEN PARA VER INFORMACIÓN y REALIZAR TRANSACCIONES -->
                <form action="<?php echo urlsite . "?page=orden&id=" . $idPaciente ?>" method="post">
                  <input type="hidden" name="txtid" id="txtid" value="<?php echo $orden->id ?>">
                  <div class="btn-group" role="group" aria-label="">
                    <button type="submit" class="btn btn-info">select</button>
                  </div>
                </form>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require "./views/layouts/footer.php" ?>