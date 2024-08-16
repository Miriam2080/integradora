<?php
include_once "../conexion/conexion.php";


if (!isset($_GET["Id_eventos"])) {
    echo '{"error": "el nombre es obligatorio"}';
    exit;
}
$Id_eventos = $_GET["Id_eventos"];

if ($conn->connect_error) {
    die("Connection failed: " . $$conn->connect_error);
}

$sql = "SELECT Id_eventos, nom_evento, fecha, hora_inicio, cupos, Id_Categoria, Id_lugar FROM eventos WHERE Id_eventos = $Id_eventos";
$result = $conn->query($sql);
$registros = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $registros[] = $row;
    }
    print_r(json_encode(array("data" => $registros)));
} else {
    echo '{"error": "el Id_eventos no existe"}';
}

$conn->close();
?>