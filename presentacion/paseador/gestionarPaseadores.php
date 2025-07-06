<?php
include("presentacion/encabezadoA.php");
include("presentacion/menuAdministrador.php");

$paseador = new Paseador();
$lista = $paseador->consultarTodos();
?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Gestionar Paseadores</h2>

  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Contacto</th>
        <th>Estado</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($lista as $p): ?>
        <tr>
          <td><?= $p->getNombre() . " " . $p->getApellido(); ?></td>
          <td><?= $p->getCorreo(); ?></td>
          <td><?= $p->getContacto(); ?></td>
          <td>
            <span class="badge bg-<?= $p->getActivo() == 1 ? 'success' : 'danger'; ?>" id="estado-<?= $p->getId(); ?>">
              <?= $p->getActivo() == 1 ? 'Activo' : 'Inactivo'; ?>
            </span>
          </td>
          <td>
            <button class="btn btn-sm btn-<?= $p->getActivo() == 1 ? 'danger' : 'success'; ?> toggle-estado"
                    data-id="<?= $p->getId(); ?>" 
                    data-estado="<?= $p->getActivo(); ?>">
              <?= $p->getActivo() == 1 ? 'Deshabilitar' : 'Habilitar'; ?>
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div id="respuestaAjax" class="mt-3"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(".toggle-estado").click(function() {
  const btn = $(this);
  const id = btn.data("id");
  const estadoActual = btn.data("estado");
  const nuevoEstado = estadoActual == 1 ? 0 : 1;

  $.ajax({
    url: "ajax/paseadorEstadoAjax.php",
    method: "POST",
    data: { idPaseador: id, estado: nuevoEstado },
    success: function(response) {
      if (response.trim() === "ok") {
        const estadoSpan = $("#estado-" + id);
        estadoSpan.text(nuevoEstado == 1 ? "Activo" : "Inactivo")
                  .removeClass("bg-success bg-danger")
                  .addClass(nuevoEstado == 1 ? "bg-success" : "bg-danger");

        btn.text(nuevoEstado == 1 ? "Deshabilitar" : "Habilitar")
           .removeClass("btn-success btn-danger")
           .addClass(nuevoEstado == 1 ? "btn-danger" : "btn-success");

        btn.data("estado", nuevoEstado);

        $("#respuestaAjax").html(`<div class="alert alert-success">✅ Estado actualizado correctamente.</div>`);
      } else {
        $("#respuestaAjax").html(`<div class="alert alert-danger">❌ ${response}</div>`);
      }
    },
    error: function() {
      $("#respuestaAjax").html(`<div class="alert alert-danger">⚠️ Error de comunicación con el servidor.</div>`);
    }
  });
});
</script>
