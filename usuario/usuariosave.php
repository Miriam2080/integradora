<?php
include_once "../conexion/conexion.php";


if (!isset($_POST["nombre_usuario"]) || !isset($_POST["ap_pat_usuario"]) || !isset($_POST["ap_mat_usuario"]) || !isset($_POST["numero_tel"]) || !isset($_POST["codigo_postal"]) || !isset($_POST["correo_electronico"]) || !isset($_POST["contra"]) || !isset($_POST["Id_ciudad"]) || !isset($_POST["Id_tipo_de_usuario"])) {
    echo '{"error": "Los campos son obligatorios"}';
    exit;
}

$nombre_usuario = $_POST["nombre_usuario"];
$ap_pat_usuario = $_POST["ap_pat_usuario"];
$ap_mat_usuario = $_POST["ap_mat_usuario"];
$numero_tel = $_POST["numero_tel"];
$codigo_postal = $_POST["codigo_postal"];
$correo_electronico = $_POST["correo_electronico"];
$contra = $_POST["contra"];
$Id_ciudad = $_POST["Id_ciudad"];
$Id_tipo_de_usuario = $_POST["Id_tipo_de_usuario"];

$sql = "INSERT INTO usuario (nombre_usuario,ap_pat_usuario,ap_mat_usuario,numero_tel,codigo_postal,correo_electronico,contra,Id_ciudad,Id_tipo_de_usuario)
VALUES ('$nombre_usuario','$ap_pat_usuario','$ap_mat_usuario','$numero_tel','$codigo_postal','$correo_electronico','$contra','$Id_ciudad','$Id_tipo_de_usuario')";

if ($conn->query($sql) === TRUE) {
    echo '{"Success":"New record created successfully"}';
} else {
    echo '{ "error": "' . $sql . ' ' . $conn->error . '"}';
}

$conn->close();
