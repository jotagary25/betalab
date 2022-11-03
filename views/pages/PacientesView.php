<?php require "./views/layouts/header.php" ?>

<div class="row justify-content-center mt-4">
  <div class="col-md-4">
    <form action="<?php echo urlsite ?>?page=pacientes&option=createPaciente" method="post">
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $select ? $select->id : "" ?>" placeholder="">

      <div class="mb-2">
        <label for="txtcarnet" class="form-label">Carnet de identidad</label>
        <input type="text" required class="form-control" name="txtcarnet" id="txtcarnet" aria-describedby="helpId" value="<?php echo $select ? $select->carnet : "" ?>" placeholder="Numero de carnet">
      </div>

      <div class="mb-2">
        <label for="txtname" class="form-label">Nombre Completo</label>
        <input type="text" required class="form-control" name="txtname" id="txtname" aria-describedby="helpId" value="<?php echo $select ? $select->name : "" ?>" placeholder="Nombre Apellido">
      </div>

      <div class="mb-2">
        <label for="txtemail" class="form-label">Email</label>
        <input type="email" required class="form-control" name="txtemail" id="txtemail" aria-describedby="emailHelpId" value="<?php echo $select ? $select->email : "" ?>" placeholder="abc@mail.com">
      </div>

      <div class="mb-2">
        <label for="txttelefono" class="form-label">Telefono</label>
        <input type="text" required class="form-control" name="txttelefono" id="txttelefono" aria-describedby="helpId" value="<?php echo $select ? $select->telefono : "" ?>" placeholder="70707070">
      </div>

      <p class="text-danger">
        <?php echo (isset($_GET["msg"])) ? $_GET["msg"] : "" ?>
      </p>

      <div class="btn-group w-100" role="group" aria-label="">
        <button type="submit" class="btn btn-success">Añadir</button>

        <button type="submit" formaction="<?php echo urlsite ?>?page=pacientes&option=updatePaciente" class="btn btn-warning">Editar</button>

        <button type="submit" formaction="<?php echo urlsite ?>?page=pacientes&option=deletePaciente" class="btn btn-danger">Eliminar</button>
      </div>
    </form>
  </div>

  <div class="col-md-8">
    <div class="table-responsive">
      <table class="table table-light table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">CARNET</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">EMAIL</th>
            <th scope="col">TELF.:</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($datos as $dato) : ?>
            <tr class="">
              <td scope="row"><?php echo $dato->id ?></td>
              <td><?php echo $dato->carnet ?></td>
              <td><?php echo $dato->name ?></td>
              <td><?php echo $dato->email ?></td>
              <td><?php echo $dato->telefono ?></td>
              <td>

                <form action="<?php echo urlsite ?>?page=pacientes" method="post">
                  <input type="hidden" name="txtid" id="txtid" value="<?php echo $dato->id ?>">
                  <div class="btn-group" role="group" aria-label="">
                    <button type="submit" class="btn btn-info">O</button>
                    <button type="submit" formaction="<?php echo urlsite ?>?page=pacientes&subpage=orden" class="btn btn-primary">|</button>
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