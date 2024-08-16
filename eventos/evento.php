<?php
include '../indexheader.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo De Eventos</title>
    <link rel="stylesheet" href="../dist/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../estilo/estilos.css">
</head>

<body>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm" action="eventosave.php" method="post">
                        <input type="hidden" id="Id_eventos" name="Id_eventos">
                        <div class="mb-3">
                            <label for="nom_evento" class="form-label">Nuevo evento:</label>
                            <input type="text" class="form-control" id="nom_evento" name="nom_evento" required required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="No se permiten primeros los espacios ni numeros">
                            <div class="invalid-feedback">Por favor ingrese un Nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora De Inicio:</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="cupos" class="form-label">CUPOS:</label>
                            <input type="number" class="form-control" id="cupos" name="cupos" min="0" step="1" required>

                        </div>
                        <div class="mb-3">
                            <label for="Id_Categoria" class="form-label">Categoria:</label>
                            <select type="text" class="form-control" id="editId_Categoria" name="Id_Categoria">
                                <option value="">SELECCIONA UNA CATEGORIA</option>
                                <?php
                                include "selects/opctioncategoria.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Id_lugar" class="form-label">lugar:</label>
                            <select type="text" class="form-control" id="Id_lugar" name="Id_lugar">
                                <option value="">SELECCIONA UN LUGAR</option>
                                <?php
                                include "selects/lugar.php";
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


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="eventoupdate.php" method="post">
                        <input type="hidden" id="Id_eventos" name="Id_eventos">
                        <div class="mb-3">
                            <label for="editnom_evento" class="form-label">INGRESE EL EVENTO:</label>
                            <input type="text" class="form-control" id="editnom_evento" name="nom_evento" required pattern="[A-Za-zÀ-ÿ]+([ ]?[A-Za-zÀ-ÿ]+)" title="Solo se permiten letras y espacios">
                        </div>
                        <div class="mb-3">
                            <label for="editfecha" class="form-label"> NUEVA FECHA:</label>
                            <input type="date" class="form-control" id="editfecha" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="edithora_inicio" class="form-label">NUEVA HORA:</label>
                            <input type="time" class="form-control" id="edithora_inicio" name="hora_inicio">
                        </div>
                        <div class="mb-3">
                            <label for="cupos" class="form-label"> CUPOS :</label>
                            <input type="number" class="form-control" id="cupos" name="cupos" min="0" step="1">
                        </div>
                        <div class="mb-3">
                            <label for="Id_Categoria" class="form-label">Categoria:</label>
                            <select type="text" class="form-control" id="editId_Categoria" name="Id_Categoria">
                                <option value="">SELECCIONA UNA CATEGORIA</option>
                                <?php
                                include "selects/opctioncategoria.php";
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Id_lugar" class="form-label">lugar:</label>
                            <select type="text" class="form-control" id="Id_lugar" name="Id_lugar">
                                <option value="">SELECCIONA UN LUGAR</option>
                                <?php
                                include "selects/lugar.php";
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




    <div class="container mt-5">
        <div class="container text-center">
            <h2>Table of EVENTS</h2>
        </div>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
            Nuevo Evento
        </button>
        <a href="../reportes/reporteevento.php" type="button" class="btn btn-primary mb-3">
            REPORTE
        </a>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nombre del evento</th>
                        <th>fecha</th>
                        <th>hora de inicio</th>
                        <th>cupos</th>
                        <th>categorias</th>
                        <th>lugares</th>
                        <th>operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "../conexion/conexion.php";

                    $sql = "SELECT e.Id_eventos as ID, e.nom_evento AS EVENTO, e.fecha AS FECHA, e.hora_inicio AS HORA, e.cupos AS CUPOS, c.nom_Categoria AS CATEGORIA, l.Sede AS SEDE 
                            FROM (eventos e inner join categoria c on e.Id_Categoria=c.Id_categoria) inner join lugar l on l.Id_lugar=e.Id_lugar";
                    $productos = $conn->query($sql);
                    if ($productos->num_rows > 0) {
                        while ($row = $productos->fetch_assoc()) {
                            echo "
            <tr>
              <td>{$row["ID"]}</td>
              <td>{$row["EVENTO"]}</td>
              <td>{$row["FECHA"]}</td>
              <td>{$row["HORA"]}</td>
              <td>{$row["CUPOS"]}</td>
              <td>{$row["CATEGORIA"]}</td>
              <td>{$row["SEDE"]}</td>
              <td>
                <button type='button' class='btn btn-light' onclick='fnmodi({$row["ID"]})'>Editar</button>
                <button type='button' class='btn btn-danger' onclick='fnEliminar({$row["ID"]})'>Borrar</button>
              </td>
            </tr>
            ";
                        }
                    } else {
                        echo "<tr><td colspan='10'> 0 eventos </td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="../dist/jquery.min.js"></script>
    <script src="../dist/bootstrap.bundle.min.js"></script>
    <script src="../dist/sweetalert2@11.js"></script>
    <script>
        function isFormValid(formName) {
            $('#' + formName).addClass('was-validated');
            if (!$('#' + formName)[0].checkValidity()) {
                $('#' + formName + ' .invalid-feedback').each(function() {
                    if ($(this)[0].offsetParent) {
                        return false;
                    }
                });
                return false;
            }
            return true;
        }

        function fnGuardar() {
            var formData = new FormData(document.getElementById('myForm'));
            if (!isFormValid('myForm')) {
                return;
            }
            console.log('Enviando a guardar..');
            $.ajax({
                url: 'eventosave.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    try {
                        var jsonResponse = JSON.parse(result);
                        if (jsonResponse.Success) {
                            Swal.fire({
                                title: "¡Éxito!",
                                ttext: 'El registro se realizo correctamente!!',
                                icon: "success"
                            }).then(() => {
                                location.reload(); // Recargar la página para reflejar los cambios
                            });
                        }
                        if (jsonResponse.error) {
                            Swal.fire({
                                title: "Error",
                                text: jsonResponse.error,
                                icon: "error"
                            });
                        }
                    } catch (e) {
                        console.error('No se pudo analizar JSON:', e);
                        console.log('Respuesta:', response);
                    }
                },
                error: function(xhr) {
                    alert('Ocurrió un error: ' + xhr.status + ' ' + xhr.statusText);
                }
            });
        }

        function fnGuardarEdicion() {
            var formData = new FormData(document.getElementById('editForm'));

            if (!isFormValid('editForm')) {
                return;
            }

            // Mostrar los datos que se van a enviar (opcional)
            formData.forEach((value, key) => {
                console.log(key + ": " + value);
            });

            $.ajax({
                url: 'eventoupdate.php', // Asegúrate de que esta URL sea correcta
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result); // Verifica la respuesta del servidor
                    try {
                        var jsonResponse = JSON.parse(result);
                        if (jsonResponse.success) {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'El registro se ACTUALIZO correctamente!!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            }); // Cierra el modal después de guardar
                            // Aquí puedes actualizar la interfaz de usuario según sea necesario
                        } else if (jsonResponse.error) {
                            alert(jsonResponse.error);
                        }
                    } catch (e) {
                        console.error('No se pudo analizar JSON:', e);
                        console.log('Respuesta:', result);
                    }
                },
                error: function(xhr) {
                    alert('Ocurrió un error: ' + xhr.status + ' ' + xhr.statusText);
                }
            });
        }


        function fnEliminar(Id_eventos) {
            // Muestra una alerta de confirmación antes de proceder con la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás recuperar este registro después de eliminarlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realiza la solicitud de eliminación si el usuario confirma
                    $.ajax({
                        url: "eventodelete.php",
                        type: 'GET',
                        data: {
                            Id_eventos: Id_eventos
                        },
                        success: function(result) {
                            try {
                                var jsonResponse = JSON.parse(result);
                                if (jsonResponse.Success) {
                                    Swal.fire({
                                        title: '¡Éxito!',
                                        text: 'El registro con id ' + Id_eventos + ' se ha eliminado exitosamente.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location
                                            .reload(); // Recarga la página para reflejar los cambios
                                    });
                                } else if (jsonResponse.error) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: jsonResponse.error,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            } catch (e) {
                                console.error('No se pudo analizar JSON:', e);
                                console.log('Respuesta:', result);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Error al procesar la respuesta del servidor.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error: ' + xhr.status + ' ' + xhr.statusText,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }

        function fnmodi(Id_eventos) {
            console.log('Enviando a modificar..');
            $.ajax({
                url: 'eventoget.php?Id_eventos=' + Id_eventos,
                type: 'GET',
                success: function(result) {
                    try {
                        var jsonResponse = JSON.parse(result);
                        console.log(jsonResponse);

                        if (jsonResponse && jsonResponse.data && jsonResponse.data.length > 0) {
                            $('#editForm #Id_eventos').val(jsonResponse.data[0].Id_eventos);
                            $('#editnom_evento').val(jsonResponse.data[0].nom_evento);
                            $('#editfecha').val(jsonResponse.data[0].fecha);
                            $('#edithora_inicio').val(jsonResponse.data[0].hora_inicio);
                            $('#editForm #cupos').val(jsonResponse.data[0].cupos);
                            $('#editForm #editId_Categoria').val(jsonResponse.data[0].Id_Categoria);
                            $('#editForm #Id_lugar').val(jsonResponse.data[0].Id_lugar);
                            $('#editModal').modal('show');

                        } else {
                            console.error('No se encontraron datos válidos en la respuesta:', jsonResponse);
                            alert('No se encontraron datos válidos para editar.');
                        }
                    } catch (e) {
                        console.error('No se pudo analizar JSON:', e);
                        console.log('Respuesta:', result);
                        alert('Error al procesar la respuesta del servidor.');
                    }
                },
                error: function(xhr) {
                    alert('Ocurrió un error: ' + xhr.status + ' ' + xhr.statusText);
                }
            });
        }
    </script>
</body>

</html>