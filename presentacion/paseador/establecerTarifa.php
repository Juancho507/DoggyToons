<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>
<body>
<?php 
include("presentacion/encabezadoP.php"); 
include("presentacion/menu" . ucfirst($rol) . ".php"); 

require_once("logica/Paseador.php");
require_once("logica/Tarifa.php");

$paseador = new Paseador($id);
$paseador->consultar();
$tarifas = $paseador->getTarifas();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nuevoPrecio"])) {
    foreach ($_POST["nuevoPrecio"] as $idTamano => $nuevoPrecio) {
        $nuevoPrecio = intval($nuevoPrecio);
        $precioActual = intval($_POST["precioActual"][$idTamano]);

        if ($nuevoPrecio > 0 && $nuevoPrecio != $precioActual) {
            $tarifa = new Tarifa("", $nuevoPrecio, $id, $idTamano);
            $tarifa->desactivarAnterior();
            $tarifa->insertarNueva();
        }
    }
    $paseador->consultar();
    $tarifas = $paseador->getTarifas();

    echo "<div class='alert alert-success text-center mt-4'>¡Tarifas actualizadas correctamente!</div>";
}
?>

<div class="container mt-4">
  <h2>Mis Tarifas por Tamaño de Perro</h2>
  <p class="text-muted">Si deseas modificar alguna tarifa, escribe el nuevo precio y pulsa <strong>Actualizar tarifas</strong>.</p>

  <?php if (empty($tarifas)) { ?>
    <div class="alert alert-warning">No tienes tarifas registradas aún.</div>
  <?php } else { ?>
    <form method="post">
      <table class="table table-bordered table-hover">
        <thead class="table-info">
          <tr>
            <th>Tamaño del perro</th>
            <th>Precio actual (COP)</th>
            <th>Nuevo precio</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tarifas as $tarifa) { ?>
            <tr>
              <td><?php echo $tarifa->getNombreTamaño(); ?></td>
              <td>$<?php echo number_format($tarifa->getPrecioHora(), 0, ',', '.'); ?></td>
              <td>
                <input type="number" class="form-control" name="nuevoPrecio[<?php echo $tarifa->getTamañoIdTamaño(); ?>]" min="0" placeholder="Ej: 8000">
                <input type="hidden" name="precioActual[<?php echo $tarifa->getTamañoIdTamaño(); ?>]" value="<?php echo $tarifa->getPrecioHora(); ?>">
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="text-center">
        <button type="submit" class="btn btn-success">Actualizar tarifas</button>
      </div>
    </form>
  <?php } ?>
</div>
