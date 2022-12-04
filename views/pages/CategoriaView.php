<?php require "./views/layouts/header.php" ?>

<div class="row justify-content-center mt-4">
  <div class="col-md-4">
    <form action="<?php echo urlsite ?>?page=categorias&option=createCategoria" method="post">
      <input type="hidden" name="txtid" id="txtid" value="<?php echo $oneCategoria ? $oneCategoria->id : "" ?>" placeholder="">

      <div class="mb-2">
        <label for="txtname" class="form-label">Nombre</label>
        <input type="text" required class="form-control" name="txtnombre" id="txtnombre" aria-describedby="helpId" value="<?php echo $oneCategoria ? $oneCategoria->nombre : "" ?>" placeholder="Nombre Categoria">
      </div>

      <div class="mb-2">
        <label for="txtemail" class="form-label">Descuento</label>
        <input type="number" min="0" required class="form-control" name="txtdescuento" id="txtdescuento" aria-describedby="emailHelpId" value="<?php echo $oneCategoria ? $oneCategoria->descuento : "" ?>" placeholder="123">
      </div>

      <p class="text-danger">
        <?php echo (isset($_GET["msg"])) ? $_GET["msg"] : "" ?>
      </p>

      <div class="btn-group w-100" role="group" aria-label="">
        <button type="submit" class="btn btn-success">Añadir</button>

        <button type="submit" formaction="<?php echo urlsite ?>?page=categorias&option=updateCategoria" class="btn btn-warning">Editar</button>

        <button type="submit" formaction="<?php echo urlsite ?>?page=categorias&option=deleteCategoria" class="btn btn-danger">Eliminar</button>
      </div>
    </form>
  </div>

  <div class="col-md-8">
    <div class="table-responsive">
      <table class="table table-light table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">DESC.</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($allCategorias as $categoria) : ?>
            <tr class="">
              <td scope="row"><?php echo $categoria->id ?></td>
              <td><?php echo $categoria->nombre ?></td>
              <td><?php echo $categoria->descuento ?></td>
              <td>

                <form action="<?php echo urlsite ?>?page=categorias" method="post">
                  <input type="hidden" name="txtid" id="txtid" value="<?php echo $categoria->id ?>">
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