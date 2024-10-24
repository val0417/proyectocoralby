<?php
require('fpdf.php');
include 'config.php';

// Recibir el ID de la factura desde la URL
$fac_enc_id = $_GET['id'];

// Consultar la información de la factura
$stmt = $pdo->prepare("
    SELECT f.fac_enc_id, c.cli_nom, c.cli_doc, f.fec_enc_fecha, 
           GROUP_CONCAT(p.pro_nom ORDER BY p.pro_nom SEPARATOR ', ') AS productos,
           GROUP_CONCAT(d.fact_det_cant ORDER BY p.pro_nom SEPARATOR ', ') AS cantidades,
           SUM(d.fact_det_cant * p.pro_pre) AS total
    FROM factura f
    JOIN clientes c ON f.cli_id = c.cli_id
    JOIN factura_det_pro d ON f.fac_enc_id = d.fac_enc_id
    JOIN productos p ON d.pro_id = p.pro_id
    WHERE f.fac_enc_id = ?
    GROUP BY f.fac_enc_id
");
$stmt->execute([$fac_enc_id]);
$row = $stmt->fetch();

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Factura', 0, 1, 'C');
$pdf->Ln(10);

// Mostrar información del cliente
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, 'Nombre del Cliente: ' . $row['cli_nom'], 0, 1);
$pdf->Cell(0, 10, 'Documento: ' . $row['cli_doc'], 0, 1);
$pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y', strtotime($row['fec_enc_fecha'])), 0, 1);
$pdf->Ln(10);

// Detalle de productos
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, 'Producto', 1);
$pdf->Cell(40, 10, 'Cantidad', 1);
$pdf->Cell(40, 10, 'Subtotal', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
$productos = explode(',', $row['productos']);
$cantidades = explode(',', $row['cantidades']);

for ($i = 0; $i < count($productos); $i++) {
    $subtotal = $cantidades[$i] * (floatval($row['total']) / array_sum($cantidades)); // Distribuir el total por la cantidad
    $pdf->Cell(80, 10, $productos[$i], 1);
    $pdf->Cell(40, 10, $cantidades[$i], 1);
    $pdf->Cell(40, 10, number_format($subtotal, 2), 1);
    $pdf->Ln();
}

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(120, 10, 'Total:', 0);
$pdf->Cell(40, 10, number_format($row['total'], 2), 1);

// Guardar el PDF con el nombre del cliente
$nombre_cliente = preg_replace('/[^a-zA-Z0-9_-]/', '_', $row['cli_nom']);
$pdf->Output('D', "$nombre_cliente.pdf");
exit;
?>
