<?php
$id = $_SESSION["id"];
$dueño = new Dueño($id);
$dueño->consultar();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
  <a class="navbar-brand" href="?pid=<?php echo base64_encode("presentacion/sesionDueño.php") ?>">
    <i class="fa-solid fa-dog"></i> Panel Dueño
  </a>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDueño" aria-controls="navbarDueño" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarDueño">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <li class="nav-item">
        <a class="nav-link" href="?pid=<?php echo base64_encode("presentacion/sesionDueño.php") ?>">
          <i class="fa-solid fa-house"></i> Inicio
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="perrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-dog"></i> Mis Perritos
        </a>
        <ul class="dropdown-menu" aria-labelledby="perrosDropdown">
          <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/perro/registrarPerro.php") ?>">Registrar Nuevo</a></li>
          <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/perro/consultarPerros.php") ?>">Ver Todos</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?pid=<?php echo base64_encode("presentacion/paseo/solicitarPaseo.php") ?>">
          <i class="fa-solid fa-calendar-plus"></i> Solicitar Paseo
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?pid=<?php echo base64_encode("presentacion/paseo/historialPaseosDueño.php") ?>">
          <i class="fa-solid fa-list"></i> Historial de Paseos
        </a>
      </li>

    </ul>

    <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item">
        <span class="navbar-text text-white me-3">
          <?php echo $dueño->getNombre() . " " . $dueño->getApellido(); ?>
        </span>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="?pid=<?php echo base64_encode("presentacion/autenticarse.php") ?>&sesion=false">
          <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
        </a>
      </li>
    </ul>
  </div>
</nav>
