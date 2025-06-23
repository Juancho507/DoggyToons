<?php
require_once "logica/Dueño.php";

$exito = false;
$error = false;
$correoDuplicado = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $contacto = $_POST["contacto"];
    $foto = $_FILES["foto"]["name"];

    if (!is_dir("img/fotos")) {
        mkdir("img/fotos", 0777, true);
    }

    if ($foto != "") {
        move_uploaded_file($_FILES["foto"]["tmp_name"], "img/fotos/" . $foto);
    }

    $dueño = new Dueño("", $nombre, $apellido, $correo, $clave, $contacto, $foto);

    if ($dueño->correoExiste()) {
        $correoDuplicado = true;
    } else {
        try {
            $dueño->registrar();
            $exito = true;
        } catch (Exception $e) {
            $error = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Dueño</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #EEE4FA">
<div class="container mt-5">
  <h2 class="text-center">Registrar nuevo dueño</h2>
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Apellido</label>
        <input type="text" name="apellido" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Correo</label>
        <input type="email" name="correo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="clave" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contacto</label>
        <input type="number" name="contacto" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Foto de perfil</label>
        <input type="file" name="foto" class="form-control">
      </div>
      <button type="submit" class="btn w-100" style="background-color: #7e57c2; color: white; border: none;">Registrar</button>
    </form>
  </div>
</div>
  <div class="mt-3 text-center">
    <a href="index.php" class="text-decoration-none" style="color:#7e57c2;">Volver al inicio</a>
  </div>
  </div>
</body>
</html>
