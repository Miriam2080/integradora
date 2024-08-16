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

$pdf = new PDF('l', 'mm','Letter');
$pdf->setMargins(5,18);
$pdf->AliasNbPages();
$pdf->AddPage();

//TITULO este es el titulo del documento pdf que aparecera en la cabecera
$pdf->SetTextColor(0x00,0x00,0x00);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(0,5,'DEVELOPER WEB',0,1,'C');
$pdf->Cell(0,5,'COLABORADORES REGISTRADOS ',0,1,'C');


  $pdf->Ln();

  
 
  $pdf->Ln();
  
  //1 indica borde, 0 no hace salto de linea, c es centrado
  // la consulta sql aqui pongan sus consultas dolo remplacen ahi 

$result = mysqli_query($conn, "SELECT r.Id_responsable_evento, r.nombre_responsable, r.ap_pat_responsable, r.ap_mat_responsable, r.facebook, 
r.youtube, r.tiktok, r.telefono, r.correo, c.nom_ciudad, t.tipo_responsable, e.especialidad_experiencia 
FROM ((responsable_eventos r LEFT JOIN tipo_de_responsable t ON r.Id_tipo_responsable=t.Id_tipo_responsable) 
LEFT JOIN ciudad c ON r.Id_ciudad=c.Id_ciudad)LEFT JOIN especialidad e ON r.Id_especialidad=e.Id_especialidad");

 // este es un salto de linea  
$pdf->Ln();
// este es el tipo de letra 
$pdf->SetFont('Arial', 'b', 10);

$pdf-> Ln();
// la tabla en general 

    //aqui agregue las cabeceras de las tablas aquui simplemente coocan como se mostrara en la cabecera de  la tabla
    // si ustedes tienen mas campos solo copeen esto $pdf->Cell(20,5, "ID",1,0,'C'); y en vez del campo id le ponen lo que se mostrara
    // igual si agregan una fila mas aqui recuerden que en la tabla desde db tambien
    $pdf->Cell(8,15, "ID",1,0,'C');
    $pdf->Cell(30,15, "NOMBRE",1,0,'C');
    $pdf->Cell(30,15, "APELLIDO PATERNO",1,0,'C');
    $pdf->Cell(30,15, "APELLIDO MATERNO",1,0,'C');
    $pdf->Cell(30,15, "TELEFONO",1,0,'C');
    $pdf->Cell(30,15, "TELÉFONO",1,0,'C');
    $pdf->Cell(30,15, "CORREO ELECTRONICO",1,0,'C');
    $pdf->Cell(30,15, "PUESTO",1,0,'C');
    $pdf->Cell(30,15, "TÍTULO",1,0,'C');
while($row = mysqli_fetch_array($result)){ 
    $pdf->Ln();
$pdf->SetFont('Arial', '', 10);

    // tabla db
    // aqui agreguen sus campos como estan en la db por ejemplo aqui Id_tipo_de_paquetes ese es mi campo desde la db
    $pdf->Cell(8,10, utf8_decode($row['Id_responsable_evento']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['nombre_responsable']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['ap_pat_responsable']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['ap_mat_responsable']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['telefono']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['correo']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['nom_ciudad']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['tipo_responsable']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['especialidad_experiencia']),1,0,'C');
 
 

  }  

  mysqli_close($conn);
$pdf->Output();
