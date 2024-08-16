 <?php
    // Conectar a la base de datos
    include_once '../../conexion/conexion.php';

    // Consulta para obtener eventos
    $sql = "SELECT * FROM tipo_de_usuario";
    $result = $conn->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Generar opciones para el select
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['Id_tipo_de_usuario'] . "'>" . htmlspecialchars($row['tipo_de_usuario']) . "</option>";
        }
    } else {
        echo "<option value=''>No hay eventos disponibles</option>";
    }
    ?>