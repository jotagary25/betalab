<?php require "./views/layouts/header.php" ?>

<div class="row justify-content-center mt-4">
  <div class="col-md-4">
    <form action="<?php echo urlsite ?>?page=pacientes&option=createPaciente" method="post">
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $onePaciente ? $onePaciente->id : "" ?>" placeholder="">

      <div class="mb-2">
        <label for="txtcarnet" class="form-label">Carnet de identidad</label>
        <input type="text" required class="form-control" name="txtcarnet" id="txtcarnet" aria-describedby="helpId" value="<?php echo $onePaciente ? $onePaciente->carnet : "" ?>" placeholder="Numero de carnet">
      </div>

      <div class="mb-2">
        <label for="txtname" class="form-label">Nombre Completo</label>
        <input type="text" required class="form-control" name="txtnombre" id="txtnombre" aria-describedby="helpId" value="<?php echo $onePaciente ? $onePaciente->nombre : "" ?>" placeholder="Nombre Apellido">
      </div>

      <div class="mb-2">
        <label for="txtemail" class="form-label">Correo Electronico</label>
        <input type="email" required class="form-control" name="txtcorreo" id="txtcorreo" aria-describedby="emailHelpId" value="<?php echo $onePaciente ? $onePaciente->correo : "" ?>" placeholder="abc@mail.com">
      </div>

      <div class="mb-2">
        <label for="txttelefono" class="form-label">Telefono</label>
        <input type="text" required class="form-control" name="txttelefono" id="txttelefono" aria-describedby="helpId" value="<?php echo $onePaciente ? $onePaciente->telefono : "" ?>" placeholder="70707070">
      </div>

      <div class="mb-3">
        <label for="txtidcategoria" class="form-label">Categoria</label>
        <select class="form-select form-select-md" required name="txtidcategoria" id="txtidcategoria">
          <?php foreach ($allCategorias as $categoria) : ?>
            <option value="<?php echo $categoria->id ?>" <?php
                                                          if ($onePaciente) {
                                                            if ($onePaciente->categoria_id == $categoria->id) {
                                                              echo 'selected';
                                                            }
                                                          }
                                                          ?>>
              <?php echo $categoria->nombre ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>

      <p class="text-danger">
        <?php echo (isset($_GET["msg"])) ? $_GET["msg"] : "" ?>
      </p>

      <div class="btn-group w-100 mb-2" role="group" aria-label="">
        <button type="submit" class="btn btn-success">Añadir</button>

        <button type="submit" formaction="<?php echo urlsite ?>?page=pacientes&option=updatePaciente" class="btn btn-warning">Editar</button>

        <button type="submit" formaction="<?php echo urlsite ?>?page=pacientes&option=deletePaciente" class="btn btn-danger">Eliminar</button>
      </div>

      <a href="<?php echo urlsite . "?page=orden&id=" . $onePaciente->id ?>" style="display: <?php echo $onePaciente ? "block" : "none" ?>;" rel="noopener noreferrer" class="btn btn-primary w-100">
        Ver Orden
      </a>
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
            <th scope="col">CORREO</th>
            <th scope="col">TELF.:</th>
            <th scope="col">CATEGORIA</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($allPacientes as $paciente) : ?>
            <tr class="">
              <td scope="row"><?php echo $paciente->id ?></td>
              <td><?php echo $paciente->carnet ?></td>
              <td><?php echo $paciente->nombre ?></td>
              <td><?php echo $paciente->correo ?></td>
              <td><?php echo $paciente->telefono ?></td>
              <td><?php echo $paciente->categoria ?></td>
              <td>
                <form action="<?php echo urlsite ?>?page=pacientes" method="post">
                  <input type="hidden" name="txtid" id="txtid" value="<?php echo $paciente->id ?>">
                  <div class="btn-group" role="group" aria-label="">
                    <button type="submit" class="btn btn-info">seleccionar</button>
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