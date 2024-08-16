<?php
// Conectar a la base de datos
include_once '../conexion/conexion.php';

// Consulta para obtener tipos de paquetes
$sql = "SELECT * FROM categoria";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Generar opciones para el select
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Id_Categoria'] . "'>" . htmlspecialchars($row['nom_Categoria']) . "</option>";
    }
} else {
    echo "<option value=''>No hay eventos disponibles</option>";
}
?>