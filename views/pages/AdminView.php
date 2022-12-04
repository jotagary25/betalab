<?php require "views/layouts/header.php" ?>

<div class="row justify-content-center">

  <!-- MENSAJE DE ERROR DE CUALQUIER TRANSACCION A REALIZAR -->
  <p class="text-danger">
    <?php echo (isset($_GET["msg"])) ? $_GET["msg"] : "" ?>
  </p>
  <!-- MENSAJE DE EXITO DE CUALQUIER TRANSACCION A REALIZAR -->
  <p class="text-success">
    <?php echo (isset($_GET["success"])) ? $_GET["success"] : "" ?>
  </p>

  <!-- COLUMNA IZQUIERDA -->
  <div class="col-md-6">
    <!-- HEADER INFORMACION -->
    <div class="card text-bg-primary mb-2">
      <h4 class="card-header"><?php echo $admin->name ?></h4>
      <div class="card-body">
        <h5 class="card-title">Correo: <?php echo $admin->email ?></h5>
      </div>
    </div>
    <!-- CAMBIAR EMAIL -->
    <div class="card">
      <div class="card-header">
        Cambiar Correo Electronico
      </div>

      <form class="p-2" action="<?php echo urlsite ?>?page=admin&option=changeEmail" method="post">
        <div class="mb-3">
          <label for="txtemail" class="form-label">Nuevo correo:</label>
          <input type="email" class="form-control" name="txtemail" id="txtemail" aria-describedby="emailHelpId" placeholder="abc@mail.com" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">CAMBIAR</button>
      </form>
    </div>
  </div>

  <!-- COLUMNA DERECHA -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        CAMBIAR CONTRASEÑA
      </div>

      <form class="p-2" action="<?php echo urlsite ?>?page=admin&option=changePassword" method="post">
        <div class="mb-3">
          <label for="txtactualpass" class="form-label">Actual contraseña:</label>
          <input type="password" class="form-control" name="actualpass" id="actualpass" placeholder="********" required>
        </div>

        <div class="mb-3">
          <label for="txtnewpass" class="form-label">Nueva Contraseña:</label>
          <input type="password" class="form-control" name="newpass1" id="newpass1" placeholder="********" required>
        </div>

        <div class="mb-3">
          <label for="txtnewpass" class="form-label">Repetir nueva Contraseña:</label>
          <input type="password" class="form-control" name="newpass2" id="newpass2" placeholder="********" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">CAMBIAR</button>
      </form>


    </div>
  </div>
</div>


<?php require "views/layouts/footer.php" ?>