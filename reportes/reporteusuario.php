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
$pdf->AliasNbPages();
$pdf->AddPage();

//TITULO este es el titulo del documento pdf que aparecera en la cabecera
$pdf->SetTextColor(0x00,0x00,0x00);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(0,5,'DEVELOPER WEB',0,1,'C');
$pdf->Cell(0,5,'PAQUETES REGISTRADOS ',0,1,'C');


  $pdf->Ln();

  
 
  $pdf->Ln();
  
  //1 indica borde, 0 no hace salto de linea, c es centrado
  // la consulta sql aqui pongan sus consultas dolo remplacen ahi 

$result = mysqli_query($conn, "SELECT usuario.Id_usuario,nombre_usuario,ap_pat_usuario,ap_mat_usuario,numero_tel,ciudad.nom_ciudad,tipo_de_usuario.tipo_de_usuario
FROM usuario,ciudad,tipo_de_usuario 
WHERE usuario.Id_ciudad = ciudad.Id_ciudad and usuario.Id_tipo_de_usuario = tipo_de_usuario.Id_tipo_de_usuario" );

 // este es un salto de linea  
$pdf->Ln();
// este es el tipo de letra 
$pdf->SetFont('Arial', 'b', 10);

$pdf-> Ln();
// la tabla en general 

    //aqui agregue las cabeceras de las tablas aquui simplemente coocan como se mostrara en la cabecera de  la tabla
    // si ustedes tienen mas campos solo copeen esto $pdf->Cell(20,5, "ID",1,0,'C'); y en vez del campo id le ponen lo que se mostrara
    // igual si agregan una fila mas aqui recuerden que en la tabla desde db tambien
    $pdf->Cell(8,8, "ID",1,0,'C');
    $pdf->Cell(40,8, "NOMBRE",1,0,'C');
    $pdf->Cell(30,8, "AP_PATERNO",1,0,'C');
    $pdf->Cell(30,8, "AP_MATERNO",1,0,'C');
    $pdf->Cell(28,8, "TELEFONO",1,0,'C');
    $pdf->Cell(31,8, "CIUDAD",1,0,'C');
    $pdf->Cell(40,8, "TIPO",1,0,'C');
while($row = mysqli_fetch_array($result)){ 
    $pdf->Ln();
$pdf->SetFont('Arial', '', 10);

    // tabla db
    // aqui agreguen sus campos como estan en la db por ejemplo aqui Id_tipo_de_paquetes ese es mi campo desde la db
    $pdf->Cell(8,10, utf8_decode($row['Id_usuario']),1,0,'C');
    $pdf->Cell(40,10, utf8_decode($row['nombre_usuario']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['ap_pat_usuario']),1,0,'C');
    $pdf->Cell(30,10, utf8_decode($row['ap_mat_usuario']),1,0,'C');
    $pdf->Cell(28,10, utf8_decode($row['numero_tel']),1,0,'C');
    $pdf->Cell(31,10, utf8_decode($row['nom_ciudad']),1,0,'C');
    $pdf->Cell(40,10, utf8_decode($row['tipo_de_usuario']),1,0,'C');
 
 

  }  

  mysqli_close($conn);
$pdf->Output();

