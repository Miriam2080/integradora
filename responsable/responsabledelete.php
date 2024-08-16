<?php
include_once "../conexion/conexion.php";

// Verifica si se proporcionó el parámetro id_empleado
if (!isset($_GET["Id_responsable"])) {
  echo '{"error": "El parámetro id_responsable es obligatorio"}';
  exit;
}

// Obtiene y valida el id_empleado
$Id_responsable = intval($_GET["Id_responsable"]); // Convierte a entero seguro

// Prepara la consulta SQL utilizando una consulta preparada
$sql = "DELETE FROM responsable_eventos WHERE Id_responsable_evento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Id_responsable); // "i" indica que el parámetro es un entero

// Ejecuta la consulta
if ($stmt->execute()) {
  echo '{"Success": "Registro borrado"}';
} else {
  echo '{"error": "Error al intentar borrar el registro"}';
}

$stmt->close();
$conn->close();
?>