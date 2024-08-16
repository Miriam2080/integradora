
function isFormValid(formName) {
    $('#' + formName).addClass('was-validated');
    if (!$('#' + formName)[0].checkValidity()) {
        $('#' + formName + ' .invalid-feedback').each(function () {
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
        url: 'usuariosave.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            try {
                var jsonResponse = JSON.parse(result);
                if (jsonResponse.Success) {
                    alert('El registro se guardó exitosamente');
                    location.reload();
                }
                if (jsonResponse.error) {
                    alert(jsonResponse.error);
                }
            } catch (e) {
                console.error('No se pudo analizar JSON:', e);
                console.log('Respuesta:', response);
            }
        },
        error: function (xhr) {
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
        url: 'usuarioupdate.php', // Asegúrate de que esta URL sea correcta
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result); // Verifica la respuesta del servidor
            try {
                var jsonResponse = JSON.parse(result);
                if (jsonResponse.success) {
                    alert('Producto actualizado correctamente');
                    $('#editModal').modal('hide');
                    location.reload(); // Cierra el modal después de guardar
                    // Aquí puedes actualizar la interfaz de usuario según sea necesario
                } else if (jsonResponse.error) {
                    alert(jsonResponse.error);
                }
            } catch (e) {
                console.error('No se pudo analizar JSON:', e);
                console.log('Respuesta:', result);
            }
        },
        error: function (xhr) {
            alert('Ocurrió un error: ' + xhr.status + ' ' + xhr.statusText);
        }
    });
}


function fnborrar(Id_usuario) {
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
                url: 'usuariodelete.php',
                type: 'GET',
                data: {
                    Id_usuario: Id_usuario
                },
                success: function (result) {
                    try {
                        var jsonResponse = JSON.parse(result);
                        if (jsonResponse.Success) {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'El registro con id ' + Id_usuario + ' se ha eliminado exitosamente.',
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
                error: function (xhr) {
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


function fnmodi(Id_usuario) {
    console.log('Enviando a modificar..');
    $.ajax({
        url: 'usuarioget.php?Id_usuario=' + Id_usuario,
        type: 'GET',
        success: function (result) {
            try {
                var jsonResponse = JSON.parse(result);
                console.log(jsonResponse);

                if (jsonResponse && jsonResponse.data && jsonResponse.data.length > 0) {
                    $('#editForm #Id_usuario').val(jsonResponse.data[0].Id_usuario);
                    $('#editnombre_usuario').val(jsonResponse.data[0].nombre_usuario);
                    $('#editap_pat_usuario').val(jsonResponse.data[0].ap_pat_usuario);
                    $('#editap_mat_usuario').val(jsonResponse.data[0].ap_mat_usuario);
                    $('#editnumero_tel').val(jsonResponse.data[0].numero_tel);
                    $('#editcodigo_postal').val(jsonResponse.data[0].codigo_postal);
                    $('#editcorreo_electronico').val(jsonResponse.data[0].correo_electronico);
                    $('#editcontra').val(jsonResponse.data[0].contra);
                    $('#editId_ciudad').val(jsonResponse.data[0].Id_ciudad);
                    $('#editId_tipo_de_usuario').val(jsonResponse.data[0].Id_tipo_de_usuario);
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
        error: function (xhr) {
            alert('Ocurrió un error: ' + xhr.status + ' ' + xhr.statusText);
        }
    });
}


function fnconsultar(id_producto) {
    console.log('Enviando a consultar..');
    $.ajax({
        url: 'productoconsultar.php?id_producto=' + id_producto,
        type: 'GET',
        processData: false,
        contentType: false,
        success: function (result) {
            try {
                var jsonResponse = JSON.parse(result);
                console.log(jsonResponse);

                // Rellena el formulario con los datos
                $('#consultId').val(jsonResponse.data[0].id_producto);
                $('#consultModelo').val(jsonResponse.data[0].modelo);
                $('#consultprecio').val(jsonResponse.data[0].precio);
                $('#consultid_marca').val(jsonResponse.data[0].id_marca);
                $('#consultModal').modal('show');

            } catch (e) {
                console.error('No se pudo analizar JSON:', e);
                console.log('Respuesta:', result);
            }
        },
        error: function (xhr) {
            alert('Ocurrió un error: ' + xhr.status + ' ' + xhr.statusText);
        }
    });
}
$(document).ready(function () {
    fnLoadData();
    $("#titulomodulo").html('Modulo de usuarios')
});