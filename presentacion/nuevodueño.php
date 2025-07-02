<?php

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
            $_POST = [];
        } catch (Exception $e) {
            $error = true;
        }
    }
}
?>

<body style="background-color: #EEE4FA; font-family: 'Segoe UI', sans-serif; min-height: 100vh; position: relative;">
  <div style="position: absolute; top: 10px; left: 20px;">
    <div class="rounded-circle overflow-hidden shadow" style="width: 110px; height: 110px;">
      <img src="img/logo.png" alt="Logo DoggyToons" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
  </div>
  

  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 mt-4">
      <h2 class="text-center">Registrar nuevo dueño</h2>
      <form method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" autocomplete="off" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Apellido</label>
          <input type="text" name="apellido" class="form-control" autocomplete="off" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Correo</label>
          <input type="email" name="correo" class="form-control" autocomplete="off" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="clave" class="form-control" autocomplete="new-password" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Contacto</label>
          <input type="number" name="contacto" class="form-control" autocomplete="off" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Foto de perfil</label>
          <input type="file" name="foto" class="form-control">
        </div>

        <?php if ($exito): ?>
          <div class="alert alert-success text-center mb-3">✅ ¡Usuario registrado exitosamente!</div>
        <?php elseif ($correoDuplicado): ?>
          <div class="alert alert-warning text-center mb-3">⚠️ El correo ya está registrado. Intenta con otro.</div>
        <?php elseif ($error): ?>
          <div class="alert alert-danger text-center mb-3">❌ Error al registrar el usuario. Inténtalo de nuevo.</div>
        <?php endif; ?>
        <button type="submit" name="registrarDueño" class="btn w-100" style="background-color: #7e57c2; color: white; border: none;">Registrar</button>
      </form>
    </div>
  </div>

  <div class="text-center mt-3 mb-5">
    <a href="index.php" class="text-decoration-none" style="color:#7e57c2;">← Volver al inicio</a>
  </div>

</body>

