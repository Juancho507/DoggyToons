<?php
include("presentacion/encabezadoA.php");
include("presentacion/menuAdministrador.php");

$paseador = new Paseador();
$lista = $paseador->consultarTodos();
?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Gestionar Paseadores</h2>

<<<<<<< HEAD
  <!-- 🔍 Filtro de búsqueda -->
=======
  <!-- Filtro -->
>>>>>>> 4751c00 (Filtros)
  <div class="mb-3">
    <input type="text" id="filtroPaseador" class="form-control" placeholder="Buscar por nombre, correo o contacto...">
  </div>

  <table class="table table-striped table-hover" id="tablaPaseadores">
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
<<<<<<< HEAD
          <td><?= htmlspecialchars($p->getNombre() . " " . $p->getApellido()) ?></td>
          <td><?= htmlspecialchars($p->getCorreo()) ?></td>
          <td><?= htmlspecialchars($p->getContacto()) ?></td>
=======
          <td class="nombre"><?= htmlspecialchars($p->getNombre() . " " . $p->getApellido()) ?></td>
          <td class="correo"><?= htmlspecialchars($p->getCorreo()) ?></td>
          <td class="contacto"><?= htmlspecialchars($p->getContacto()) ?></td>
>>>>>>> 4751c00 (Filtros)
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
<<<<<<< HEAD

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// AJAX para cambiar estado
$(".toggle-estado").click(function() {
=======
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function resaltar(texto, palabras) {
  palabras.forEach(p => {
    if (p.trim() === "") return;
    const re = new RegExp("(" + p.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ")", "gi");
    texto = texto.replace(re, "<strong>$1</strong>");
  });
  return texto;
}

function aplicarFiltro() {
  const filtro = $("#filtroPaseador").val().toLowerCase().trim();
  const palabras = filtro.split(/\s+/);

  $("#tablaPaseadores tbody tr").each(function () {
    const fila = $(this);
    const nombreOriginal = fila.find(".nombre").text();
    const correoOriginal = fila.find(".correo").text();
    const contactoOriginal = fila.find(".contacto").text();

    const textoCompleto = (nombreOriginal + " " + correoOriginal + " " + contactoOriginal).toLowerCase();

    const coincide = palabras.every(p => textoCompleto.includes(p));

    if (coincide) {
      fila.show();
      fila.find(".nombre").html(resaltar(nombreOriginal, palabras));
      fila.find(".correo").html(resaltar(correoOriginal, palabras));
      fila.find(".contacto").html(resaltar(contactoOriginal, palabras));
    } else {
      fila.hide();
    }
  });
}

// 🔄 AJAX para cambiar estado
$(document).on("click", ".toggle-estado", function () {
>>>>>>> 4751c00 (Filtros)
  const btn = $(this);
  const id = btn.data("id");
  const estadoActual = btn.data("estado");
  const nuevoEstado = estadoActual == 1 ? 0 : 1;

  $.ajax({
    url: "ajax/paseadorEstadoAjax.php",
    method: "POST",
    data: { idPaseador: id, estado: nuevoEstado },
    success: function (response) {
      if (response.trim() === "ok") {
<<<<<<< HEAD
        const estadoSpan = $("#estado-" + id);
        estadoSpan.text(nuevoEstado == 1 ? "Activo" : "Inactivo")
                  .removeClass("bg-success bg-danger")
                  .addClass(nuevoEstado == 1 ? "bg-success" : "bg-danger");
=======
        const fila = btn.closest("tr");
        const estadoSpan = fila.find("span[id^='estado-']");

        estadoSpan.text(nuevoEstado == 1 ? "Activo" : "Inactivo")
          .removeClass("bg-success bg-danger")
          .addClass(nuevoEstado == 1 ? "bg-success" : "bg-danger");
>>>>>>> 4751c00 (Filtros)

        btn.text(nuevoEstado == 1 ? "Deshabilitar" : "Habilitar")
          .removeClass("btn-success btn-danger")
          .addClass(nuevoEstado == 1 ? "btn-danger" : "btn-success");

        btn.data("estado", nuevoEstado);

<<<<<<< HEAD
        $("#respuestaAjax").html(`<div class="alert alert-success">✅ Estado actualizado correctamente.</div>`);
      } else {
        $("#respuestaAjax").html(`<div class="alert alert-danger">❌ Error al actualizar el estado.</div>`);
      }
    },
    error: function() {
      $("#respuestaAjax").html(`<div class="alert alert-danger">⚠️ Error de comunicación con el servidor.</div>`);
=======
        $("#respuestaAjax").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
          ✅ Estado actualizado correctamente.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`);

        aplicarFiltro(); // 🔁 Recargar filtro tras cambio
      } else {
        $("#respuestaAjax").html(`<div class="alert alert-danger">❌ Error al actualizar estado.</div>`);
      }
    },
    error: function () {
      $("#respuestaAjax").html(`<div class="alert alert-danger">⚠️ Error de comunicación.</div>`);
>>>>>>> 4751c00 (Filtros)
    }
  });
});

<<<<<<< HEAD
// 🔍 Filtro de búsqueda en tiempo real
$("#filtroPaseador").on("keyup", function() {
  const valor = $(this).val().toLowerCase();
  $("#tablaPaseadores tbody tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().includes(valor));
  });
});
=======
// 🔍 Filtro con resaltado
$("#filtroPaseador").on("input", aplicarFiltro);
>>>>>>> 4751c00 (Filtros)
</script>
