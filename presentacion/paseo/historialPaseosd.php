<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = $_SESSION["id"];
$rol = "dueño";

require_once("logica/Paseo.php");
include("presentacion/encabezadoD.php");
include("presentacion/menuDueño.php");

$paseoLogica = new Paseo();
$historialPaseos = $paseoLogica->consultarHistorial($rol, $id);
?>

<div class="container mt-4">
  <h4>Historial de Paseos (Dueño)</h4>

  <?php if (empty($historialPaseos)) { ?>
    <div class='alert alert-warning mt-3'>No se encontraron paseos en el historial.</div>
  <?php } else { ?>
    <table class='table table-bordered table-striped mt-3'>
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha</th>
          <th>Inicio</th>
          <th>Fin</th>
          <th>Perro</th>
          <th>Paseador</th>
          <th>Precio</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($historialPaseos as $paseo) {
          $fechaInicio = new DateTime($paseo->getFechaInicio());
          $fechaFin = new DateTime($paseo->getFechaFin());
        ?>
          <tr>
            <td><?= $paseo->getId() ?></td>
            <td><?= $fechaInicio->format('Y-m-d') ?></td>
            <td><?= $fechaInicio->format('H:i') ?></td>
            <td><?= $fechaFin->format('H:i') ?></td>
            <td><?= htmlspecialchars($paseo->getNombrePerro()) ?></td>
            <td><?= htmlspecialchars($paseo->getPaseador()) ?></td>
            <td>$<?= number_format($paseo->getPrecio(), 0) ?></td>
            <td><?= htmlspecialchars($paseo->getEstadoPaseo()) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>
