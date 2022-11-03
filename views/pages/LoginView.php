<?php require "views/layouts/header.php" ?>

<div class="row justify-content-center align-items-center g-2">
  <!-- <div class="col">Column</div> -->
  <div class="col-sm-6 mt-5 mb-5">
    <form action="<?php echo urlsite ?>?page=authlogin" method="post">
      <div class="mb-3">
        <label for="" class="form-label">Email</label>
        <input type="text" class="form-control" name="txtemail" id="txtemail" aria-describedby="helpId" placeholder="Correo Electronico">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="txtpassword" id="txtpassword" placeholder="Contraseña">
      </div>

      <p class="text-danger">
        <?php echo (isset($_GET["msg"])) ? $_GET["msg"] : "" ?>
      </p>

      <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
    </form>
  </div>
  <!-- <div class="col">Column</div> -->
</div>

<?php require "views/layouts/footer.php" ?>