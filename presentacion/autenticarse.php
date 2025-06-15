<?php 
require_once "logica/Administrador.php";
require_once "logica/Paseador.php";
require_once "logica/Dueño.php";

if(isset($_GET["sesion"])){
    if($_GET["sesion"] == "false"){
        session_destroy();
    }
}
$error=false;
if(isset($_POST["autenticarse"])){
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $administrador = new Administrador("", "", "", $correo, $clave);
    if($administrador -> autenticarse()){
        $_SESSION["id"] = $administrador -> getId();
        $_SESSION["rol"] = "administrador";
        header("Location: ?pid=" . base64_encode("presentacion/sesionAdministrador.php"));
    }else {
        $paseador = new Paseador("", "", "", $correo, $clave);
        if($paseador -> autenticarse()){
            $_SESSION["id"] = $paseador -> getId();
            $_SESSION["rol"] = "paseador";
            header("Location: ?pid=" . base64_encode("presentacion/sesionPaseador.php"));
        }else{
            $dueño = new Dueño("", "", "", $correo, $clave);
            if($dueño -> autenticarse()){
                $_SESSION["id"] = $dueño -> getId();
                $_SESSION["rol"] = "dueño";
                header("Location: ?pid=" . base64_encode("presentacion/sesionDueño.php"));
            }else{
                $error=true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - DoggyToons</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff3b0;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      overflow-x: hidden;
      position: relative;
    }

    .main-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 2rem 1rem;
      position: relative;
      z-index: 1;
    }

    .left-panel {
      text-align: center;
      z-index: 2;
      padding: 1rem;
    }

    .logo-container {
      width: 220px;
      height: 220px;
      border-radius: 50%;
      overflow: hidden;
      margin-bottom: 1rem;
      margin-left: auto;
      margin-right: auto;
    }

    .logo-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .description {
      margin-top: 1.5rem;
      text-align: center;
    }

    .description p {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .description ul {
      list-style: none;
      padding-left: 0;
      margin: 0;
      text-align: center;
    }

    .description ul li {
      font-size: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 0.4rem;
    }

    .description ul li::before {
      content: "✔️";
      padding-right: 8px;
      color: #007b5e;
      font-size: 0.9rem;
    }

    .card-login {
      width: 100%;
      max-width: 500px;
      padding: 3rem;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      background-color: white;
      z-index: 2;
      position: relative;
    }

    .btn-orange {
      background-color: #e67e22;
      color: white;
    }

    .btn-orange:hover {
      background-color: #cf711b;
    }

    .link-orange {
      color: #e67e22;
      text-decoration: none;
    }

    .link-orange:hover {
      text-decoration: underline;
    }

    .paw-image {
      position: fixed;
      width: 100px;
      z-index: 0;
    }

    .paw-top-right {
      top: 0;
      right: 0;
    }

    .paw-bottom-left {
      bottom: 0;
      left: 0;
    }

    @media (max-width: 992px) {
      .row.flex-lg-row {
        flex-direction: column !important;
      }
      .text-lg-start {
        text-align: center !important;
      }
      .description {
        text-align: center !important;
      }
      .description p {
        text-align: center !important;
      }
      .description ul li {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

  <!-- Imagen superior derecha -->
  <img src="img/huellas_superior.png" alt="huellas1" class="paw-image paw-top-right">

  <!-- Imagen inferior izquierda -->
  <img src="img/huellas_inferior.png" alt="huellas2" class="paw-image paw-bottom-left">

  <div class="container-fluid main-container">
    <div class="row w-100 flex-lg-row flex-column justify-content-center align-items-center text-center">

      <div class="col-lg-5 col-12 left-panel text-lg-start d-flex flex-column justify-content-center align-items-center">
        <div class="logo-container">
          <img src="img/logo.png" alt="Logo DoggyToons">
        </div>
        <div class="description">
          <p>Paseos personalizados para tu perrito.</p>
          <ul>
            <li><span>Elije a tu paseador</span></li>
            <li><span>Elije tus horarios</span></li>
            <li><span>Elije tu precio</span></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-5 col-12 d-flex justify-content-center mt-4 mt-lg-0">
        <div class="card card-login">
          <h4 class="text-center mb-4">Bienvenido a DoggyToons</h4>
          <form action="index.php?pid=<?php echo base64_encode("presentacion/autenticarse.php"); ?>" method="POST">
            <input type="hidden" name="autenticarse" value="1">
            <div class="mb-3 text-start">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3 text-start">
                <label for="clave" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="clave" name="clave" required>
            </div>
            <button type="submit" class="btn btn-orange w-100">Iniciar Sesión</button>
            </form>

                        <?php 
    					if ($error){
    					    echo "<div class='alert alert-danger mt-3' role='alert'>Clave o correo incorrecto</div>";
    					}
    					?>

          <div class="text-center mt-3">
            <a href="#" class="link-orange">¿Eres dueño nuevo? Regístrate aquí</a>
          </div>
        </div>
      </div>

    </div>
  </div>

</body>
</html>



