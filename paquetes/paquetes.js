function isFormValid(formName) {
    $(`#${formName}`).addClass("was-validated");
    if (!$(`#${formName}`)[0].checkValidity()) {
        $(`#${formName} .invalid-feedback`).each(function () {
            if ($(this)[0].offsetParent) {
                return false;
            }
        });
        return false;
    }
    return true;
}

// function fnLoadData() {
    // Mostrar el modal
    // Obtener los datos del registro del servidor dado según el id
//     $.ajax({
//         url: "inpaquetesconsultar.php",
//         type: 'GET',
//         data: '',
//         processData: false,
//         contentType: false,
//         success: function (result) {
//             try {
//                 var jsonResponse = JSON.parse(result);
//                 array = jsonResponse.data;
//                 // limpiar la tbody
//                 $("#myTableBody").empty();
//                 // console.log(array);
//                 array.forEach(registro => {
//                     // agregar cada registro a la tabla myTableBody1
//                     $("#myTableBody").append(
//                         `
//                                 <tr>
//                                     <td>${registro.Id_paquete}</td>
//                                     <td>${registro.tipo_de_paquete}</td>
//                                     <td>${registro.Nom_evento}</td>
//                                     <td>
//                                         <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#myeditModal" onClick="fnEditar('${registro.Id_paquete}');"> Editar </button>
//                                         <button class="btn btn-danger" onClick="fnBorrar('${registro.Id_paquete}');"> Borrar </button>
//                                         </div>
//                                     </td>
//                                 </tr>
//                             `);
//                 });
//                 if (jsonResponse.error) {
//                     alert(jsonResponse.error);
//                 }
//             } catch (e) {
//                 //console.error('Could not parse JSON:', e);
//                 console.log('Response:', result);
//             }
//         },
//         error: function (xhr) {
//             alert("An error occured: " + xhr.status + " " + xhr.statusText);
//         }
//     });
// }

$(document).ready(function () {
    fnLoadData();
    $("#titulomodulo").html('Modulo de paquetes')
});

function isFormValid(formId) {
    const form = document.getElementById(formId);
    return form.checkValidity();
}

function fnGuardar() {
    var form = document.getElementById('myForm');
    if (!form) {
        console.error('Formulario no encontrado.');
        return;
    }
    // Recoger datos del formulario
    var formData = new FormData(document.getElementById('myForm'));

    // Enviar datos al servidor
    $.ajax({
        url: 'inpaquetesguardar.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            try {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    Swal.fire({
                        title: "¡Éxito!",
                        text: jsonResponse.success,
                        icon: "success"
                    }).then(() => {
                        location.reload(); // Recargar la página para reflejar los cambios
                    });
                } else if (jsonResponse.error) {
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
        error: function (xhr) {
            Swal.fire({
                title: "Error",
                text: "Ocurrió un error: " + xhr.status + " " + xhr.statusText,
                icon: "error"
            });
        }
    });
}

// Función para cargar los datos en el formulario
function fnEditar(id) {
    $.ajax({
        url: "inpaquetesobtener.php",
        type: 'post',
        data: {
            id: id
        },
        success: function (result) {
            try {
                var jsonResponse = JSON.parse(result);
                if (jsonResponse.data && jsonResponse.data.length > 0) {
                    var registro = jsonResponse.data[0];
                    // console.log(registro.Id_paquete)
                    // console.log(registro.Id_tipo_de_paquetes)
                    // console.log(registro.Id_eventos)
                    $('#myeditForm #id').val(registro.Id_paquete);
                    $('#myeditForm #paquete').val(registro.Id_tipo_de_paquetes);
                    $('#myeditForm #evento').val(registro.Id_eventos);
                } else if (jsonResponse.error) {
                    Swal.fire({
                        title: 'Error',
                        text: jsonResponse.error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (e) {
                console.error('Could not parse JSON:', e);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al procesar la respuesta del servidor.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function (xhr) {
            alert("An error occurred: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function fnGuardarCambios() {
    var formData = new FormData(document.getElementById('myeditForm'));
    if (!isFormValid('myeditForm')) {
        return;
    }
    $.ajax({
        url: 'inpaquetesactualizar.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
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
                    });
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



function isFormValid(formId) {
    var form = document.getElementById(formId);
    return form.checkValidity();
}

function fnBorrar(id) {
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
                url: "inpaquetesdelete.php",
                type: 'GET',
                data: {
                    id: id
                },
                success: function (result) {
                    try {
                        var jsonResponse = JSON.parse(result);
                        if (jsonResponse.Success) {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'El registro con id ' + id + ' se ha eliminado exitosamente.',
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

function fnBuscar() {
    var tipoPaquete = $('#searchInput').val(); // Obtener el valor del campo de búsqueda por tipo de paquete

    // Evitar hacer una solicitud si ambos campos están vacíos
    if (tipoPaquete.trim().length > 0) {
        $.ajax({
            url: 'inpaquetesconsultar.php', // El script que realiza la búsqueda
            type: 'GET',
            data: {
                tipo_de_paquete: tipoPaquete
            },
            dataType: 'json', // Espera una respuesta en formato JSON
            success: function (result) {
                if (Array.isArray(result.data)) {
                    var array = result.data;
                    $('#myTableBody').empty(); // Limpiar la tabla antes de agregar nuevos resultados
                    array.forEach(registro => {
                        $("#myTableBody").append(
                            `
                                <tr class="">
                                    <td>${registro.Id_paquete}</td>
                                    <td>${registro.tipo_de_paquete}</td>
                                    <td>${registro.Nom_evento}</td>
                                    <td>
                                        <button  class="btn btn-light" data-bs-toggle="modal" data-bs-target="#myeditModal" onClick="fnEditar('${registro.Id_paquete}');"> Editar</button>
                                        <button class="btn btn-danger" onClick="fnBorrar('${registro.Id_paquete}');"> Borrar</button>
                                        </div>
                                    </td>
                                </tr>
                            `);
                    });
                } else if (result.error) {
                    $('#myTableBody').empty(); // Limpiar la tabla si hay un error
                    $('#myTableBody').append(`<tr><td colspan="5">${result.error}</td></tr>`);
                } else {
                    console.warn('Respuesta inesperada:', result);
                }
            },
            error: function (xhr) {
                $('#myTableBody').empty(); // Limpiar la tabla en caso de error
                $('#myTableBody').append(
                    `<tr><td colspan="5">Ocurrió un error: ${xhr.status} ${xhr.statusText}</td></tr>`
                );
            }
        });
    }
}