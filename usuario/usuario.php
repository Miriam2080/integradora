<?php
include '../indexheader.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo de Usuarios</title>
    <link rel="icon" href="../img/logod.png" type="image/png">
    <link rel="stylesheet" href="../dist/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../estilo/estilos.css">
</head>

<body>
    <!-- Modal para Guaradar Nuevos Usuarios -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm" action="usuariosave.php" method="post">
                        <input type="hidden" id="Id_usuario" name="Id_usuario">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)"
                                title="No se permiten primeros los espacios ni numeros">
                            <div class="invalid-feedback">Por favor ingrese un Nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="ap_pat_usuario" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="ap_pat_usuario" name="ap_pat_usuario" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el primer Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="ap_mat_usuario" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control" id="ap_mat_usuario" name="ap_mat_usuario" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el segundo Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="numero_tel" class="form-label">Telefono:</label>
                            <!-- <input type="number" class="form-control" id="numero_tel" name="numero_tel" min="0" step="1" pattern="\d{10}" required> -->
                            <input type="text" class="form-control" id="numero_tel" name="numero_tel"
                                pattern="\d{10}"
                                title="El número de teléfono debe tener 10 dígitos y solo números."
                                placeholder="1234567890"
                                required>
                            <div class="invalid-feedback">
                                El número de teléfono debe tener 10 dígitos y solo números.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="codigo_postal" class="form-label">codigo_postal:</label>
                            <input type="number" class="form-control" id="codigo_postal" name="codigo_postal"
                                min="0" step="1"
                                placeholder="0"
                                required>
                            <div class="invalid-feedback">
                                El número debe ser mayor o igual a 0.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="correo_electronico" class="form-label">Correo Electronico:</label>
                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
                        </div>
                        <div class="mb-3">
                            <label for="contra" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="contra" name="contra" pattern=".{8,}"
                                title="La contraseña debe tener al menos 8 caracteres."
                                required>
                            <div class="invalid-feedback">Por favor ingrese una contraseña de 8 caracteres.</div>
                        </div>
                        <div class="mb-3">
                            <label for="Id_ciudad" class="form-label">Ciudad:</label>
                            <select class="form-control" id="Id_ciudad" name="Id_ciudad" required>
                                <option value="">Ciudades...</option>
                                <!-- Aqui se visualizara las opciones del input ciudad -->
                                <?php
                                include "../opciones/selectciudad.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Id_tipo_de_usuario" class="form-label">Tipo de Usuario:</label>
                            <select class="form-control" id="Id_tipo_de_usuario" name="Id_tipo_de_usuario" required>
                                <option value="">Usuarios...</option>
                                <!-- Aqui se visualizara las opciones del input tipo de usuario -->
                                <?php
                                include "../opciones/selectipodeusuario.php";
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
    <!-- Modal para Editar Usuarios -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="usuarioupdate.php" method="post">
                        <input type="hidden" id="Id_usuario" name="Id_usuario">
                        <div class="mb-3">
                            <label for="editnombre_usuario" class="form-label">Nuevo Nombre:</label>
                            <input type="text" class="form-control" id="editnombre_usuario" name="nombre_usuario" required required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)"
                                title="No se permiten primeros los espacios ni numeros">
                            <div class="invalid-feedback">Por favor ingrese un Nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editap_pat_usuario" class="form-label">Nuevo Apellido Paterno:</label>
                            <input type="text" class="form-control" id="editap_pat_usuario" name="ap_pat_usuario" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el primer Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editap_mat_usuario" class="form-label">Nuevo Apellido Materno:</label>
                            <input type="text" class="form-control" id="editap_mat_usuario" name="ap_mat_usuario" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten espacios al principio ni numeros">
                            <div class="invalid-feedback">Por favor ingrese el segundo Apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editnumero_tel" class="form-label">Nuevo Numero de Telefono:</label>
                            <input type="text" class="form-control" id="editnumero_tel" name="numero_tel"
                                pattern="\d{10}"
                                title="El número de teléfono debe tener 10 dígitos y solo números."
                                placeholder="1234567890"
                                required>
                            <div class="invalid-feedback">
                                El número de teléfono debe tener 10 dígitos y solo números.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editcodigo_postal" class="form-label">Nuevo Codigo Postal:</label>
                            <input type="number" class="form-control" id="editcodigo_postal" name="codigo_postal"
                                min="0" step="1"
                                placeholder="0"
                                required>
                            <div class="invalid-feedback">
                                El número debe ser mayor o igual a 0.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editcorreo_electronico" class="form-label">Nuevo Correo Electronico:</label>
                            <input type="text" class="form-control" id="editcorreo_electronico" name="correo_electronico">
                        </div>
                        <div class="mb-3">
                            <label for="editcontra" class="form-label">Nueva Contraseña:</label>
                            <input type="text" class="form-control" id="editcontra" name="contra">
                        </div>
                        <div class="mb-3">
                            <label for="editId_ciudad" class="form-label">Nueva Ciudad:</label>
                            <select class="form-control" id="editId_ciudad" name="Id_ciudad" required>
                                <option value="">Ciudades...</option>
                                <!-- Aqui se visualizara las opciones del input ciudad -->
                                <?php
                                include "../opciones/selectciudad.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editId_tipo_de_usuario" class="form-label">Nuevo Tipo de Usuario:</label>
                            <select class="form-control" id="editId_tipo_de_usuario" name="Id_tipo_de_usuario" required>
                                <option value="">Usuarios...</option>
                                <!-- Aqui se visualizara las opciones del input tipo de usuario -->
                                <?php
                                include "../opciones/selectipodeusuario.php";
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
                <div>
                    <center>
                        <h2>Table of Users</h2>
                    </center>
                </div>
                <div class="container mx-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Nuevo Usuario
                    </button>
                    <a href="../reportes/reporteusuario.php" class="btn btn-primary mx-3">Reporte</a>
                </div>

                <!-- Contenido de la tabla -->
                <div class="container mt-3">
                    <div class="table-responsive container col-lg-12">
                        <table class="table table-dark table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Telefono</th>
                                    <th>Codigo Postal</th>
                                    <th>Correo</th>
                                    <th>Contraseña</th>
                                    <th>Ciudad</th>
                                    <th>Tipo de Usuario</th>
                                    <th>Operaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aqui se visualiza los datos de la tabla -->
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