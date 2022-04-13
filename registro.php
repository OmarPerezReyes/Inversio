<?php

require 'controllers/database.php';

$message = '';

if (
    !empty($_POST['usuario']) && !empty($_POST['nombre']) && !empty($_POST['apellidoPaterno']) && !empty($_POST['apellidoMaterno'])
    && !empty($_POST['fechaNacimiento']) && !empty($_POST['numeroTelefono']) && !empty($_POST['curp'])
    && !empty($_POST['correo']) && !empty($_POST['pass'])
) {
    $sql = "INSERT INTO cliente (usuario, nombre, apellido_paterno, apellido_materno, fecha_nacimiento,
    telefono_celular, curp, correo, pass, identificacion_oficial, firma) VALUES (:usuario, :nombre, :apellido_paterno, :apellido_materno, :fecha_nacimiento,
    :telefono_celular, :curp, :correo, :pass, :identificacion_oficial, :firma)";
    $stmt = $conexion->prepare($sql);
    $usuario = $_POST["usuario"];
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido_paterno', $_POST['apellidoPaterno']);
    $stmt->bindParam(':apellido_materno', $_POST['apellidoMaterno']);
    $stmt->bindParam(':fecha_nacimiento', $_POST['fechaNacimiento']);
    $stmt->bindParam(':telefono_celular', $_POST['numeroTelefono']);
    $stmt->bindParam(':curp', $_POST['curp']);
    $stmt->bindParam(':correo', $_POST['correo']);
    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $stmt->bindParam(':pass', $pass);
    if ($_FILES['identificacionOficial']['error'] > 0) {
        echo '
        <script>
            alert("Error al cargar el archivo. Por favor intente de nuevo.");
        </script>
        ';
    } else {
        $permitido = array("application/pdf", 'image/jpg');
        if (in_array($_FILES['identificacionOficial']['type'], $permitido)) {
            $ruta = 'assets/files/';
            opendir($ruta);
            $_FILES['identificacionOficial']['name'] = $usuario . "_identificacionOficial.pdf";
            $credencial = $ruta . $_FILES['identificacionOficial']['name'];
            copy($_FILES['identificacionOficial']['tmp_name'], $credencial);
            if (!file_exists($ruta)) {
                mkdir($ruta);
            }
        } else {
            echo '
            <script>
                alert("Tipo de archivo pdf no permitido.");
            </script>
            ';
        }
    }
    $stmt->bindParam(':identificacion_oficial', $credencial);

    $img = $_POST['firma'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $fileData = base64_decode($img);
    $fileName = $usuario . '_firma.png';

    $ruta = 'assets/files/';
    opendir($ruta);
    $firma = $ruta . $fileName;
    copy($_POST['firma'], $firma);
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }

    $stmt->bindParam(':firma', $firma);

    if ($stmt->execute()) {
        echo "<script>console.log('Usuario registrado correctamente' );</script>";
    } else {
        echo "<script>console.log('Ha ocurrido un error en el registro' );</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/registro.css">
    <script src="assets/js/firma.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    function generarImagen() {
    const enlace = document.createElement('a');
    // El título
    enlace.download = "Firma.png";
    // Convertir la imagen a Base64 y ponerlo en el enlace
    enlace.href = $canvas.toDataURL();
    // Hacer click en él
    document.getElementById("firmaImagen").value = enlace;
};

</script>
</head>

<body>
    <a id="Regresarboton" href="./index.html"><i class="fa fa-chevron-circle-left" style="font-size:48px" id="Regresar"></i></a>
    <a id="inversioLogo" href="index.html"><img src="assets/img/logoPrincipalBlanco.png" id="logoPrincipal"></a>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="contenido-login">
        <form action="registro.php" method="POST" enctype="multipart/form-data">
            <img src="assets/img/avatar.png">
            <h2 class="title">Únete a Inversio</h2>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Usuario</h5>
                    <input required type="text" name="usuario" class="input">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Nombre</h5>
                    <input required type="text" name="nombre" class="input">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Apellido paterno</h5>
                    <input required type="text" name="apellidoPaterno" class="input">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Apellido materno</h5>
                    <input required type="text" name="apellidoMaterno" class="input">
                </div>
            </div>

            <div class="input-div one arribaDiv">
                <div class="i">
                    <i class="fas fa-birthday-cake" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Fecha de nacimiento</h5>
                    <input required type="date" name="fechaNacimiento" class="input" name="">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Número de teléfono</h5>
                    <!--BUSCAR LIMITAR EL TELEFONO-->
                    <input required type="number" name="numeroTelefono" class="input" onkeydown="if(this.value.length == 10) return false;">
                    <!-- <input type="number" id="tentacles" name="tentacles" min="10" max="100"> -->
                    <!-- <input name=numero type=text maxlength=7> -->
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-home" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>CURP</h5>
                    <input required type="text" name="curp" class="input" maxlength=18>
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Correo</h5>
                    <input required type="email" name="correo" class="input" autocomplete="chrome-off">
                </div>
            </div>

            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Contraseña</h5>
                    <input required type="password" name="pass" class="input" autocomplete="new-password" maxlength=8 pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Considere al menos una letra mayúscula o minúscula. La contraseña debe empezar con una letra y contener al menor un dígito" required>
                </div>
            </div>

            <div class="input-div one arribaDiv">
                <div class="i">
                    <i class="far fa-address-card" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Identificación oficial</h5>
                    <label class="file">
                        <input type="file" name="identificacionOficial" id="file" accept="application/pdf" onchange="fileChoose(event,this)" aria-label="File browser example">
                        <span class="file-custom" data-after="Credencial de elector"></span>
                    </label>
                </div>
            </div>
            <span class="d-block pb-2">Firma digital aqui</span>
            <div class="signature mb-2" style="width: 100%; height: 200px;">
                <canvas id="signature-canvas" style="border: 1px black; background-color:white;width: 100%; height: 200px;"></canvas>
            </div>
            <button type="button" id="btnLimpiar">Borrar</button>
            <button type="button" id="btnDescargar">Descargar</button>
            <div class="caja">
                <label><input required type="checkbox" name="cbox12"> Acepto términos y condiciones</label>
            </div>
            <input type="hidden" id="firmaImagen" name="firma">
            <input required type="submit" id="btnDescargar" class="btn" onclick="generarImagen()">
        </form>
    </div>
    <script src="assets/js/borrarFirma.js"></script>
    <script src="assets/js/generarImagen.js"></script>
</body>
<script type="text/javascript" src="assets/js/main.js"></script>

</html>