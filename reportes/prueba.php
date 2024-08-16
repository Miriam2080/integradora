<?php
require('../conexion/conexion.php');
include '../fpdf/table.php';

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);

// Establece los anchos de las columnas
$pdf->SetWidths(array(30, 50, 50, 40));

$sql = "SELECT paquetes.Id_paquete, eventos.Nom_evento, tipo_paquete.tipo_de_paquete 
        FROM paquetes
        JOIN eventos ON paquetes.Id_eventos = eventos.Id_eventos
        JOIN tipo_paquete ON paquetes.Id_tipo_de_paquetes = tipo_paquete.Id_Tipo_de_paquetes
        ORDER BY paquetes.Id_paquete ASC, eventos.Nom_evento, tipo_paquete.tipo_de_paquete";
$productos = $conn->query($sql);

// Verifica si hay datos para mostrar
if ($productos->num_rows > 0) {
    // Itera sobre cada fila de resultados y agrega una fila al PDF
    while ($row = $productos->fetch_assoc()) {
        $pdf->Row(array(
            $row["Id_paquete"],
            $row["tipo_de_paquete"],
            $row["Nom_evento"],
        ));
    }
} else {
    $pdf->Row(array('No hay datos disponibles', '', '', ''));
}

// Cerrar la conexión
$conn->close();

// Salida del PDF
$pdf->Output();
?>
