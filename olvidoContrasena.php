<?php
session_start();

session_unset();

session_destroy();
if (isset($_SESSION['user_id'])) {
    header('Location: /menuPrincipal.html');
}

require 'controllers/conexion.php';
if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
    $usuario = $_POST['usuario'];
    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $actualizar = "UPDATE cliente SET pass='$pass' WHERE usuario='$usuario'";
    $ejecutar = mysqli_query($conexion, $actualizar);
    if ($ejecutar) {
        echo '
            <script>
            window.location = "iniciarSesion.php"
            </script>';
    } else {
        echo '
            <script>
            alert("No se pudo realizar la acción. Intente nuevamente.");
            window.location = "olvidoContrasena.html"
            </script>';
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cambiar contraseña</title>
    <link rel="stylesheet" type="text/css" href="assets/css/olvidocontrasena.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="">
        <a id="Regresarboton" href="iniciarSesion.php"><i class="fa fa-chevron-circle-left" style="font-size:48px" id="Regresar"></i></a>
        <a id="inversioLogo" href="index.html"><img src="assets/img/logoPrincipal.png" id="logoPrincipal"></a>
        <div class="container">
            <div class="login-content">
                <form action="olvidoContrasena.php" method="POST">
                    <img src="assets/img/avatar.png">
                    <h2 class="title">Cambiar contraseña</h2>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Usuario</h5>
                            <input required type="text" class="input" name="usuario" autocomplete="chrome-off">
                        </div>
                    </div>

                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Contraseña nueva</h5>
                            <input required type="password" id="pass1" name="pass" class="input" autocomplete="new-password" alt="strongPass" maxlength="8" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Considere al menos una letra mayúscula o minúscula. La contraseña debe empezar con una letra y contener al menor un dígito" required>

                        </div>
                    </div>

                    <!--             <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Confirmar contraseña</h5>
                            <input required type="password" id="pass2" name="pass" class="input" autocomplete="new-password" alt="strongPass" maxlength="8">
                        </div>
                    </div>  -->
                    <input type="submit" class="btn" value="Cambiar">
                </form>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/main.js">
        </script>
</body>

</html>