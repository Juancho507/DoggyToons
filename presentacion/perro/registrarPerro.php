<?php
$idDueñoLogueado = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>
<body>
<?php 
include("presentacion/encabezadoD.php");
include("presentacion/menu" . ucfirst($rol) . ".php"); 

$mensaje = "";
$claseMensaje = "";

$razaLogica = new Raza();
$razas = $razaLogica->consultarTodos();
error_log("DEBUG: Página cargada. Método: " . $_SERVER['REQUEST_METHOD']);

if (isset($_POST["crearPerro"])) {
    error_log("DEBUG: Formulario 'crearPerro' enviado. Procesando...");
    $nombrePerro = $_POST["nombrePerro"] ?? '';
    $raza = new Raza ($_POST["razaId"]) ?? '';
    $fotoRuta = ""; 
    
    error_log("DEBUG: Datos POST recibidos - Nombre: '$nombrePerro', Raza ID: '{$raza -> getId() }'");
    
    $perro = new Perro(nombre: $nombrePerro, raza:$raza, dueño:$dueño);
    $guardadoExitoso = $perro->insertar();
    
    error_log("DEBUG: Resultado de perro->guardar(): " . ($guardadoExitoso ? 'TRUE' : 'FALSE'));
    
    if ($guardadoExitoso) {
        $mensaje = "¡Éxito! Perro '" . htmlspecialchars($nombrePerro) . "' registrado correctamente.";
        $claseMensaje = "alert-success";
        $_POST = array(); 
        error_log("DEBUG: Registro exitoso. Mensaje preparado.");
    } else {
        $mensaje = "Error al registrar el perro '" . htmlspecialchars($nombrePerro) . "'. Por favor, verifica los datos y reintenta.";
        $claseMensaje = "alert-danger";
        error_log("ERROR: Fallo en el registro. Mensaje preparado.");
    }
} else {
    error_log("DEBUG: No hay envío de formulario (GET).");
}
?>
<div class="container">
    <div class="row mt-4"> 
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header"><h4>Registrar Nuevo Perro</h4></div>
                <div class="card-body">
                    <?php if ($mensaje): // Mostrar el mensaje si existe ?>
                        <div class="alert <?php echo $claseMensaje; ?>" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= "?pid=".base64_encode("presentacion/perro/registrarPerro.php");?>" method="POST">
                        <div class="form-group mb-4"> 
                            <label for="nombrePerro">Nombre del Perro:</label>
                            <input type="text" class="form-control" id="nombrePerro" name="nombrePerro" required 
                            value="<?php echo isset($_POST['nombrePerro']) && $claseMensaje === 'alert-danger' ? htmlspecialchars($_POST['nombrePerro']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="razaId">Raza:</label>
                            <select class="form-control" id="razaId" name="razaId" required>
                                <option value="">Seleccione una raza</option>
                                <?php foreach ($razas as $razaItem): ?>
                                    <option value="<?php echo htmlspecialchars($razaItem->getId()); ?>"
                                    <?php echo isset($_POST['razaId']) && $_POST['razaId'] == $razaItem->getId() && $claseMensaje === 'alert-danger' ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($razaItem->getNombre()); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <button type="submit" name="crearPerro" class="btn btn-primary mt-4">Registrar Perro</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>