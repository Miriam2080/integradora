<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("location: sesion/iniciar_sesion.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Developer Web</title>
    <link rel="icon" href="img/logod.png" type="image/png">
    <link rel="stylesheet" href="dist/bootstrap.min.css">
    <link rel="stylesheet" href="estilo/estilos.css">
</head>

<body>
    <div class="container-fluid ">
        <div class="row">
            <nav class="navbar navbar-expand-sm col-12 navbar-dark bg-dark p-2 text-light">
                <div class="container">
                    <h1>Developer Web</h1>
                </div>
                <div>
                    <a class="navbar-brand" href="sesion/logout.php">
                        <img src="img/logod.png" alt="Logo" style="width:50px;" class="rounded-pill" title="Cerrar sesion">
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Contenido Principal -->
    <main class="container my-5 py-5">
        <div class="text-center bg-dark text-light">
            <div class="container">
                <h1 class="display-4">Bienvenido a Developer Web</h1>
                <p class="lead">Aquí encontrarás todas las herramientas y recursos para tus proyectos web.</p>
                <a class="btn btn-primary btn-lg" href="eventos/evento.php" type="button">Comenzar</a>
                <div>
                    <p></p>
                </div>
            </div>
        </div>
    </main>

    <script src="../dist/jquery.min.js"></script>
    <script src="../dist/bootstrap.bundle.min.js"></script>
</body>

</html>