<?php
include_once "../conexion/conexion.php";


if (!isset($_POST["nombre_responsable"]) || !isset($_POST["ap_pat_responsable"]) || !isset($_POST["ap_mat_responsable"]) || !isset($_POST["facebook"]) || !isset($_POST["youtube"]) || !isset($_POST["tiktok"]) || !isset($_POST["telefono"]) || !isset($_POST["correo"]) || !isset($_POST["Id_ciudad"]) || !isset($_POST["Id_tipo_responsable"]) || !isset($_POST["Id_especialidad"])) {
    echo '{"error": "Los campos son obligatorios"}';
    exit;
}

$nombre_responsable = $_POST["nombre_responsable"];
$ap_pat_responsable = $_POST["ap_pat_responsable"];
$ap_mat_responsable = $_POST["ap_mat_responsable"];
$facebook = $_POST["facebook"];
$youtube = $_POST["youtube"];
$tiktok = $_POST["tiktok"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$Id_ciudad = $_POST["Id_ciudad"];
$Id_tipo_responsable = $_POST["Id_tipo_responsable"];
$Id_especialidad = $_POST["Id_especialidad"];

$sql = "INSERT INTO responsable_eventos (nombre_responsable,ap_pat_responsable,ap_mat_responsable,facebook,youtube,
tiktok,telefono,correo,Id_ciudad,Id_tipo_responsable,Id_especialidad)
VALUES ('$nombre_responsable','$ap_pat_responsable','$ap_mat_responsable','$facebook','$youtube',
'$tiktok','$telefono','$correo','$Id_ciudad','$Id_tipo_responsable','$Id_especialidad')";

if ($conn->query($sql) === TRUE) {
    echo '{"Success":"New record created successfully"}';
} else {
    echo '{ "error": "' . $sql . ' ' . $conn->error . '"}';
}

$conn->close();
