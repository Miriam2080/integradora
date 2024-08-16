<?php
    include '../indexheader.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación de Reportes - Workshop</title>
    <link rel="stylesheet" href="../dist/bootstrap.min.css">
    <link rel="stylesheet" href="../estilo/estilos.css">

</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-5">Generación de Reportes</h2>
        <div class="row">
            <!-- Reporte de Ventas Totales -->
            <div class="col-md-6">
                <div class="card report-card shadow">
                    <div class="card-header bg-primary text-white text-center">Reporte de Eventos</div>
                    <div class="card-body text-center">
                        <p class="card-text">Genera un reporte con el total de registro de eventos.</p>
                        <form action="reporteevento.php" method="POST">
                            <button type="submit" class="btn btn-primary btn-block">Generar Reporte</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Reporte de Ventas por Paquete -->
            <div class="col-md-6">
                <div class="card report-card shadow">
                    <div class="card-header bg-success text-white text-center">Reporte de Paquetes</div>
                    <div class="card-body text-center">
                        <p class="card-text">Genera un reporte detallado de ventas por cada tipo de paquete.</p>
                        <form action="reportepaquetes.php" method="POST">
                            <button type="submit" class="btn btn-success btn-block">Generar Reporte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Reporte de usuarios -->
            <div class="col-md-6">
                <div class="card report-card shadow">
                    <div class="card-header bg-info text-white text-center">Reporte de usuarios</div>
                    <div class="card-body text-center">
                        <p class="card-text">Genera un reporte con la lista total de usuarios.</p>
                        <form action="reporteusuario.php" method="POST">
                            <button type="submit" class="btn btn-info btn-block">Generar Reporte</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Reporte de Ingresos Generados -->
            <div class="col-md-6">
                <div class="card report-card shadow">
                    <div class="card-header bg-warning text-white text-center">Reporte de empleados</div>
                    <div class="card-body text-center">
                        <p class="card-text">Genera un reporte del total de de empleados registrados.</p>
                        <form action="reporteresponnsable.php" method="POST">
                            <button type="submit" class="btn btn-warning btn-block">Generar Reporte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dist/jquery.min.js"></script>
    <script src="../dist/bootstrap.bundle.min.js"></script>
</body>
</html>
