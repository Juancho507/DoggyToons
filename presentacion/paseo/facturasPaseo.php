<?php
ob_start();
require_once(__DIR__ . "/../../fpdf/fpdf.php");

$dueñoId = $_SESSION["id"] ?? null;
$idPerro = $_GET["idPerro"] ?? 0;

if (!$idPerro || !$dueñoId) {
    exit("Datos inválidos.");
}

$paseo = new Paseo();
$paseos = $paseo->consultarPaseosCompletadosPorPerro($idPerro);

$pdf = new FPDF();
$pdf->AddPage();

// --- Logo ---
$pdf->Image("img/logo.png", 10, 10, 30); // Logo en la esquina superior izquierda

// --- Título centrado en negro ---
$pdf->SetY(20); // Ajuste vertical debajo del logo
$pdf->SetFont("Arial", "B", 18);
$pdf->SetTextColor(0); // Texto en negro
$pdf->Cell(0, 15, "DoggyToons - Factura de Paseos", 0, 1, "C");

$pdf->Ln(20); // Espacio adicional después del título

// --- Obtener nombre del perrito ---
$nombrePerro = "";
foreach ($paseos as $p) {
    if ($p->getIdPerro() == $idPerro) {
        $nombrePerro = $p->getNombrePerro();
        break;
    }
}
if ($nombrePerro == "") {
    exit("No se encontraron datos para este perro.");
}

// --- Encabezado perro ---
$pdf->SetFont("Arial", "B", 14);
$pdf->Cell(0, 10, "Perrito: " . $nombrePerro, 0, 1, "L");
$pdf->Ln(4);

// --- Encabezado tabla ---
$pdf->SetFont("Arial", "B", 12);
$pdf->SetFillColor(230, 230, 250);
$pdf->Cell(20, 10, "ID", 1, 0, 'C', true);
$pdf->Cell(30, 10, "Fecha", 1, 0, 'C', true);
$pdf->Cell(30, 10, "Hora Ini.", 1, 0, 'C', true);
$pdf->Cell(30, 10, "Hora Fin", 1, 0, 'C', true);
$pdf->Cell(50, 10, "Paseador", 1, 0, 'C', true);
$pdf->Cell(30, 10, "Precio", 1, 1, 'C', true);

// --- Datos ---
$pdf->SetFont("Arial", "", 11);
$hayFacturas = false;

foreach ($paseos as $p) {
    if (
        strtolower(trim($p->getEstadoPaseo())) == "completado" &&
        $p->getIdPerro() == $idPerro
        ) {
            $hayFacturas = true;
            $fechaInicio = new DateTime($p->getFechaInicio());
            $fechaFin = new DateTime($p->getFechaFin());
            
            $pdf->Cell(20, 10, $p->getId(), 1, 0, 'C');
            $pdf->Cell(30, 10, $fechaInicio->format("Y-m-d"), 1, 0, 'C');
            $pdf->Cell(30, 10, $fechaInicio->format("H:i"), 1, 0, 'C');
            $pdf->Cell(30, 10, $fechaFin->format("H:i"), 1, 0, 'C');
            $pdf->Cell(50, 10, $p->getPaseador(), 1, 0, 'C');
            $pdf->Cell(30, 10, "$" . number_format($p->getPrecio(), 0, '', '.'), 1, 1, 'C');
        }
}

if (!$hayFacturas) {
    $pdf->Ln(10);
    $pdf->SetFont("Arial", "I", 12);
    $pdf->Cell(0, 10, "Este perrito aún no tiene paseos completados.", 0, 1, "C");
}

// --- Footer ---
$pdf->Ln(10);
$pdf->SetFont("Arial", "I", 10);
$pdf->Cell(0, 10, "Gracias por confiar en DoggyToons", 0, 1, "C");

ob_start();
$pdf->Output("I", "Factura_{$nombrePerro}.pdf");
exit();

