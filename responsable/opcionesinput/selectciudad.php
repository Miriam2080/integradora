 <?php
    // Conectar a la base de datos
    include_once '../../conexion/conexion.php';

    // Consulta para obtener eventos
    $sql = "SELECT Id_ciudad, nom_ciudad FROM ciudad";
    $result = $conn->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Generar opciones para el select
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['Id_ciudad'] . "'>" . htmlspecialchars($row['nom_ciudad']) . "</option>";
        }
    } else {
        echo "<option value=''>No hay eventos disponibles</option>";
    }
    ?>