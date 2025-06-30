<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] != "dueño") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
    exit();
}

$id = $_SESSION["id"];
$dueño = new Dueño($id);
$dueño->eliminar();
session_destroy();
header("Location: ?pid=" . base64_encode("presentacion/autenticarse.php") . "&eliminado=1");
exit();
?>
