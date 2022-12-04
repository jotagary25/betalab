<?php require "views/layouts/header.php" ?>

<div class="row justify-content-center align-items-center">
  <!-- MENSAJE DE ERROR DE CUALQUIER TRANSACCION A REALIZAR -->
  <p class="text-danger">
    <?php echo (isset($_GET["msgerror"])) ? $_GET["msgerror"] : "" ?>
  </p>
  <!-- MENSAJE DE EXITO DE CUALQUIER TRANSACCION A REALIZAR -->
  <p class="text-success">
    <?php echo (isset($_GET["msgsuccess"])) ? $_GET["msgsuccess"] : "" ?>
  </p>

  <div class="col-md-5 mt-2 mb-2">
    <!-- LOGIN -->
    <form action="<?php echo urlsite ?>?page=authlogin" method="post">
      <div class="mb-3">
        <label for="" class="form-label">Email</label>
        <input type="text" class="form-control" name="txtemail" id="txtemail" aria-describedby="helpId" placeholder="Correo Electronico">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="txtpassword" id="txtpassword" placeholder="Contraseña">
      </div>

      <button type="submit" class="btn btn-primary btn-block w-100"><strong>INGRESAR</strong></button>
    </form>
    <!-- CHANGE PASSWORD -->
    <div class="accordion mt-2 mb-2" id="accordionFlushExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            ¿Olvido la contraseña?
          </button>
        </h2>

        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
          <form action="<?php echo urlsite ?>?page=login&option=sendPassword" method="post">
            <div class="m-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control mb-3" name="email" id="email" aria-describedby="helpId" placeholder="abc@mail.com">
              <input type="submit" class="btn btn-warning btn-sm w-100" value="ENVIAR">
            </div>
          </form>

          <div class="accordion-body">
            Se enviará una contraseña aleatoria a su correo Electronico para que pueda acceder a su cuenta
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "views/layouts/footer.php" ?>