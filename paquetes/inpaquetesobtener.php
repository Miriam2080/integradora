<?php
include_once '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT *
            FROM paquetes 
            WHERE Id_paquete = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(array("data" => array($data)));
    } else {
        echo json_encode(array("error" => "Registro no encontrado"));
    }

    $stmt->close();
    $conn->close();
}
?>