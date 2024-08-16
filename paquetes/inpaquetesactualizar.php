<?php
include_once '../conexion/conexion.php';

// Verificar si todos los datos necesarios están presentes
if (!isset($_POST["id"]) || !isset($_POST["paquete"]) || !isset($_POST["evento"])) {
    echo json_encode(array("error" => "Revisa tus datos"));
    exit;
}

// Asignar las variables desde el formulario
$id = $_POST["id"];
$id_tipo_de_paquete = $_POST["paquete"];
$id_evento = $_POST["evento"];


// Preparar la consulta SQL para actualizar
$sql = "UPDATE paquetes SET Id_tipo_de_paquetes = ?, Id_eventos = ? WHERE Id_paquete = ?";
$stmt = $conn->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die(json_encode(array("error" => 'Error al preparar la consulta: ' . $conn->error)));
}

// Asignar los parámetros a la consulta
$stmt->bind_param('iii', $id_tipo_de_paquete, $id_evento, $id);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    echo json_encode(array("success" => "Registro actualizado correctamente"));
} else {
    echo json_encode(array("error" => "Error al actualizar el registro: " . $stmt->error));
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
