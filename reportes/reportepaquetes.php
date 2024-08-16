<?php

session_start();
if (!isset($_SESSION["correo"])) {
    header("location: ../sesion/iniciar_sesion.php");
    exit;
}

require('../fpdf/fpdf.php');

require_once("../conexion/conexion.php");
class PDF extends FPDF
{
  function Header()
  {
    // se agrega imagenes aqui >
    // Logo     el 8 define el tama�o el 10 es un tab, el 8 es lineas

    $this->Image('../img/inlogo.png', 170, 8, 30);
  }
}
//CREACION DE LA HOJA

$pdf = new PDF('p', 'mm', 'Letter');
$pdf->setMargins(20, 18);
$pdf->AliasNbPages();
$pdf->AddPage();

//TITULO este es el titulo del documento pdf que aparecera en la cabecera
$pdf->SetTextColor(0x00, 0x00, 0x00);
$pdf->SetFont('Arial', 'b', 12);
$pdf->Cell(0, 5, 'DEVELOPER WEB', 0, 1, 'C');
$pdf->Cell(0, 5, 'PAQUETES REGISTRADOS ', 0, 1, 'C');


$pdf->Ln();



$pdf->Ln();

//1 indica borde, 0 no hace salto de linea, c es centrado
// la consulta sql aqui pongan sus consultas dolo remplacen ahi 

$result = mysqli_query($conn, "SELECT paquetes.Id_paquete, eventos.Nom_evento, tipo_paquete.tipo_de_paquete 
                                FROM paquetes
                                JOIN eventos ON paquetes.Id_eventos = eventos.Id_eventos
                                JOIN tipo_paquete ON paquetes.Id_tipo_de_paquetes = tipo_paquete.Id_Tipo_de_paquetes
                                ORDER BY paquetes.Id_paquete ASC, eventos.Nom_evento, tipo_paquete.tipo_de_paquete");

// este es un salto de linea  
$pdf->Ln();
// este es el tipo de letra 

$pdf->SetFont('Arial', 'b', 10);

$pdf->Ln();
// la tabla en general 
// $pdf->SetTextColor(100, 100, 100);

//aqui agregue las cabeceras de las tablas aquui simplemente coocan como se mostrara en la cabecera de  la tabla
// si ustedes tienen mas campos solo copeen esto $pdf->Cell(20,5, "ID",1,0,'C'); y en vez del campo id le ponen lo que se mostrara
// igual si agregan una fila mas aqui recuerden que en la tabla desde db tambien


$pdf->Cell(20, 8, "ID", 1, 0, 'C');
$pdf->Cell(70, 8, "PAQUETE", 1, 0, 'C');
$pdf->Cell(85, 8, "EVENTO", 1, 0, 'C');
while ($row = mysqli_fetch_array($result)) {
  $pdf->Ln();
  $pdf->SetFont('Arial', '', 12);

  // tabla db
  // aqui agreguen sus campos como estan en la db por ejemplo aqui Id_tipo_de_paquetes ese es mi campo desde la db
  $pdf->Cell(20, 10, utf8_decode($row['Id_paquete']) , 1, 0, 'C');
  $pdf->Cell(70, 10, utf8_decode($row['tipo_de_paquete']), 1, 0, 'C');
  $pdf->Cell(85, 10, utf8_decode($row['Nom_evento']), 1, 0, 'C');
}

mysqli_close($conn);
$pdf->Output();
