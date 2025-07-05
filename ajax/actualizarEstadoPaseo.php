<?php
require_once(__DIR__ . "/../logica/Paseo.php");
require_once(__DIR__ . "/../logica/EstadoPaseo.php");
$id = $_GET["id"];
$nuevoEstado = $_GET["estado"];

$paseo = new Paseo($id);
if ($paseo->actualizarEstado($nuevoEstado)) {
    $estado = new EstadoPaseo($nuevoEstado);
    $estado->consultarTodosLosEstados(); 
    echo $estado->getValor();
}
?>
