<?php
session_start();
if (!isset($_SESSION["correo"])) {
    header("location: ../sesion/iniciar_sesion.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Developer Web</title>
    <link rel="stylesheet" href="../dist/bootstrap.min.css">

</head>

<body>

    <header class="bg-dark text-light">
        <div class="container-fluid">
            <div class="row align-items-center py-2">
                <!-- Logo y botón de cerrar sesión -->
                <div class="col-7 col-md-3 col-lg-3">
                        <a href="../index.php">
                            <h1>Developer web</h1>
                            </a>
                    </div>

                <!-- Menú de navegación -->
                <div class="col-5 col-md-5 col-lg-9">
                    <nav class="navbar navbarNav navbar-expand-md navbar-dark bg-dark">
                        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="../eventos/evento.php">Eventos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../paquetes/inpaquetes.php">Paquetes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../responsable/responsable.php">Empleados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../usuario/usuario.php">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../reportes/indexreporte.php">Reporte PDF</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <nav class="navbar navbarNav navbar-expand-md navbar-dark bg-dark">
                                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#login">
                                    <span class="navar-togger text-white"><img src="../img/logod.png" alt="Logo" style="max-height: 40px;">
                                    </span>
                                </button>
                                <div class="collapse navbar-collapse-lg" id="login">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../sesion/logout.php">Cerrar Sesion</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </nav>
                </div>
            </div>
    </header>



    <script src="../dist/jquery.min.js"></script>
    <script src="../dist/bootstrap.bundle.min.js"></script>
</body>

</html>