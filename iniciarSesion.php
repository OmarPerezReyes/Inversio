<?php
session_start();
  if (isset($_SESSION['user_id'])) {
    session_destroy();
    header('Location: index.html');
  }

  require 'controllers/database.php';

  if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
    $records = $conexion->prepare('SELECT id_cliente, usuario, pass FROM cliente WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
        $message = '';
    if (count($results) > 0 && password_verify($_POST['pass'], $results['pass'])) {
      $_SESSION['user_id'] = $results['id_cliente'];
      session_start();
      header("Location: menuPrincipal.php");
    } else {
        echo '
        <script>
            alert("Contraseña o usuario incorrecto favor de verificar y voler a intentar.");
        </script>
        ';
    }
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" type="text/css" href="assets/css/iniciarSesion.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>
    <img class="wave" src="">
    <a id="Regresarboton" href="./index.html"><i class="fa fa-chevron-circle-left" style="font-size:48px" id="Regresar"></i></a>
    <a id="inversioLogo" href="index.html"><img src="assets/img/logoPrincipal.png" id="logoPrincipal"></a>
    <div class="container">
        <div class="img">
            <img src="./assets/img/izqIniciarSesion.png">
        </div>
        <div class="login-content">
            <form action="iniciarSesion.php" method="POST">
                <img src="assets/img/avatar.png">
                <h2 class="title">Bienvenido</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input required type="text" name="usuario" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input required type="password" name="pass" class="input" autocomplete="new-password">
                    </div>
                </div>
                <a href="olvidoContrasena.php">¿Olvidaste tu contraseña?</a>
                <input type="submit" class="btn" value="Iniciar sesión">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>