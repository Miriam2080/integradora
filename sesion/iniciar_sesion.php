<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="../dist/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../estilo/estilos.css">
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <img src="../img/logod.png" alt="Login Icon" class="img-fluid mb-2" style="width: 80px;">
                        <!-- <h2>Login</h2> -->
                    </div>
                    <div class="card-body bg-info">
                        <form id="loginForm" action="loginvalidar.php" method="POST">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo:</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu correo" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                            </div>
                            <div >
                                <button type="submit" class="btn btn-dark">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="text-center mt-3">
                    <a href="#" class="text-muted">¿Olvidaste tu contraseña?</a>
                </div> -->
            </div>
        </div>
    </main>


    
    
    <footer>
    </footer>
    <script src="../dist/jquery.min.js"></script>
    <!-- <script src="dist/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
    <script src="../dist/bootstrap.bundle.min.js"></script>

    <script>
        function isFormValid(formName) {
            $(`#${formName}`).addClass("was-validated");
            if (!$(`#${formName}`)[0].checkValidity()) {
                $(`#${formName} .invalid-feedback`).each(function() {
                    if ($(this)[0].offsetParent) {
                        return false;
                    }
                });
                return false;
            }
            return true;
        }

        function fnValidarLogin() {
            // var username = document.getElementById("username").value;
            // var password = document.getElementById("password").value;
            // Validar que los datos capturados sean correctos
            var formData = new FormData(document.getElementById('loginForm'));
            if (!isFormValid('loginForm')) {
                return;
            }
            $.ajax({
                url: "loginvalidar.php",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    try {
                        var jsonResponse = JSON.parse(result);
                        console.log('Success:', jsonResponse);
                        if (jsonResponse.success) {
                            alert("El registro se guardó exitosamente");
                            // rdireccionar a demo.php
                            // window.location.href = "demo.php";
                            // Update the client-side session
                            // localStorage.setItem('session', JSON.stringify(data.session));
                            // Redirect to the protected page
                            location.reload(); // 
                            // location.replace("demo.php");

                            return;
                        }
                        if (jsonResponse.error) {
                            alert(jsonResponse.error);
                        }
                    } catch (e) {
                        //console.error('Could not parse JSON:', e);
                        console.log('Response:', result);
                    }
                },
                error: function(xhr) {
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
        }
        // function togglePassword() {
        //     var passwordInput = document.getElementById('password');
        //     var type = passwordInput.type === 'password' ? 'text' : 'password';
        //     passwordInput.type = type;
        // }
    
    </script>
</body>

</html>