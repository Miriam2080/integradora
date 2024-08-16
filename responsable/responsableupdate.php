<?php
include_once "../conexion/conexion.php";

$requiredFields = ["editId_responsable_evento", "editnombre_responsable", "editap_pat_responsable", "editap_mat_responsable","editfacebook","edityoutube",
"edittiktok","edittelefono","editcorreo","editId_ciudad","editId_tipo_responsable","editId_especialidad"];

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field])) {
        echo '{"error": "Revisa tus datos"}';
        exit;
    }
}

$Id_responsable_evento = $_POST["editId_responsable_evento"];
$nombre_responsable = $_POST["editnombre_responsable"];
$ap_pat_responsable = $_POST["editap_pat_responsable"];
$ap_mat_responsable = $_POST["editap_mat_responsable"];
$facebook = $_POST["editfacebook"];
$youtube = $_POST["edityoutube"];
$tiktok = $_POST["edittiktok"];
$telefono = $_POST["edittelefono"];
$correo = $_POST["editcorreo"];
$Id_ciudad = $_POST["editId_ciudad"];
$Id_tipo_responsable = $_POST["editId_tipo_responsable"];
$Id_especialidad = $_POST["editId_especialidad"];

if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}
$sql = "UPDATE responsable_eventos SET nombre_responsable = ?, ap_pat_responsable = ?, ap_mat_responsable = ?, facebook = ?, youtube = ?,
 tiktok = ?, telefono = ?, correo = ?, Id_ciudad = ?, Id_tipo_responsable = ?, Id_especialidad = ? WHERE Id_responsable_evento = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die(json_encode(array("error" => 'Error al preparar la consulta: ' . $conn->error)));
}

$stmt->bind_param('ssssssssiiii', $nombre_responsable, $ap_pat_responsable, $ap_mat_responsable, $facebook, $youtube,
 $tiktok, $telefono, $correo, $Id_ciudad, $Id_tipo_responsable, $Id_especialidad, $Id_responsable_evento);

if ($stmt->execute()) {
    echo json_encode(array("success" => "Producto modificado correctamente"));
} else {
    echo json_encode(array("error" => "Error al actualizar el producto: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
