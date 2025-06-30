<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];

$mensaje = "";
$perro = new Perro();
$listaPerros = $perro->consultar("dueño", $id);
$paseador = new Paseador();
$paseadores = $paseador->consultarTodos(); 

if (isset($_POST["solicitar"])) {
    $idPerro = $_POST["perro"];
    $idPaseador = $_POST["paseador"];
    $fechaHora = $_POST["fecha_hora"]; 
    
    if (!empty($idPerro) && !empty($idPaseador) && !empty($fechaHora)) {
        $estadoPendiente = 1;
        $fechaInicio = new DateTime($fechaHora);
        $fechaFin = clone $fechaInicio;
        $fechaFin->modify('+1 hour');
        $fechaInicioSQL = $fechaInicio->format('Y-m-d H:i:s');
        $fechaFinSQL = $fechaFin->format('Y-m-d H:i:s');
        $paseo = new Paseo(0, $fechaInicioSQL, $fechaFinSQL, $idPaseador, $estadoPendiente);
        if ($paseo->insertar($idPerro)) {
            $mensaje = "<div class='alert alert-success'>Solicitud enviada. Espere que el paseador acepte el paseo.</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>Error al solicitar el paseo. Intente nuevamente.</div>";
        }
    } else {
        $mensaje = "<div class='alert alert-warning'>Debe llenar todos los campos.</div>";
    }
}
?>

<body>
<?php
include("presentacion/encabezadoD.php");
include("presentacion/menu" . ucfirst($rol) . ".php");
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h4>Solicitar Paseo</h4>
                </div>
                <div class="card-body">
                    <?php echo $mensaje; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Seleccione un perro</label>
                            <select name="perro" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                <?php foreach ($listaPerros as $p) { ?>
                                    <option value="<?php echo $p->getId(); ?>">
                                        <?php echo htmlspecialchars($p->getNombre()); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Seleccione un paseador</label>
                            <select name="paseador" class="form-control" required>
                                <option value="">-- Seleccione --</option>
                                <?php foreach ($paseadores as $p): ?>
                                    <option value="<?php echo $p->getId(); ?>">
                                        <?php echo htmlspecialchars($p->getNombre() . " " . $p->getApellido()); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha y Hora del Paseo</label>
                            <input type="datetime-local" name="fecha_hora" class="form-control" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" name="solicitar" class="btn btn-secondary">Solicitar Paseo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
