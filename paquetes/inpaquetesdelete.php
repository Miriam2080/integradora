<?php
include_once '../conexion/conexion.php';

if (!isset($_GET['id'])) {
    echo json_encode(array("error" => "El id es obligatorio"));
    exit;
}

$id = $_GET['id'];
$sql = "DELETE FROM paquetes WHERE Id_paquete = ?";

$stmt = $conn->prepare($sql); // Crear la sentencia preparada
$stmt->bind_param("i", $id);   // Vincular el parámetro a la sentencia preparada

if ($stmt->execute()) {        // Ejecutar la sentencia
    echo json_encode(array("Success" => "Registro borrado"));
} else {
    echo json_encode(array("error" => "Error al borrar el registro"));
}

$stmt->close();                // Cerrar la sentencia
$conn->close();                // Cerrar la conexión
?>
