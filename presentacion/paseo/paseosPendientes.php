<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];

include("presentacion/encabezadoP.php");
include("presentacion/menu" . ucfirst($rol) . ".php");

$paseo = new Paseo();
$paseos = $paseo->consultarHistorial("paseador", $id); 


$estadoP = new EstadoPaseo();
$estadosPaseo = $estadoP->consultarTodos(); 

?>

<div class="container mt-4">
    <h2>Paseos</h2>

    <?php if (empty($paseos)) { ?>
        <div class="alert alert-info">No tienes paseos registrados.</div>
    <?php } else { ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="table-danger">
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Perro</th>
                    <th>Estado</th>
                    <th>Actualizar Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paseos as $p) { ?>
                    <tr > 
                        <td><?php echo substr($p->getFechaInicio(), 0, 10); ?></td>
                        <td><?php echo substr($p->getFechaInicio(), 11, 5); ?></td>
                        <td><?php echo $p->getNombrePerro(); ?></td>
                        <td id="estadoTexto<?php echo $p->getId(); ?>"><?php echo $p->getEstadoPaseo(); ?></td>
                        <td>
                            <?php foreach ($estadosPaseo as $e) {
                                if ($e->getId() == 1) continue;?> <button class="btn btn-outline-dark btn-sm me-1"
                                
                                    id="btnEstado<?php echo $e->getValor() . $p->getId(); ?>">
                                    <?php echo $e->getValor(); ?>
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<script>
$(document).ready(function(){
<?php 
foreach ($paseos as $p) {
    foreach ($estadosPaseo as $e) {
        echo '$("#btnEstado' . $e->getValor() . $p->getId() . '").click(function(){' . "\n";
        echo '  $.ajax({' . "\n";
        echo '    url: "ajax/actualizarEstadoPaseo.php",' . "\n";
        echo '    method: "GET",' . "\n";
        echo '    data: { id: "' . $p->getId() . '", estado: "' . $e->getId() . '" },' . "\n";
        echo '    success: function(response) {' . "\n";
        echo '      $("#estadoTexto' . $p->getId() . '").text("' . $e->getValor() . '");' . "\n";
        echo '    }' . "\n";
        echo '  });' . "\n";
        echo '});' . "\n";
    }
}
?>
});
</script>
