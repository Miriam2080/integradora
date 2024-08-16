<?php
include '../indexheader.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo de Responsable</title>
    <link rel="icon" href="../img/logod.png" type="image/png">
    <link rel="stylesheet" href="../dist/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../estilo/estilos.css">
</head>

<body>
    <!-- modal de agregar -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm" action="responsablesave.php" method="post">
                        <input type="hidden" id="Id_responsable_evento" name="Id_responsable_evento">
                        <div class="mb-3">
                            <label for="nombre_responsable" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_responsable" name="nombre_responsable"
                                required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten primeros los espacios ni numeros">
                            <div class="invalid-feedback">Por favor ingrese un Nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="ap_pat_responsable" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="ap_pat_responsable" name="ap_pat_responsable" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el primer Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="ap_mat_responsable" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control" id="ap_mat_responsable" name="ap_mat_responsable" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el segundo Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook:</label>
                            <input type="text" class="form-control" id="facebook" name="facebook">
                        </div>
                        <div class="mb-3">
                            <label for="youtube" class="form-label">Youtube:</label>
                            <input type="text" class="form-control" id="youtube" name="youtube">
                        </div>
                        <div class="mb-3">
                            <label for="tiktok" class="form-label">Tiktok:</label>
                            <input type="text" class="form-control" id="tiktok" name="tiktok">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                pattern="\d{10}"
                                title="El número de teléfono debe tener 10 dígitos y solo números."
                                placeholder="1234567890"
                                required>
                            <div class="invalid-feedback">
                                El número de teléfono debe tener 10 dígitos y solo números.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electronico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="Id_ciudad" class="form-label">Ciudad:</label>
                            <select class="form-control" id="Id_ciudad" name="Id_ciudad" required>
                                <option value="">Ciudades...</option>
                                <!-- Aqui se visualizara las opciones del input ciudad-->
                                <?php
                                include "../opcionesinput/selectciudad.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Id_tipo_responsable" class="form-label">Puesto:</label>
                            <select class="form-control" id="Id_tipo_responsable" name="Id_tipo_responsable" required>
                                <option value="">Puestos...</option>
                                <!-- Aqui se visualizara las opciones del input puesto-->
                                <?php
                                include "../opcionesinput/selectpuesto.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Id_especialidad" class="form-label">Título:</label>
                            <select class="form-control" id="Id_especialidad" name="Id_especialidad" required>
                                <option value="">Títulos...</option>
                                <!-- Aqui se visualizara las opciones del input titulo -->
                                <?php
                                include "../opcionesinput/selecttitulo.php";
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="fnGuardar()">Guardar Nuevo</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para editar empleados -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="responsableupdate.php" method="post">
                        <input type="hidden" id="editId_responsable_evento" name="editId_responsable_evento">
                        <div class="mb-3">
                            <label for="editnombre_responsable" class="form-label">Nuevo Nombre:</label>
                            <input type="text" class="form-control" id="editnombre_responsable" name="editnombre_responsable"
                                required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten primeros los espacios ni numeros">
                            <div class="invalid-feedback">Por favor ingrese un Nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editap_pat_responsable" class="form-label">Nuevo Apellido Paterno:</label>
                            <input type="text" class="form-control" id="editap_pat_responsable" name="editap_pat_responsable" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el primer Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editap_mat_responsable" class="form-label">Nuevo Apellido Materno:</label>
                            <input type="text" class="form-control" id="editap_mat_responsable" name="editap_mat_responsable" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el segundo Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editfacebook" class="form-label">Nuevo Facebook:</label>
                            <input type="text" class="form-control" id="editfacebook" name="editfacebook">
                        </div>
                        <div class="mb-3">
                            <label for="edityoutube" class="form-label">Nuevo Canal de Youtube:</label>
                            <input type="text" class="form-control" id="edityoutube" name="edityoutube">
                        </div>
                        <div class="mb-3">
                            <label for="edittiktok" class="form-label">Tiktok:</label>
                            <input type="text" class="form-control" id="edittiktok" name="edittiktok">
                        </div>
                        <div class="mb-3">
                            <label for="edittelefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="edittelefono" name="edittelefono" pattern="\d{10}"
                                title="El número de teléfono debe tener 10 dígitos y solo números."
                                placeholder="1234567890"
                                required>
                            <div class="invalid-feedback">
                                El número de teléfono debe tener 10 dígitos y solo números.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editcorreo" class="form-label">Correo Electronico:</label>
                            <input type="email" class="form-control" id="editcorreo" name="editcorreo" required>
                        </div>
                        <div class="mb-3">
                            <label for="editId_ciudad" class="form-label">Ciudad:</label>
                            <select class="form-control" id="editId_ciudad" name="editId_ciudad" required>
                                <option value="">Ciudades...</option>
                                <!-- Aqui se visualizara las opciones del input ciudad-->
                                <?php
                                include "../opcionesinput/selectciudad.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editId_tipo_responsable" class="form-label">Puesto:</label>
                            <select class="form-control" id="editId_tipo_responsable" name="editId_tipo_responsable" required>
                                <option value="">Puestos...</option>
                                <!-- Aqui se visualizara las opciones del input puesto-->
                                <?php
                                include "../opcionesinput/selectpuesto.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editId_especialidad" class="form-label">Título:</label>
                            <select class="form-control" id="editId_especialidad" name="editId_especialidad" required>
                                <option value="">Títulos...</option>
                                <!-- Aqui se visualizara las opciones del input titulo-->
                                <?php
                                include "../opcionesinput/selecttitulo.php";
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="fnGuardarEdicion()">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Contenido de la tabla -->
    <div class="container">
        <div class="row">
            <div class="container col-6 col-lg-12">
                <center>
                    <h2>Table of Workers</h2>
                </center>
            </div>
            <div class="container mx-3">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
                    Nuevo Usuario
                </button>
            </div>

            <!-- Contenido de la tabla -->
            <div class="container">
                <div class="table-responsive container col-lg-12">
                    <table class="table table-dark table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Facebook</th>
                                <th>Youtube</th>
                                <th>Tiktok</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Ciudad</th>
                                <th>Puesto</th>
                                <th>Especialidad</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include_once "tbody.php"; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script src="../dist/jquery.min.js"></script>
    <script src="../dist/bootstrap.bundle.min.js"></script>
    <script src="scrips.js"></script>
    <script src="../dist/sweetalert2@11.js"></script>
</body>

</html>