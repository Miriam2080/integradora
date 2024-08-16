<?php
include_once "../conexion/conexion.php";


if (!isset($_GET["Id_responsable"])) {
    echo '{"error": "el nombre es obligatorio"}';
    exit;
}
$Id_responsable = $_GET["Id_responsable"];

if ($conn->connect_error) {
    die("Connection failed: " . $$conn->connect_error);
}

$sql = "SELECT Id_responsable_evento,nombre_responsable,ap_pat_responsable,ap_mat_responsable,facebook,youtube,tiktok,telefono,correo,Id_ciudad,Id_tipo_responsable,Id_especialidad FROM responsable_eventos WHERE Id_responsable_evento = $Id_responsable";
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