<?php
include_once "../conexion/conexion.php";


if ( !isset($_POST["nom_evento"]) || !isset($_POST["fecha"]) || !isset($_POST["hora_inicio"]) || !isset($_POST["cupos"]) || !isset($_POST["Id_Categoria"]) || !isset($_POST["Id_lugar"])) {
    echo '{"error": "Los campos son obligatorios"}';
    exit;
}
    
$nom_evento = $_POST["nom_evento"];
$fecha = $_POST["fecha"];
$hora_inicio = $_POST["hora_inicio"];
$cupos = $_POST["cupos"];
$Id_Categoria = $_POST["Id_Categoria"];
$Id_lugar = $_POST["Id_lugar"];

$sql = "INSERT INTO eventos (nom_evento,fecha,hora_inicio,cupos,Id_Categoria,Id_lugar)
VALUES ('$nom_evento','$fecha','$hora_inicio','$cupos','$Id_Categoria','$Id_lugar')";

if ($conn->query($sql) === TRUE) {
    echo '{"Success":"New record created successfully"}';
} else {
    echo '{ "error": "' . $sql . ' ' . $conn->error . '"}';
}

$conn->close();
// || !isset($_POST["cupos"]) 
// ,cupos

//Id_eventos, nom_evento, fecha, hora_inicio, cupos, Id_Categoria, Id_lugar,
?>