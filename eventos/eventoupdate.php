<?php
include_once "../conexion/conexion.php";

$requiredFields = ["Id_eventos", "nom_evento", "fecha", "hora_inicio","cupos","Id_Categoria","Id_lugar"];

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field])) {
        echo '{"error": "Revisa tus datos"}';
        exit;
    }
}
//Id_eventos, nom_evento, fecha, hora_inicio, cupos, Id_Categoria, Id_lugar,

$Id_eventos = $_POST["Id_eventos"];
$nom_evento = $_POST["nom_evento"];
$fecha = $_POST["fecha"];
$hora_inicio = $_POST["hora_inicio"];
$cupos = $_POST["cupos"];
$Id_Categoria = $_POST["Id_Categoria"];
$Id_lugar = $_POST["Id_lugar"];
if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}
$sql = "UPDATE eventos SET nom_evento = ?, fecha = ?, hora_inicio = ?, cupos = ?, Id_Categoria = ?, Id_lugar = ? WHERE Id_eventos = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die(json_encode(array("error" => 'Error al preparar la consulta: ' . $conn->error)));
}

$stmt->bind_param('sssiiii', $nom_evento, $fecha, $hora_inicio, $cupos, $Id_Categoria, $Id_lugar, $Id_eventos);

if ($stmt->execute()) {
    echo json_encode(array("success" => "Producto modificado correctamente"));
} else {
    echo json_encode(array("error" => "Error al actualizar el producto: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>

