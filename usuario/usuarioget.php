<?php
include_once "../conexion/conexion.php";


if (!isset($_GET["Id_usuario"])) {
    echo '{"error": "el nombre es obligatorio"}';
    exit;
}
$Id_usuario = $_GET["Id_usuario"];

if ($conn->connect_error) {
    die("Connection failed: " . $$conn->connect_error);
}

$sql = "SELECT Id_usuario,nombre_usuario,ap_pat_usuario,ap_mat_usuario,numero_tel,codigo_postal,correo_electronico,contra,Id_ciudad,Id_tipo_de_usuario FROM usuario WHERE Id_usuario = $Id_usuario";
$result = $conn->query($sql);
$registros = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $registros[] = $row;
    }
    print_r(json_encode(array("data" => $registros)));
} else {
    echo '{"error": "el Id_usuario no existe"}';
}

$conn->close();
?>