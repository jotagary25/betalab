<?php require "./views/layouts/header.php" ?>

<div class="card border-success mb-4 mt-4">
  <div class="card-header">
    <p class="">Orden de análisis Nro: <?php echo $idOrden ?></p>
    <p class="">Asociados al Sr. <strong><?php echo $paciente->nombre ?></strong> </p>
  </div>

  <div class="table-responsive-md card-body">
    <table class="table table-hover border-success">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Descargar</th>
          <th scope="col">Ver</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($allExamen as $examen) : ?>
          <tr class="">
            <td scope="row"><?php echo $examen->archivo ?></td>
            <td>
              <a class="btn btn-success btn-sm" title="Enlace" href="./public/examenes/<?php echo $examen->archivo ?>" download="<?php echo $examen->archivo ?>">DESCARGAR</a>
            </td>
            <td>
              <a class="btn btn-primary btn-sm" title="Enlace" href="./public/examenes/<?php echo $examen->archivo ?>" target="_blank">VER</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>


<?php require "./views/layouts/footer.php" ?>