<?php
if($_SESSION["rol"] != "dueño"){
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
}
$id = $_SESSION["id"];
?>
<body>
<?php 
include ("presentacion/encabezadoD.php");
include ("presentacion/menuDueño.php");
$dueño = new Dueño($id);
$dueño ->consultar();
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-7 mx-auto"> 
      <div class="card">
        <div class="card-body">
        <h2 class="my-2">Perfil</h2>
          <div class="table-responsive-sm my-2">
            <table class="table table-striped">
              <tr>
                <th>Nombre</th>
                <td><?php echo $dueño->getNombre(); ?></td>
              </tr>
              <tr>
                <th>Apellido</th>
                <td><?php echo $dueño->getApellido(); ?></td>
              </tr>
              <tr>
                <th>Correo</th>
                <td><?php echo $dueño->getCorreo(); ?></td>
              </tr>
              <tr>
                <th>Contacto</th>
                <td><?php echo $dueño->getContacto(); ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
