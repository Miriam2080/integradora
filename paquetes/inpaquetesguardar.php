<?php
include_once '../conexion/conexion.php';

if (!isset($_POST["id"]) || !isset($_POST["paquete"]) || !isset($_POST["evento"])) {
    echo '{ "error": "revisa los campos, es obligatorio"}';
    exit;
  }

$id_paquete = $_POST["id"];
$paquete = $_POST["paquete"];
$evento = $_POST["evento"];

$sql = "INSERT INTO paquetes (Id_tipo_de_paquetes, Id_eventos) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa

if ($stmt === false) {
    die(json_encode(array("error" => 'Error al preparar la consulta: ' . $conn->error)));
}

// Asignar los parámetros a la consulta
$stmt->bind_param('ss', $paquete, $evento);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    echo json_encode(array("success" => "Registro guardado correctamente"));
} else {
    echo json_encode(array("error" => "Error al guardar el registro: " . $stmt->error));
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
