<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("location: ../sesion/iniciar_sesion.php");
    exit;
}

require('../fpdf/fpdf.php');
// IGUAL ACA RECUERDEN INCLUIR BIEN EL ARCHIVO DE LA CNEXION COMO LO TENGAN require_once("../conndb/conexion.php");
require_once("../conexion/conexion.php");
class PDF extends FPDF{
  function Header()
{
    // se agrega imagenes aqui >
    // Logo     el 8 define el tama�o el 10 es un tab, el 8 es lineas
  // RECUERDA REFERENCIAR LA IMAGEN BIEN !!! ../img/inlogo.png  . RELLENAR AQUI
    $this->Image('../img/inlogo.png',170,8,30);
}
}
//CREACION DE LA HOJA

$pdf = new PDF('p', 'mm','Letter');
$pdf->setMargins(5,18);
$pdf->AliasNbPages('Developerweb');
$pdf->AddPage();


$pdf->SetTextColor(0x00,0x00,0x00);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(0,5,'DEVELOPER WEB',0,1,'C');
$pdf->Cell(0,5,'EVENTOS REGISTRADOS ',0,1,'C');

  $pdf->Ln();

  $pdf->Ln();

$result = mysqli_query($conn, "SELECT eventos.Id_eventos,nom_evento,fecha,hora_inicio,cupos,categoria.nom_Categoria,lugar.Sede
                               FROM eventos,categoria,lugar 
                               WHERE eventos.Id_Categoria = categoria.Id_Categoria AND eventos.Id_lugar = lugar.Id_lugar"); 

$pdf->Ln();
$pdf->SetFont('Arial', 'b', 10);

$pdf-> Ln();
    $pdf->Cell(55,8, "EVENTO",1,0,'C');
    $pdf->Cell(25,8, "FECHA",1,0,'C');
    $pdf->Cell(20,8, "HORA",1,0,'C');
    $pdf->Cell(15,8, "CUPOS",1,0,'C');
    $pdf->Cell(30,8, "CATEGORIA",1,0,'C');
    $pdf->Cell(60,8, "LUGAR",1,0,'C');
while($row = mysqli_fetch_array($result)){ 
    $pdf->Ln();
$pdf->SetFont('Arial', '', 9);

    $pdf->Cell(55,15,utf8_decode( $row['nom_evento']),1,0,'C');
    $pdf->Cell(25,15, utf8_decode($row['fecha']),1,0,'C');
    $pdf->Cell(20,15, utf8_decode($row['hora_inicio']),1,0,'C');
    $pdf->Cell(15,15,utf8_decode( $row['cupos']),1,0,'C');
    $pdf->Cell(30,15, utf8_decode($row['nom_Categoria']),1,0,'C');
    $pdf->Cell(60,15, utf8_decode($row['Sede']),1,0,'C');
 
 

  }  

  mysqli_close($conn);
$pdf->Output();

?>
