<?php require "views/layouts/header.php" ?>

<?php print_r($_SESSION) ?>

<div class="row justify-content-center g-5 mt-2">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        CAMBIAR EMAIL
      </div>

      <form class="p-2" action="" method="post">
        <div class="mb-3">
          <label for="txtemail" class="form-label">Email:</label>
          <input type="email" class="form-control" name="txtemail" id="txtemail" aria-describedby="emailHelpId" placeholder="abc@mail.com">
        </div>

        <button type="submit" class="btn btn-primary w-100">Cambiar Email</button>
      </form>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        CAMBIAR CONTRASEÑA
      </div>

      <form class="p-2" action="" method="post">
        <div class="mb-3">
          <label for="txtactualpass" class="form-label">Actual contraseña:</label>
          <input type="password" class="form-control" name="txtactualpass" id="txtactualpass" placeholder="********">
        </div>

        <div class="mb-3">
          <label for="txtnewpass" class="form-label">Nueva Contraseña:</label>
          <input type="password" class="form-control" name="txtnewpass" id="txtnewpass" placeholder="********">
        </div>

        <div class="mb-3">
          <label for="txtnewpass" class="form-label">Repetir nueva Contraseña:</label>
          <input type="password" class="form-control" name="txtnewpass" id="txtnewpass" placeholder="********">
        </div>

        <button type="submit" class="btn btn-primary w-100">Cambiar contraseña</button>
      </form>


    </div>
  </div>
</div>


<?php require "views/layouts/footer.php" ?>