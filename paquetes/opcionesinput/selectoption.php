<?php
// Conectar a la base de datos
include_once '../conexion/conexion.php';

// Consulta para obtener tipos de paquetes
$sql = "SELECT Id_tipo_de_paquetes, tipo_de_paquete FROM tipo_paquete";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Generar opciones para el select
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Id_tipo_de_paquetes'] . "'>" . htmlspecialchars($row['tipo_de_paquete']) . "</option>";
    }
} else {
    echo "<option value=''>No hay tipos de paquetes disponibles</option>";
}
?>