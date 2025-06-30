<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>
<body>
<?php 
include("presentacion/encabezadoD.php"); 
include("presentacion/menu" . ucfirst($rol) . ".php"); 
$paseoLogica = new Paseo();
$historialPaseos = $paseoLogica->consultarHistorial($rol, $id);
?>
<div class="container">
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header"><h4>Historial de Paseos</h4></div>
                <div class="card-body">
                    <?php
                    $cantidadPaseos = count($historialPaseos);
                    echo "<strong>" . $cantidadPaseos . " paseo" . ($cantidadPaseos !== 1 ? "s" : "") . " encontrado" . ($cantidadPaseos !== 1 ? "s" : ""). "</strong><br>";;

                    if (empty($historialPaseos)) {
                        echo "<div class='alert alert-warning mt-3'>No se encontraron paseos en el historial.</div>";
                    } else {
                        echo "<table class='table table-striped table-hover mt-3'>";
                        echo "<thead><tr><th>Id Paseo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Paseador</th><th>Perro</th> <th>Estado</th></tr></thead>";
                        echo "<tbody>";
                        foreach($historialPaseos as $paseoItem){
                            echo "<tr>";
                            echo "<td class='align-middle'>" . htmlspecialchars($paseoItem->getId()) . "</td>";
                            echo "<td class='align-middle'>" . htmlspecialchars($paseoItem->getFechaInicio()) . "</td>";
                            echo "<td class='align-middle'>" . htmlspecialchars($paseoItem->getFechaFin()) . "</td>";
                            echo "<td class='align-middle'>" . htmlspecialchars($paseoItem->getPaseador()) . "</td>";
                            echo "<td class='align-middle'>" . htmlspecialchars($paseoItem->getNombrePerro()) . "</td>";
                            echo "<td class='align-middle'>" . htmlspecialchars($paseoItem->getEstadoPaseo()) . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>