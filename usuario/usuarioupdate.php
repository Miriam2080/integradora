<?php
include_once "../conexion/conexion.php";

$requiredFields = ["Id_usuario", "nombre_usuario", "ap_pat_usuario", "ap_mat_usuario","numero_tel","codigo_postal","correo_electronico","contra","Id_ciudad","Id_tipo_de_usuario"];

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field])) {
        echo '{"error": "Revisa tus datos"}';
        exit;
    }
}

$Id_usuario = $_POST["Id_usuario"];
$nombre_usuario = $_POST["nombre_usuario"];
$ap_pat_usuario = $_POST["ap_pat_usuario"];
$ap_mat_usuario = $_POST["ap_mat_usuario"];
$numero_tel = $_POST["numero_tel"];
$codigo_postal = $_POST["codigo_postal"];
$correo_electronico = $_POST["correo_electronico"];
$contra = $_POST["contra"];
$Id_ciudad = $_POST["Id_ciudad"];
$Id_tipo_de_usuario = $_POST["Id_tipo_de_usuario"];

if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}
$sql = "UPDATE usuario SET nombre_usuario = ?, ap_pat_usuario = ?, ap_mat_usuario = ?, numero_tel = ?, codigo_postal = ?, correo_electronico = ?, contra = ?, Id_ciudad = ?, Id_tipo_de_usuario = ? WHERE Id_usuario = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die(json_encode(array("error" => 'Error al preparar la consulta: ' . $conn->error)));
}

$stmt->bind_param('ssssissiii', $nombre_usuario, $ap_pat_usuario, $ap_mat_usuario, $numero_tel, $codigo_postal, $correo_electronico, $contra, $Id_ciudad, $Id_tipo_de_usuario, $Id_usuario);

if ($stmt->execute()) {
    echo json_encode(array("success" => "Producto modificado correctamente"));
} else {
    echo json_encode(array("error" => "Error al actualizar el producto: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
