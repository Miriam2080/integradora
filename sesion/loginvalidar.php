<?php
session_start();
include_once '../conexion/conexion.php';

// Validar los datos recibidos
if (!isset($_POST['correo'])) {
    echo json_encode(array('error' => 'El correo y la contraseña son datos obligatorios'));
    exit;
}

$username = $_POST['correo'];
print_r($username);
$password = $_POST['password'];

// Preparar la consulta para evitar inyecciones SQL
$sql = "SELECT * FROM usuario WHERE correo_electronico = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // if (password_verify($password, $user['password'])) {
        print_r($user);
        print_r("User password", $user['contra']);
        print_r("User password", $password );
        if ($password == $user['contra']) {
            print_r($_SESSION['correo'] = $username);
        // Agregar la variable de sesión y redirigir
        $_SESSION['correo'] = $username;
        header("Location: ../index.php");
        exit;
    } else {
        echo json_encode(array("error" => "Contraseña incorrecta"));

        header("Location: iniciar_sesion.php");
        exit;
    }
} else {
    echo json_encode(array("error" => "Usuario no encontrado"));
    header("Location: ../index.php");
    exit;
}
?>
